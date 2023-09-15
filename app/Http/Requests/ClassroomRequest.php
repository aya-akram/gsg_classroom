<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
       $id= $this->route('classrooms');

        return [
            'name' => ['required','string','max:255',function($attribute,$value,$fail){
                if($value =='admin'){
                    return $fail('This value is forbiden!');
                }

            }],
            'section' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'room' => "nullable|string|max:255|unique:classrooms,room,$id",
            'cover_image' =>[
                'file',
               'max:1024' ,
                // Rule::dimensions([
                    // 'min_width' =>600,
                //     'min_height' => 600
                // ]),
            ],
            ];
    }
    public function messages():array
    {
        return[
        'required' => ':attribute Important!!!',
        'name.required' => 'The name is required!',
        'cover_image.max' =>'Image size is greater than 1M'

    ];

    }
}
