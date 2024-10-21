<?php

namespace App\Console\Commands;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Illuminate\Console\Command;
use App\Jobs\SendWelcomeEmail;

class ConsumeRabbitMQ extends Command
{
    protected $signature = 'rabbitmq:consume';
    protected $description = 'Consume messages from RabbitMQ';

    public function handle()
    {
        // Estabelece a conexão com o RabbitMQ
        $connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST'),
            env('RABBITMQ_PORT'),
            env('RABBITMQ_USER'),
            env('RABBITMQ_PASSWORD')
        );

        $channel = $connection->channel();
        $channel->queue_declare(env('RABBITMQ_QUEUE'), false, true, false, false, false, []);

        $callback = function (AMQPMessage $msg) {
            $data = json_decode($msg->body, true);
            SendWelcomeEmail::dispatch($data['email']); 
            $this->info('Email sent to ' . $data['email']);
        };

        // Consome as mensagens
        $channel->basic_consume(env('RABBITMQ_QUEUE'), '', false, true, false, false, $callback);

        while (true) {
            $channel->wait();
        }
        // Fecha o canal e a conexão
        $channel->close();
        $connection->close();
    }
}

