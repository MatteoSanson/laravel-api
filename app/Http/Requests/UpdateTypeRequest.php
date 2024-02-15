<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTypeRequest extends FormRequest
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
        $type = $this->route('type');
        
    $titleRules = [
        'required',
        'max:30',
        'min:2',
        'unique:types,title',
        Rule::unique('types', 'title')->ignore($type->id, 'id')
    ];

    if ($this->input('title') === $type->title) {
        // Rimuovi la regola di unicità se il titolo non viene modificato
        unset($titleRules[4]);
    }

    return [
        'title' => $titleRules,
    ];
    }
}
