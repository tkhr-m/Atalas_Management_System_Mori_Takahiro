<?php

use Illuminate\Database\Seeder;
use App\Models\Users\Subjects;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 国語、数学、英語を追加
         $param = [
            "subject" => "国語",
        ];
        DB::table("subjects")->insert($param);

        $param = [
            "subject" => "数学",
        ];
        DB::table("subjects")->insert($param);

        $param = [
            "subject" => "英語",
        ];
        DB::table("subjects")->insert($param);
    }
}
