<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class commonproblem extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('common_problem')->count() == 0){
            $timestamp = date('Y-m-d H:i:s');
            DB::table('common_problem')->insert([
                [
                    'name' =>  'พ้อยท์หาย',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ],
                [
                    'name' =>  'พ้อยไม่อัพเดท',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ],
                [
                    'name' =>  'เติมเงินมีปัญหา',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ],
                [
                    'name' =>  'แลกเครดิตไม่เข้า',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ],
                [
                    'name' =>  'พ้อยท์เกิน,แลกเยอะผิดปกติ',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ],
                [
                    'name' =>  'อื่น ๆ',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ],
            ]);

        }
    }
}
