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
            'title'  => 'required|min:10',
            'content'  => 'required|min:150'
        ];
    }
}