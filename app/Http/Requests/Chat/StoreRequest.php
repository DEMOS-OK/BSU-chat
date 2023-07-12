<?php

namespace App\Http\Requests\Chat;

use App\Actions\Chat\DTO\StoreChatDTO;
use Auth;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|required|max:256',
            'users' => 'array',
            'users.*' => 'integer',
        ];
    }

    /**
     * Create DTO from request data
     *
     * @return StoreChatDTO
     */
    public function data(): StoreChatDTO
    {
        $data = $this->input();

        $dto = new StoreChatDTO($data['title']);
        $data['users'][] = Auth::user()->id;
        $dto->setUsersIds($data['users']);

        return $dto;
    }
}
