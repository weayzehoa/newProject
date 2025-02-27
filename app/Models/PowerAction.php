<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PowerAction extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $fillable = [
        'name',
        'code',
    ];
}
