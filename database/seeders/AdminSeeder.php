<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin as AdminDB;
use Hash;
use DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('DB_MIGRATE_ADMINS')) {
            AdminDB::create([
                'nation' => '+886',
                'mobile' => '928589779',
                'phone' => '+886928589779',
                'email' => 'weayzehoa@gmail.com',
                'password' => Hash::make('QWE123!@#'),
                'account' => 'admin',
                'name' => '系統管理員',
                'address' => null,
                'birthDay' => null,
                'status' => 1,
                'power' => 'M1S0,M1S1,M1S1N,M1S1D,M1S1M,M1S1O,M1S1EX,M1S3,M1S3N,M1S3D,M1S3M,M1S3O,M1S3S,M1S4,M1S4M,M1S5,M1S5M,M1S7,M1S7N,M1S7D,M1S7M,M1S7O,M1S7S,M1S8,M1S8N,M1S8D,M1S8M,M1S9,M2S0,M2S1,M2S1N,M2S1D,M2S1M,M2S1O,M2S1EX,M2S3,M2S3N,M2S3D,M2S3M,M2S3O,M2S3T,M3S0,M3S1,M3S1N,M3S1D,M3S1M,M3S1S,M3S2,M3S2N,M3S2D,M3S2M,M3S2O,M3S4,M3S4N,M3S4D,M3S4M,M4S0,M4S1,M4S1N,M4S1D,M4S1M,M4S1CP,M4S1IM,M4S1EX,M4S2,M4S2EX,M4S3,M4S3N,M4S3M,M4S3S,M4S4,M4S4N,M4S4M,M4S4O,M4S4S,M4S6,M4S6N,M4S6M,M4S6O,M4S6S,M4S5,M4S5M,M4S7,M4S7N,M4S7D,M4S7M,M4S7O,M5S0,M5S1,M5S1M,M5S1O,M5S1P,M5S1SMS,M5S1SMM,M5S2,M5S3,M6S0,M6S1,M6S1N,M6S1M,M6S1O,M7S0,M7S1,M7S1N,M7S1M,M7S1O,M7S1S,M7S2,M7S2N,M7S2M,M7S2O,M7S2S,M7S3,M7S3N,M7S3M,M7S3O,M7S4,M7S4N,M7S4M,M7S4O,M7S6,M7S6N,M7S6M,M7S7,M7S7N,M7S7D,M7S7M,M7S7O,M7S7S,M7S8,M7S8N,M7S8D,M7S8M,M7S8O,M7S8S,M8S0,M8S1,M8S10,M8S11,M8S9,M8S4,M8S5,M8S6,M8S7,M26S0,M26S1,M26S1N,M26S1D,M26S1M,M26S1O,M26S3,M26S3M,M26S4,M26S4M,M26S5,M26S5N,M26S5D,M26S5M,M26S6,M26S7,M26S7N,M26S7D,M26S8,M26S8O,M27S0,M27S1,M27S1M,M27S1MQ,M27S1IM,M27S1EX,M27S1SY,M27S1MK,M27S1PR,M27S1RM,M27S1IMP,M27S1IMS,M27S1IMT,M27S1RT,M27S1AL,M27S1NI,M27S1CI,M27S8,M27S8M,M27S8MQ,M27S8EX,M27S8MK,M27S8RM,M27S8AL,M27S8NI,M27S8CI,M27S9,M27S9EX,M27S10,M27S10EX,M27S4,M27S4N,M27S4M,M27S4IM,M27S4EX,M27S4ST,M27S4REO,M27S2,M27S2M,M27S3,M27S3M,M27S5,M27S6,M27S7,M28S0,M28S1,M28S1N,M28S1M,M28S1CO,M28S1IM,M28S1EX,M28S1SY,M28S1SEM,M28S1MK,M28S1COL,M28S2,M28S2D,M28S2M,M28S3,M28S3N,M28S3M,M28S3CO,M28S4,M28S4N,M28S4D,M28S4CO,M28S4DL,M28S4SEM,M28S5,M28S5N,M28S5D,M28S6,M28S6M,M28S7,M28S7N,M28S7D,M28S8,M28S8D,M28S8M,M28S9,M29S0,M29S1,M29S1D,M29S1M,M29S1IM,M29S2,M29S2M,M29S3,M29S3M,M29S4,M29S4D,M29S4M,M29S4E,M29S5,M29S5D,M29S6,M29S6CO,M33S0,M33S1,M33S1D,M33S1M,M33S2,M33S2M,M33S2IM,M33S3,M33S3M,M32S0,M32S0M,M31S0,M31S0M,M31S0O,M31S0E,M30S0',
                'lock_on' => 0,
                'otp_code' => null,
                'otp_time' => null,
                'verify_mode' => '2FA',
                '2fa_secret' => 'FC34LRIISEICZZFK2GZH5DOHRWLZK22H',
            ]);
            echo "Admin 建立完成\n";
        }
    }
}
