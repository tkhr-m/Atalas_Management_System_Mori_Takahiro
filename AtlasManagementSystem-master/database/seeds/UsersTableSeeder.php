<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            "over_name" => "田中",
            "under_name" => "太郎",
            "over_name_kana" => "タナカ",
            "under_name_kana" => "タロウ",
            "mail_address" => "tanaka@gmail.com",
            "sex" => "1",
            "birth_day" => "19990101",
            "role" => "1",
            "password" => bcrypt("tanakatanaka"),
        ];
        DB::table("users")->insert($param);


        $param = [
            "over_name" => "佐藤",
            "under_name" => "次郎",
            "over_name_kana" => "サトウ",
            "under_name_kana" => "ジロウ",
            "mail_address" => "satou@gmail.com",
            "sex" => "1",
            "birth_day" => "19970407",
            "role" => "2",
            "password" => bcrypt("satousatou"),
        ];
        DB::table("users")->insert($param);


        $param = [
            "over_name" => "鈴木",
            "under_name" => "三郎",
            "over_name_kana" => "スズキ",
            "under_name_kana" => "サブロウ",
            "mail_address" => "suzuki@gmail.com",
            "sex" => "1",
            "birth_day" => "19940825",
            "role" => "3",
            "password" => bcrypt("suzukisuzuki"),
        ];
        DB::table("users")->insert($param);


        $param = [
            "over_name" => "高橋",
            "under_name" => "彩花",
            "over_name_kana" => "タカハシ",
            "under_name_kana" => "アヤカ",
            "mail_address" => "takahashi@gmail.com",
            "sex" => "2",
            "birth_day" => "19960409",
            "role" => "4",
            "password" => bcrypt("takahashitakahashi"),
        ];
        DB::table("users")->insert($param);


        $param = [
            "over_name" => "三浦",
            "under_name" => "佳奈",
            "over_name_kana" => "ミウラ",
            "under_name_kana" => "カナ",
            "mail_address" => "miura@gmail.com",
            "sex" => "2",
            "birth_day" => "19930115",
            "role" => "1",
            "password" => bcrypt("miuramiura"),
        ];
        DB::table("users")->insert($param);


        $param = [
            "over_name" => "斉藤",
            "under_name" => "圭介",
            "over_name_kana" => "サイトウ",
            "under_name_kana" => "ケイスケ",
            "mail_address" => "saitou@gmail.com",
            "sex" => "1",
            "birth_day" => "19891217",
            "role" => "4",
            "password" => bcrypt("saitousaitou"),
        ];
        DB::table("users")->insert($param);


        $param = [
            "over_name" => "林",
            "under_name" => "里奈",
            "over_name_kana" => "ハヤシ",
            "under_name_kana" => "リナ",
            "mail_address" => "hayashi@gmail.com",
            "sex" => "2",
            "birth_day" => "19960303",
            "role" => "1",
            "password" => bcrypt("hayashihayashi"),
        ];
        DB::table("users")->insert($param);


        $param = [
            "over_name" => "谷",
            "under_name" => "裕子",
            "over_name_kana" => "タニ",
            "under_name_kana" => "ユウコ",
            "mail_address" => "tani@gmail.com",
            "sex" => "2",
            "birth_day" => "19990101",
            "role" => "2",
            "password" => bcrypt("tanitani"),
        ];
        DB::table("users")->insert($param);


        $param = [
            "over_name" => "松本",
            "under_name" => "麻友",
            "over_name_kana" => "マツモト",
            "under_name_kana" => "マユ",
            "mail_address" => "matsumoto@gmail.com",
            "sex" => "2",
            "birth_day" => "19990718",
            "role" => "4",
            "password" => bcrypt("matsumotomatsumoto"),
        ];
        DB::table("users")->insert($param);


        $param = [
            "over_name" => "及川",
            "under_name" => "祐希",
            "over_name_kana" => "オイカワ",
            "under_name_kana" => "ユウキ",
            "mail_address" => "oikawa@gmail.com",
            "sex" => "1",
            "birth_day" => "19990129",
            "role" => "3",
            "password" => bcrypt("oikawaoikawa"),
        ];
        DB::table("users")->insert($param);


        $param = [
            "over_name" => "堀",
            "under_name" => "美月",
            "over_name_kana" => "ホリ",
            "under_name_kana" => "ミズキ",
            "mail_address" => "hori@gmail.com",
            "sex" => "2",
            "birth_day" => "19970808",
            "role" => "2",
            "password" => bcrypt("horihori"),
        ];
        DB::table("users")->insert($param);
    }

}
