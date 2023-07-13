<?php

namespace App\Http\Requests\Chat;

use App\Actions\Chat\DTO\ManageChatDTO;
use Auth;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ManageRequest extends FormRequest
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
            'id' => 'integer|nullable|exists:App\Models\Chat,id',
            'title' => 'string|required|max:256',
            'users' => 'array',
            'users.*' => 'integer',
        ];
    }

    /**
     * Create DTO from request data
     *
     * @return ManageChatDTO
     */
    public function data(): ManageChatDTO
    {
        $data = $this->input();

        $dto = new ManageChatDTO($data['title']);
        if (!empty($data['id'])) {
            $dto->setChatId($data['id']);
        }
        $data['users'][] = Auth::user()->id;
        $dto->setUsersIds($data['users']);

        return $dto;
    }
}
