<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => 'required|unique:projects,title|min:3|max:50',
            // 'language_framework' => 'nullable|min:2|max:50',
            'visibility' => 'nullable|max:7',
            'slug' => 'unique:projects,slug',
            'type_id' => ['nullable', 'exists:types,id'],
            'technologies' => ['nullable', 'exists:technologies,id'],
        ];
    // }

    // /**
    //  * messaggio per gli errori.
    //  *
    //  * @return array<string, 
    //  */
    // public function messages()
    // {
    //     return [
    //         'title.min' => 'Il campo "title" deve essere lungo almeno :min caratteri.',
    //         'title.max' => 'Il campo "title" non può superare i :max caratteri.',
    //         'type.max' => 'Il campo "type" non può superare i :max caratteri.',
    //     ];
    }
}
