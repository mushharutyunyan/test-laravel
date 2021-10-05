<?php

namespace App\Http\Requests\Api\Filter;

use App\Http\Requests\Api\FormRequest;

class CoachFilterRequest extends FormRequest
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
        $rules = [];

        if($this->exists('search')) {
            $rules['search'] = 'required|min:2|max:20|string|regex:/(^[A-Za-z]+$)+/';
        }
        return $rules;
    }
}
