<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 08.05.2017
 * Time: 13:48
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            //'title'  => 'required|min:10',
            // нужна проверка на уникальность, и отдельный реквест для
            // метода update (либо допилить этот)
            'title'  => 'required|min:10|unique:news',
            'content'  => 'required|min:150'
        ];
    }
}