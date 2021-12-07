<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:teams',
            'age' => 'required',
            'number' => 'required',
            'postion' => 'required'
        ];
    }

    public function massages()
    {
        return [
            'name.required' => 'cannot be left blank',
            'name.unique' => 'already exist'
        ];
    }
}
