<?php

namespace App\Http\Requests\Api;

class FootballerRequest extends FormRequest
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
            if($this->exists('first_name'))
                $rules['first_name'] = ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/', 'min:2', 'max:25'];
            if($this->exists('last_name'))
                $rules['last_name'] = ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/', 'min:2', 'max:50'];
            if($this->exists('surname'))
                $rules['surname'] = ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/', 'min:2', 'max:25'];
            if($this->exists('birthdate'))
                $rules['birthdate'] = 'required|date|date_format:Y-m-d|before:-20 years';
            if($this->exists('kicking_foot'))
                $rules['kicking_foot'] = 'required|string|in:right,left';
            if($this->exists('transfer_cost'))
                $rules['transfer_cost'] = ['required','numeric','regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'];
        } else {
            $rules['first_name'] = ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/', 'min:2', 'max:25'];
            $rules['last_name'] = ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/', 'min:2', 'max:50'];
            $rules['surname'] = ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/', 'min:2', 'max:25'];
            $rules['birthdate'] = 'required|date|date_format:Y-m-d|before:-20 years';
            $rules['kicking_foot'] = 'required|string|in:right,left';
            $rules['transfer_cost'] = ['required','numeric','regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'];
        }
        if($this->exists('club_ids')) {
            $rules['club_ids'] = 'required|array';
            $rules['club_ids.*'] = 'required|numeric|exists:clubs,id';
        }
        return $rules;
    }
}
