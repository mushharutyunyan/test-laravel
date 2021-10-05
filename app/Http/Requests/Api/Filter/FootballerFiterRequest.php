<?php

namespace App\Http\Requests\Api\Filter;


use App\Http\Requests\Api\FormRequest;

class FootballerFiterRequest extends FormRequest
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
        if($this->exists('kicking_foot')) {
            $rules['kicking_foot'] = 'required|in:right,left';
        }
        if($this->exists('max_transfer_cost')) {
            $rules['max_transfer_cost'] = ['required','numeric','regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'];
        }
        if($this->exists('min_transfer_cost')) {
            $rules['min_transfer_cost'] = ['required','numeric','regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'];
        }
        return $rules;
    }
}
