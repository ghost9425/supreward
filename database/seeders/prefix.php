<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class prefix extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // if(DB::table('prefix')->count() == 0){
            $length = 3;
            $character = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $timestamp = date('Y-m-d H:i:s');
            for ($i=0; $i < 10; $i++) {
                DB::table('prefix')->insert([
                    'name' => substr(str_shuffle(str_repeat($character, $length)), 0, $length),
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ]);
            }
            // $timestamp = date('Y-m-d H:i:s');
            // DB::table('prefix')->insert([
            //     [
            //         'name' => 'AMB',
            //         'created_at' => $timestamp,
            //         'updated_at' => $timestamp
            //     ],
            //     [
            //         'name' => 'BD',
            //         'created_at' => $timestamp,
            //         'updated_at' => $timestamp

            //     ],
            //     [
            //         'name' => 'SNK',
            //         'created_at' => $timestamp,
            //         'updated_at' => $timestamp

            //     ],
            //     [
            //         'name' => 'SAND',
            //         'created_at' => $timestamp,
            //         'updated_at' => $timestamp

            //     ],
            //     [
            //         'name' => 'PT',
            //         'created_at' => $timestamp,
            //         'updated_at' => $timestamp

            //     ],
            //     [
            //         'name' => 'ADU',
            //         'created_at' => $timestamp,
            //         'updated_at' => $timestamp

            //     ],
            // ]);

        // }
    }
}
