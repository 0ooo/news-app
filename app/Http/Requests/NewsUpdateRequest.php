<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 10.05.2017
 * Time: 12:48
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsUpdateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Валидация данных из формы редактирования новости
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:news,title,' . request()->id,
            'content'  => 'required|min:150'
        ];
    }
}