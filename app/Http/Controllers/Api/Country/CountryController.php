<?php

namespace App\Http\Controllers\Api\Country;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;

use App\Models\CountryModel;

use Validator;

class CountryController extends Controller {
    // response() - Функция ответа создает экземпляр ответа или получает экземпляр фабрики ответов:
    // get() - возвращает все записи из модели



    // метод возвращает все записи из таблицы country
    public function country() {
        // для отладки
        //$dddd = CountryModel::get();
        //dd($dddd);
        return response()->json(CountryModel::get(), 200);

    }




    // получение  записи из таблицы по id
    // вы можете также получить конкретные записи с помощью find()
    public function countryById($id) {
        $country = CountryModel::find($id);
        if ( is_null($country) )
        {
            // если не найден -> возвращаем ошибку
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($country, 200);
    }


    // добавление записи в таблицу
    public function countrySave(Request $req) {
       /* $rules = [
            'iso' => 'required|min:2|max:2',
            'name' => 'required|min:3',
            'name_en' => 'required|min:3'
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }*/
        // create() - создания и сохранения модели одной строкой
        //dd($req->all());
        $country = CountryModel::create($req->all());
        //dd($country);
        return response()->json($country, 201);
    }



    /* добавление записи в таблицу методом firstOrCreate(). Метод firstOrCreate пытается
     найти запись БД, используя указанные пары столбец/значение. Если модель
     не найдена в БД, запись будет вставлена в БД с указанными атрибутами.
    https://laravel.ru/posts/658  */
    public function countrySaveFOC(Request $req){
        $country = CountryModel::firstOrCreate($req->all());
        return response()->json($country, 201);
    }



    // редактирование записи в таблице. можно редактировать только одно поле
    public function countryEdit(Request $req, $id) {
       /* $rules = [
            'iso' => 'required|min:2|max:2',
            'name' => 'required|min:3',
            'name_en' => 'required|min:3'
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }*/
        $country = CountryModel::find($id);
        /*if ( is_null($country) ) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }*/
        $country->update($req->all());
        return response()->json($country, 200);
    }






    public function countryDelete(Request $req, $id) {
        $country = CountryModel::find($id);
        if ( is_null($country) ) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $country->delete();
        return response()->json('', 204);
    }
}
