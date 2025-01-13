<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin as AdminDB;

class CompanySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_en',
        'tax_id_num',
        'tel',
        'fax',
        'address',
        'address_en',
        'service_tel',
        'service_email',
        'website',
        'url',
        'fb_url',
        'Instagram_url',
        'Telegram_url',
        'line',
        'wechat',
        'admin_id',
    ];

    public function admin(){
        return $this->belongsTo(AdminDB::class);
    }

}














