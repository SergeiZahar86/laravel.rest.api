<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    // имя таблицы
    protected $table = "country_lang";

    public $timestamps = false;

    // поля таблицы
    protected $fillable = [
        'id',
        'alias',
        'name',
        'name_en'
    ];
}
