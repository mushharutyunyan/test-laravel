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
        } else {
            $rules['name'] = ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/', 'min:2', 'max:25', 'unique:clubs,name'];
            $rules['foundation_date'] = 'required|date|date_format:Y-m-d|before:today';
        }
        if($this->exists('league_ids')) {
            $rules['league_ids'] = 'required|array';
            $rules['league_ids.*'] = 'required|numeric|exists:leagues,id';
        }
        if($this->exists('footballer_ids')) {
            $rules['footballer_ids'] = 'required|array';
            $rules['footballer_ids.*'] = 'required|numeric|exists:footballers,id';
        }
        if($this->exists('coach_ids')) {
            $rules['coach_ids'] = 'required|array';
            $rules['coach_ids.*'] = 'required|numeric|exists:coaches,id';
        }
        return $rules;
    }
}
