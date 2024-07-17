<?php

namespace App\Http\Requests;

use App\Enums\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class RealEstateStoreRequest extends FormRequest
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
            'price'=>['required','numeric'],
            'category' => ['required', new Enum(Category::class)],
            'address'=>['required','string','min:12'],
            'bedroom'=>['required','min:1','integer'],
            'bathroom'=>['required','min:1','integer'],
            'area'=>['required','numeric'],
            'floor'=>['required','integer'],
            'parking'=>['required','integer'],
            'images' => ['required','array'],
            'images.*' => ['image','mimes:jpeg,png','max:2048']
        ];
    }
}
