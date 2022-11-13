<?php

use Illuminate\Database\Seeder;
use App\Models\Users\Subjects;
use App\Models\Users\User;

class SubjectUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            "user_id" => 4,
            "subject_id" => 1,
        ];
        DB::table('subject_users')->insert($param);
        $param = [
            "user_id" => 6,
            "subject_id" => 2,
        ];
        DB::table('subject_users')->insert($param);
        $param = [
            "user_id" => 9,
            "subject_id" => 3,
        ];
        DB::table('subject_users')->insert($param);

    }
}
