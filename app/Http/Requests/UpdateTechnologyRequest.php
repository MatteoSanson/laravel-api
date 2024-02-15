<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTechnologyRequest extends FormRequest
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
        $technology = $this->route('technology');
        // ['required', 'max:40', 'min:2', 'unique:technologies,title']
    $titleRules = [
        'required',
        'max:40',
        'min:2',
        'unique:technologies,title',
        Rule::unique('technologies', 'title')->ignore($technology->id, 'id')
    ];

    if ($this->input('title') === $technology->title) {
        // Rimuovi la regola di unicità se il titolo non viene modificato
        unset($titleRules[4]);
    }

    return [
        'title' => $titleRules,
    ];
    }
}
