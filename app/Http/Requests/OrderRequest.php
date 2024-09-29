<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        /** @var User $user */
        $user = $this->user();

        $this->merge([
            'uuid' => Str::uuid()->toString(),
            'user_id' => $user->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'uuid' => ['required', 'uuid'],
            'user_id' => ['required', Rule::exists('users', 'id')],
            'goods_cost' => ['required', 'numeric'],
            'total_cost' => ['required', 'numeric'],
            'items' => ['required', 'array'],
            'items.*.good_id' => ['required', Rule::exists('goods', 'id')],
            'items.*.quantity' => ['required', 'integer', 'gte:1'],
        ];
    }

    public function authorize(): bool
    {
        return boolval($this->user());
    }
}
