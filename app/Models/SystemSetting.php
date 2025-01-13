<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin as AdminDB;

class SystemSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'sms_supplier',
        'email_supplier',
        'invoice_supplier',
        'customer_service_supplier',
        'payment_supplier',
        'gross_weight_rate',
        'twpay_quota',
        'mitake_points',
        'admin_id',
        'disable_ip_start',
        'disable_ip_end',
        'invoice_count',
        'sf_token',
        'exchange_rate_USD',
        'exchange_rate_RMB',
        'exchange_rate_SGD',
        'exchange_rate_MYR',
        'exchange_rate_HKD',
        'exchange_rate_JPY',
        'exchange_rate_KRW',
    ];

    public function admin(){
        return $this->belongsTo(AdminDB::class);
    }
}
