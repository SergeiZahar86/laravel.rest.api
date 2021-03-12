<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    // имя таблицы
    protected $table = "country_lang";


    /*  По умолчанию Eloquent ожидает наличия в ваших таблицах
     столбцов created_at и updated_at. Если вы не хотите, чтобы они
     автоматически обрабатывались в Eloquent, установите свойство
     $timestamps класса модели в false  */
    public $timestamps = false;

    // поля таблицы
    protected $fillable = [
        'id',
        'alias',
        'name',
        'name_en'
    ];
}
