<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Submenu as SubmenuDB;

class Mainmenu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'code',
        'fa5icon',
        'name',
        'url',
        'url_type',
        'open_window',
        'is_on',
        'sort',
    ];

    //關聯submenu
    public function submenu(){
        return $this->hasMany(SubmenuDB::class)->where('is_on',1)->orderBy('sort','asc');
    }
}
