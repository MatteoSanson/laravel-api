<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
    $project = $this->route('project');

    $titleRules = [
        'required',
        'min:3',
        'max:50',
        Rule::unique('projects', 'title')->ignore($project->id, 'id')
    ];

    if ($this->input('title') === $project->title) {
        // Rimuovi la regola di unicità se il titolo non viene modificato
        unset($titleRules[4]);
    }

    return [
        'title' => $titleRules,
        // 'language_framework' => 'nullable|min:2|max:50',
        'visibility' => 'nullable|max:7',
        'slug' => 'unique:projects,slug',
        'type_id' => ['nullable', 'exists:types,id'],
        'technologies' => ['nullable', 'exists:technologies,id'],
    ];
}
}