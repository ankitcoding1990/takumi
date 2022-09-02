<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Str;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryRequest extends FormRequest
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
        if($this->isMethod('put')){
            return [
                'name'  =>  'required|string',
                'slug'  =>  'sometimes|required|string|unique:categories,slug,'.$this->category,
            ];
        }
        return [
            'name'  =>  'required|string',
            'slug'  =>  'required|string|unique:categories',
        ];
    }
    public function prepareForValidation(){
        if($this->name){
            $this->merge([
                'slug'  =>  Str::slug($this->name),
            ]);
        }
    }
    public  function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

}
