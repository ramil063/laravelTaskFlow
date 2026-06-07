<?php

namespace App\Http\Requests\Task;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TODO only for tests
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'       => [
                'required',
                'string',
                'max:255',
                Rule::unique('tasks', 'title')
                    ->where(
                        fn ($q) => $q->where('project_id', $this->route('project')->id)
                    ),
            ],
            'description' => ['nullable', 'string'],
        ];
    }
}
