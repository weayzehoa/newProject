<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //使用軟刪除

use App\Models\Mainmenu as MainmenuDB;

class Submenu extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mainmenu_id',
        'code',
        'fa5icon',
        'name',
        'url',
        'url_type',
        'open_window',
        'is_on',
        'sort',
        // 'power_action', //關閉修改
    ];

    public function mainmenu(){
        return $this->belongsTo(MainmenuDB::class);
    }
}
