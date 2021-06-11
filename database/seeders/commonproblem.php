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
                    'problem' =>  'พ้อยท์หาย',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ],
                [
                    'problem' =>  'พ้อยไม่อัพเดท',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ],
                [
                    'problem' =>  'เติมเงินมีปัญหา',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ],
                [
                    'problem' =>  'แลกเครดิตไม่เข้า',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ],
                [
                    'problem' =>  'พ้อยท์เกิน,แลกเยอะผิดปกติ',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ],
                [
                    'problem' =>  'อื่น ๆ',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ],
            ]);

        }
    }
}
