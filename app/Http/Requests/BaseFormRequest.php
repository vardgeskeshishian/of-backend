<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BaseFormRequest extends FormRequest
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
            'creator_id' => [
                'nullable',
                'integer',
                Rule::exists(User::class, 'id'),
            ],
            'updater_id' => [
                'nullable',
                'integer',
                Rule::exists(User::class, 'id'),
            ],
            'created_at' => ['nullable', 'date'],
            'updated_at' => ['nullable', 'date'],
        ];
    }
}
