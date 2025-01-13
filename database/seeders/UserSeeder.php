<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User as UserDB;
use Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('DB_MIGRATE_USERS')) {
            UserDB::create([
                'nation' => '+886',
                'mobile' => '928589779',
                'phone' => '+886928589779',
                'email' => 'weayzehoa@gmail.com',
                'password' => Hash::make('QWE123!@#'),
                'account' => 'roger',
                'name' => 'Roger Wu',
                'address' => '新北市',
                'birthday' => '2000-01-01',
                'status' => 1,
                'lock_on' => 0,
                'otp_code' => null,
                'otp_time' => null,
                'verify_mode' => '2FA',
                '2fa_secret' => 'FC34LRIISEICZZFK2GZH5DOHRWLZK22H',
            ]);
            echo "Users 建立完成\n";
        }
    }
}
