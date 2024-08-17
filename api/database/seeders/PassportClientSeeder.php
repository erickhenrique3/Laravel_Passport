<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class PassportClientSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $clientCount = DB::table('oauth_clients')->count();

        if ($clientCount === 0) {
            Artisan::call('passport:client', [
                '--personal' => true,
                '--name' => 'My Personal Access Client',
                '--no-interaction' => true,
            ]);
        }
    }
}

