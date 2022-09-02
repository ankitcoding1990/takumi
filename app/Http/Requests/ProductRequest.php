<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
                'sku' => 'numeric|required',
                'name' => 'sometimes|required|string|unique:products,name,'.$this->product,
                'category_id' => 'required|numeric',
                'price' => 'integer|required',
                'discount' => 'nullable',
            ];
        }
        return [
            'sku' => 'numeric|required',
            'name' => 'required|string|unique:products',
            'category_id' => 'required|numeric',
            'price' => 'integer|required',
            'discount' => 'nullable',
        ];
    }
    public  function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

}
