<?php

namespace App\Http\Requests\Api;

class ClubRequest extends FormRequest
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
        if($this->id) {
            $rules['name'] = ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/', 'min:2', 'max:25', 'unique:clubs,name,'.$this->id];
            if($this->exists('foundation_date'))
                $rules['foundation_date'] = 'required|date|date_format:Y-m-d|before:today';
            if($this->exists('league_id'))
                $rules['league_id'] = 'required|numeric|exists:leagues,id';
        } else {
            $rules['name'] = ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/', 'min:2', 'max:25', 'unique:clubs,name'];
            $rules['foundation_date'] = 'required|date|date_format:Y-m-d|before:today';
            $rules['league_id'] = 'required|numeric|exists:leagues,id';
        }
        return $rules;
    }
}
