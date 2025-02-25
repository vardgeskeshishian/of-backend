<?php

namespace App\Http\Requests\Menu\ItemCategory\Item;

use App\Models\MenuItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreUserRequest
 *
 * This class handles the validation of the user data
 * submitted for storing a new user in the system.
 *
 * @package App\Http\Requests
 * @property array $category The name of the user.
 */
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
            'item.name'   => ['required', 'string', 'max:255'],
            'item.value' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique(MenuItem::class, 'value')->ignore(
                    $this->route('item') ?? null,
                ),
            ],
        ];
    }
}
