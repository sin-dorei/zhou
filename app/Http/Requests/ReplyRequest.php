<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'content' => 'required|max:200',
        ];
    }

    public function messages()
    {
        return [
            'content.max' => '回复内容不得超过200字',
        ];
    }
}
