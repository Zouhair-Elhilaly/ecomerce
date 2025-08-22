<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updatePrd extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' =>'required',
            'description' =>'required',
            'id_category' =>'required',
            'stock' =>'required',
            'price' =>'required',
        ];
    }
     public function messages(){
        return [
            'name_category.required' => 'please Enter Your category name',
            'description.required' => 'please Enter Your description',
            'id_category.required' => 'please Enter Your category',
            'stock.required' => 'please Enter Your stock',
             'price.required' =>  'please Enter Your price product',
        ];
    }
}
