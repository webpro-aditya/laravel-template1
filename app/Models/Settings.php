<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    public $timestamps = false;

    protected $fillable = [
        'setting_name',
        'setting_value',
        'setting_date',
        'setting_status'
    ];
}
