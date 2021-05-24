<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User_login extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        if(DB::table('users')->count() == 0){
            $timestamp = date('Y-m-d H:i:s');
            DB::table('users')->insert([
                [
                    'user' => 'demo_reward',
                    'password' =>  Hash::make('123456789'),
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ]
            ]);

        }
    }
}
