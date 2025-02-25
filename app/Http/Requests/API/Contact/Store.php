<?php

namespace App\Http\Requests\API\Contact;

use App\Enums\ContactTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Store extends FormRequest
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
            'type'  =>  ['required', Rule::enum(ContactTypes::class)],
            'name'  =>  ['nullable', 'string', 'max:255'],
            'phone' =>  ['nullable', 'string', 'numeric', 'min:6'],
            'email' =>  ['nullable', 'string', 'email', 'max:255'],
            'text'  =>  ['nullable', 'min:1', 'max:500'],
            'send_to_whatsapp' => ['nullable', 'boolean'],
            'send_to_telegram' => ['nullable', 'boolean'],
        ];
    }
}
