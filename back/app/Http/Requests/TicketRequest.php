<?php

namespace App\Http\Requests;

use App\Traits\FailedValidationAsjson;
use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    use FailedValidationAsjson;

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
        return [
            'name' => ['required', 'string', 'max:255'],
            'numbers' => ['required', 'array'],
        ];
    }
}
