<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ShortFormRequest extends Request
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
        if(!$this->input('cancel')){
            return [
                'name' => 'required|max:255',
                'body' => 'sometimes|required',
                'description' => 'sometimes|required', 
                'note'=> 'sometimes|required',
            ];
        } else {
            return array();
        }
    }
}
