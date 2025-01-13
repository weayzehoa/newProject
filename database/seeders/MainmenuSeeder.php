<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mainmenu as MainmenuDB;
use App\Models\Submenu as SubmenuDB;
use App\Models\PowerAction as PowerActionDB;

class MainmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mainmenu = [
            //admin後台
            ['sort' => 1, 'is_on' => 1, 'type' => 1, 'url_type' => 0, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-cogs"></i>', 'name' => '系統管理', 'url' => ''],
            ['sort' => 2, 'is_on' => 0, 'type' => 1, 'url_type' => 0, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-store"></i>', 'name' => '商家管理', 'url' => ''],
            ['sort' => 3, 'is_on' => 0, 'type' => 1, 'url_type' => 0, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-truck"></i>', 'name' => '物流管理', 'url' => ''],
            ['sort' => 4, 'is_on' => 0, 'type' => 1, 'url_type' => 0, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fab fa-product-hunt"></i>', 'name' => '商品管理', 'url' => ''],
            ['sort' => 5, 'is_on' => 0, 'type' => 1, 'url_type' => 0, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-users"></i>', 'name' => '使用者管理', 'url' => ''],
            ['sort' => 6, 'is_on' => 0, 'type' => 1, 'url_type' => 0, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-users"></i>', 'name' => '團購管理', 'url' => ''],
            ['sort' => 7, 'is_on' => 0, 'type' => 1, 'url_type' => 0, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-ad"></i>', 'name' => '行銷策展', 'url' => ''],
            ['sort' => 8, 'is_on' => 0, 'type' => 1, 'url_type' => 0, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-chart-bar"></i>', 'name' => '統計資料', 'url' => ''],
            ['sort' => 9, 'is_on' => 0, 'type' => 1, 'url_type' => 0, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-tools"></i>', 'name' => '預留一', 'url' => ''],
            ['sort' => 10, 'is_on' => 0, 'type' => 1, 'url_type' => 0, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-tools"></i>', 'name' => '預留二', 'url' => ''],
            ['sort' => 11, 'is_on' => 0, 'type' => 1, 'url_type' => 0, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-tools"></i>', 'name' => '預留三', 'url' => ''],
            ['sort' => 12, 'is_on' => 0, 'type' => 1, 'url_type' => 0, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-tools"></i>', 'name' => '預留四', 'url' => ''],
            ['sort' => 13, 'is_on' => 0, 'type' => 1, 'url_type' => 0, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-tools"></i>', 'name' => '預留五', 'url' => ''],
            ['sort' => 14, 'is_on' => 0, 'type' => 1, 'url_type' => 0, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-tools"></i>', 'name' => '預留六', 'url' => ''],
            ['sort' => 15, 'is_on' => 0, 'type' => 1, 'url_type' => 0, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-tools"></i>', 'name' => '功能測試', 'url' => ''],
        ];
        $submenu = [
            [ //系統管理
                ['sort' => 1, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,D,M,O,EX', 'fa5icon' => '<i class="nav-icon fas fa-users"></i>', 'name' => '管理員帳號管理', 'url' => 'admins'],
                ['sort' => 2, 'is_on' => 0, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,D,M,O,S', 'fa5icon' => '<i class="nav-icon fas fa-tools"></i>', 'name' => '後台選單管理', 'url' => 'mainmenus'],
                ['sort' => 3, 'is_on' => 0, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,D,M,O,S', 'fa5icon' => '<i class="nav-icon fas fa-globe-americas"></i>', 'name' => '國家資料設定', 'url' => 'countries'],
                ['sort' => 4, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'M', 'fa5icon' => '<i class="nav-icon fas fa-tools"></i>', 'name' => '公司資料設定', 'url' => 'companysettings'],
                ['sort' => 5, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'M', 'fa5icon' => '<i class="nav-icon fas fa-tools"></i>', 'name' => '系統參數設定', 'url' => 'systemsettings'],
                ['sort' => 8, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,D,M', 'fa5icon' => '<i class="nav-icon fas fa-tools"></i>', 'name' => 'IP管制設定', 'url' => 'ipSettings'],
                ['sort' => 9, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-clipboard-list"></i>', 'name' => '管理者登入登出紀錄', 'url' => 'adminLoginLog'],
            ],
            [ //商家管理
                ['sort' => 1, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,D,M,O,EX', 'fa5icon' => '<i class="nav-icon fas fa-list"></i>', 'name' => '商家列表管理', 'url' => 'vendors'],
                ['sort' => 2, 'is_on' => 0, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,D,M,O', 'fa5icon' => '<i class="nav-icon fas fa-store-slash"></i>', 'name' => '商家分店列表', 'url' => 'vendorshops'],
                ['sort' => 3, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,D,M,O,T', 'fa5icon' => '<i class="nav-icon fas fa-users"></i>', 'name' => '商家帳號列表', 'url' => 'vendoraccounts'],
            ],
            [ //物流管理
                ['sort' => 1, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,D,M,S', 'fa5icon' => '<i class="nav-icon fas fa-list-ul"></i>', 'name' => '物流廠商管理', 'url' => 'shippingvendors'],
                ['sort' => 2, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,D,M,O', 'fa5icon' => '<i class="nav-icon fas fa-shipping-fast"></i>', 'name' => '物流運費設定', 'url' => 'shippingfees'],
                ['sort' => 4, 'is_on' => 0, 'url_type' => 1, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-shipping-fast"></i>', 'name' => '渠道出貨資訊', 'url' => 'shippinginfo'],
                ['sort' => 3, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,D,M', 'fa5icon' => '<i class="nav-icon fas fa-shipping-fast"></i>', 'name' => '無法派送關鍵字管理', 'url' => 'addressDisable'],
            ],
            [ //商品管理
                ['sort' => 1, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,D,M,CP,EX,IM', 'fa5icon' => '<i class="nav-icon fas fa-list-ol"></i>', 'name' => '商品管理', 'url' => 'products'],
                ['sort' => 2, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'EX', 'fa5icon' => '<i class="nav-icon fas fa-archive"></i>', 'name' => '組合商品', 'url' => 'packages'],
                ['sort' => 3, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,M,S', 'fa5icon' => '<i class="nav-icon fas fa-underline"></i>', 'name' => '單位名稱設定', 'url' => 'unitnames'],
                ['sort' => 4, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,M,O,S', 'fa5icon' => '<i class="nav-icon fab fa-buromobelexperte"></i>', 'name' => '商品分類設定', 'url' => 'categories'],
                ['sort' => 6, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'M', 'fa5icon' => '<i class="nav-icon fas fa-tools"></i>', 'name' => '提貨日設定', 'url' => 'receiverbase'],
                ['sort' => 5, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,M,O,S', 'fa5icon' => '<i class="nav-icon fab fa-buromobelexperte"></i>', 'name' => '商品次分類設定', 'url' => 'subCategories'],
                ['sort' => 7, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,M,D,O', 'fa5icon' => '<i class="nav-icon fas fa-tools"></i>', 'name' => '商品變價管理', 'url' => 'priceChanges'],
            ],
            [ //使用者管理
                ['sort' => 1, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'M,O,P,SMS,SMM', 'fa5icon' => '<i class="nav-icon fas fa-users"></i>', 'name' => '使用者管理', 'url' => 'users'],
                ['sort' => 2, 'is_on' => 1, 'url_type' => 2, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-sms"></i>', 'name' => '發送簡訊功能', 'url' => 'sendSMS'],
                ['sort' => 3, 'is_on' => 1, 'url_type' => 1, 'open_window' => 1, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-comments"></i>', 'name' => '客服訊息平台', 'url' => 'https://app.crisp.chat/initiate/login/'],
            ],
            [ //團購管理
                ['sort' => 1, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,M,O', 'fa5icon' => '<i class="nav-icon fas fa-users-cog"></i>', 'name' => '團購設定', 'url' => 'groupbuyings'],
            ],
            [ //行銷策展
                ['sort' => 1, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,M,O,S', 'fa5icon' => '<i class="nav-icon fas fa-ad"></i>', 'name' => '首頁策展', 'url' => 'curations'],
                ['sort' => 2, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,M,O,S', 'fa5icon' => '<i class="nav-icon fas fa-ad"></i>', 'name' => '分類策展', 'url' => 'categorycurations'],
                ['sort' => 3, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,M,O', 'fa5icon' => '<i class="nav-icon fas fa-bullhorn"></i>', 'name' => '推薦註冊碼設定', 'url' => 'refercodes'],
                ['sort' => 4, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,M,O', 'fa5icon' => '<i class="nav-icon fas fa-bullhorn"></i>', 'name' => '優惠活動設定', 'url' => 'promoboxes'],
                ['sort' => 5, 'is_on' => 0, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,M,O', 'fa5icon' => '<i class="nav-icon fas fa-bullhorn"></i>', 'name' => '促銷代碼設定', 'url' => 'promocodes'],
                ['sort' => 6, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,M', 'fa5icon' => '<i class="nav-icon fas fa-link"></i>', 'name' => '短網址設定', 'url' => 'shortUrl'],
                ['sort' => 7, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,M,D,O,S', 'fa5icon' => '<i class="nav-icon fas fa-tools"></i>', 'name' => '搜尋標題設定', 'url' => 'searchtitles'],
                ['sort' => 8, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => 'N,M,D,O,S', 'fa5icon' => '<i class="nav-icon fas fa-tools"></i>', 'name' => '首頁橫幅圖管理', 'url' => 'indexBanners'],
            ],
            [ //統計資料
                ['sort' => 1, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-chart-bar"></i>', 'name' => '註冊人數統計', 'url' => 'usermonthlytotal'],
                ['sort' => 2, 'is_on' => 0, 'url_type' => 1, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-chart-bar"></i>', 'name' => '訂單每日統計(多)', 'url' => 'orderdailytotal'],
                ['sort' => 3, 'is_on' => 0, 'url_type' => 1, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-chart-bar"></i>', 'name' => '訂單每月統計(多)', 'url' => 'ordermonthlytotal'],
                ['sort' => 5, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-chart-bar"></i>', 'name' => '訂單區間統計', 'url' => 'intervalstatistics'],
                ['sort' => 6, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-chart-bar"></i>', 'name' => '訂單物流統計', 'url' => 'shippingmonthlytotal'],
                ['sort' => 7, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-chart-bar"></i>', 'name' => '商品銷量統計', 'url' => 'productsales'],
                ['sort' => 8, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-chart-bar"></i>', 'name' => '商家銷量統計', 'url' => 'vendorsales'],
                ['sort' => 9, 'is_on' => 0, 'url_type' => 1, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-chart-bar"></i>', 'name' => '促銷活動銷量統計', 'url' => 'promostatistics'],
                ['sort' => 4, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-chart-bar"></i>', 'name' => '訂單每月出貨統計', 'url' => 'ordermonthlyselltotal'],
                ['sort' => 2, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-chart-bar"></i>', 'name' => '訂單每日統計', 'url' => 'orderdailytotalOne'],
                ['sort' => 3, 'is_on' => 1, 'url_type' => 1, 'open_window' => 0, 'power_action' => '', 'fa5icon' => '<i class="nav-icon fas fa-chart-bar"></i>', 'name' => '訂單每月統計', 'url' => 'ordermonthlytotalOne'],
            ],
            [
                //預留一
            ],
            [
                //預留二
            ],
            [
                //預留三
            ],
            [
                //預留四
            ],
            [
                //預留五
            ],
            [
                //預留六
            ],
            [
                //功能測試
            ],
        ];

        if (env('DB_MIGRATE_MAINMENUS')) {
            $s1 = $s2 = $s3 = 0;
            for ($i=0;$i<count($mainmenu);$i++) {
                if ($mainmenu[$i]['type'] == 1) {
                    $s1++;
                    $sort = $s1;
                }elseif($mainmenu[$i]['type'] == 2){
                    $s2++;
                    $sort = $s2;
                }else{
                    $s3++;
                    $sort = $s3;
                }
                MainmenuDB::create([
                    'type' => $mainmenu[$i]['type'],
                    'code' => 'M'.($i+1).'S0',
                    'name' => $mainmenu[$i]['name'],
                    'fa5icon' => $mainmenu[$i]['fa5icon'],
                    'power_action' => $mainmenu[$i]['power_action'],
                    'url' => $mainmenu[$i]['url'],
                    'url_type' => $mainmenu[$i]['url_type'],
                    'open_window' => $mainmenu[$i]['open_window'],
                    'is_on' => $mainmenu[$i]['is_on'],
                    'sort' => $mainmenu[$i]['sort'],
                ]);
                if ($mainmenu[$i]['url_type']==0) {
                    if(!empty($submenu[$i])){
                        for ($j=0;$j<count($submenu[$i]);$j++) {
                            if (env('DB_MIGRATE_SUBMENUS')) {
                                SubmenuDB::create([
                                    'mainmenu_id' => $i+1,
                                    'code' => 'M'.($i+1).'S'.($j+1),
                                    'name' => $submenu[$i][$j]['name'],
                                    'fa5icon' => $submenu[$i][$j]['fa5icon'],
                                    'power_action' => $submenu[$i][$j]['power_action'],
                                    'url' => $submenu[$i][$j]['url'],
                                    'url_type' => $submenu[$i][$j]['url_type'],
                                    'open_window' => $submenu[$i][$j]['open_window'],
                                    'is_on' => $submenu[$i][$j]['is_on'],
                                    'sort' => $submenu[$i][$j]['sort'],
                                ]);
                            }
                        }
                    }
                }
            }
            echo "後台選單建立完成\n";
        }


        $PowerActions = [
            ['name' => '新增', 'code' => 'N'],
            ['name' => '刪除', 'code' => 'D'],
            ['name' => '開立', 'code' => 'NE'],
            ['name' => '作廢', 'code' => 'DE'],
            ['name' => '修改', 'code' => 'M'],
            ['name' => '取消', 'code' => 'CO'],
            ['name' => '複製', 'code' => 'CP'],
            ['name' => '修改數量', 'code' => 'MQ'],
            ['name' => '上線/架、啟用', 'code' => 'O'],
            ['name' => '排序', 'code' => 'S'],
            ['name' => '匯入', 'code' => 'IM'],
            ['name' => '匯出', 'code' => 'EX'],
            ['name' => '審查', 'code' => 'C'],
            ['name' => '執行', 'code' => 'E'],
            ['name' => '傳送門', 'code' => 'T'],
            ['name' => '購物金', 'code' => 'P'],
            ['name' => '其他', 'code' => 'X'],
            ['name' => '同步', 'code' => 'SY'],
            ['name' => '下載', 'code' => 'DL'],
            ['name' => '發送簡訊', 'code' => 'SMS'],
            ['name' => '發送訊息', 'code' => 'SMM'],
            ['name' => '發送信件', 'code' => 'SEM'],
            ['name' => '註記', 'code' => 'MK'],
            ['name' => '列印', 'code' => 'PR'],
            ['name' => '發退款信', 'code' => 'RM'],
            ['name' => '批次修改', 'code' => 'IMP'],
            ['name' => '物流匯入', 'code' => 'IMS'],
            ['name' => '訂單在途存貨', 'code' => 'IMT'],
            ['name' => '指定結案', 'code' => 'COL'],
            ['name' => '退貨處理', 'code' => 'RT'],
            ['name' => '折讓金處理', 'code' => 'AL'],
            ['name' => '結帳', 'code' => 'ST'],
            ['name' => '開立發票', 'code' => 'NI'],
            ['name' => '作廢發票', 'code' => 'CI'],
            ['name' => '重開票券', 'code' => 'REO'],
        ];

        if (env('DB_MIGRATE_POWER_ACTIONS')) {
            PowerActionDB::insert($PowerActions);
            echo "Power Actions 建立完成\n";
        }
    }
}
