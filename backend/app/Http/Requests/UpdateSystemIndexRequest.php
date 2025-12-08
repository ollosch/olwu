<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateSystemIndexRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'term' => ['required', 'string', 'max:255'],
            'definition' => ['required', 'string', 'max:2048'],
            'references' => ['nullable', 'string', 'max:255'],
            'links' => ['nullable', 'string', 'max:255'],
        ];
    }
}
