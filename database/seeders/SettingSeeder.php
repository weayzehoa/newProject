<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule as ScheduleDB;
use App\Models\SystemSetting as SystemSettingDB;
use App\Models\CompanySetting as CompanySettingDB;
use App\Models\SpecialVendor as SpecialVendorDB;
use App\Models\iCarryVendor as VendorDB;
use App\Models\IpAddress as IpAddressDB;
use App\Models\MailTemplate as MailTemplateDB;
use App\Models\iCarryLanguagePack as LanguagePackDB;
use DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('DB_MIGRATE_SYSTEM_SETTINGS')) {
            SystemSettingDB::create([
                'exchange_rate_RMB' => 4.34,
                'exchange_rate_SGD' => 21.80,
                'exchange_rate_MYR' => 7.30,
                'exchange_rate_HKD' => 3.75,
                'exchange_rate_USD' => 30.35,
                'sms_supplier' => 'aws',
                'payment_supplier' => '藍新',
                'email_supplier' => 'aws',
                'invoice_supplier' => 'ezpay',
                'customer_service_supplier' => 'crisp',
                'admin_id' => 1,
                'twpay_quota' => 100042,
                'gross_weight_rate' => 1.3,
            ]);
            echo "System Setting 建立完成\n";
        }

        if (env('DB_MIGRATE_COMPANY_SETTINGS')) {
            CompanySettingDB::create([
                'name' => '測試股份有限公司',
                'name_en' => 'Testing Co., Ltd.',
                'tax_id_num' => '12345678',
                'tel' => '+886-2-2222-2222',
                'fax' => '+886-2-2222-2220',
                'address' => '台灣台北市中山區測試路100號10樓之1',
                'address_en' => 'Rm. 1, 10F., No. 100, Testing Rd., Zhongshan Dist., Taipei City 10000, Taiwan (R.O.C.)',
                'service_tel' => '+886-987-654-321',
                'service_email' => 'test@testing.com',
                'url' => 'https://testing.com',
                'website' => 'testing.com',
                'fb_url' => 'https://www.facebook.com',
                'Instagram_url' => 'https://www.instagram.com',
                'Telegram_url' => 'https://t.me',
                'line' => '',
                'wechat' => '',
                'admin_id' => 1,
            ]);
            echo "COMPANY Setting 建立完成\n";
        }

        if (env('DB_MIGRATE_SCHEDULES')) {
            $schedules = [
                ['name' => '匯率更新排程', 'code' => 'getCurrency', 'admin_id' => 1, 'is_on' => 1, 'is_loop' => 1, 'frequency' => 'weekly'],
            ];
            for ($i=0;$i<count($schedules);$i++) {
                ScheduleDB::create([
                    'name' => $schedules[$i]['name'],
                    'code' => $schedules[$i]['code'],
                    'admin_id' => $schedules[$i]['admin_id'],
                    'is_on' => $schedules[$i]['is_on'],
                    'frequency' => $schedules[$i]['frequency'],
                ]);
            }
        }

        if (env('DB_MIGRATE_IP_ADDRESSES')) {
            $ips = [
                ['ip' => '::1', 'admin_id' => 0, 'memo' => 'LocalHost', 'disable' => 1, 'created_at' => date('Y-m-d H:i:s')],
                ['ip' => '127.0.0.1', 'admin_id' => 0, 'memo' => 'LocalHost', 'disable' => 1, 'created_at' => date('Y-m-d H:i:s')],
                ['ip' => '114.34.110.120', 'admin_id' => 1, 'memo' => 'Roger 家中固定IP', 'disable' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ];
            IpAddressDB::insert($ips);
            echo "ip列表 建立完成\n";
        }
    }
}
