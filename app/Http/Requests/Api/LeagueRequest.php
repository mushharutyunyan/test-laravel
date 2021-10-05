<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\FormRequest;

class LeagueRequest extends FormRequest
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
            $rules['name'] = ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/', 'min:2', 'max:25', 'unique:leagues,name,'.$this->id];
        } else {
            $rules['name'] = ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/', 'min:2', 'max:25', 'unique:leagues,name'];
        }
        if($this->exists('club_ids')) {
            $rules['club_ids'] = 'required|array';
            $rules['club_ids.*'] = 'required|numeric|exists:clubs,id';
        }
        return $rules;
    }
}
