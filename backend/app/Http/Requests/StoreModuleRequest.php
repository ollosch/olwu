<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\ModuleTypes;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreModuleRequest extends FormRequest
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
            'type' => ['required', 'string', Rule::enum(ModuleTypes::class)],
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }
}
