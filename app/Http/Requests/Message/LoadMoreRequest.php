<?php

namespace App\Http\Requests\Message;

use App\Actions\Chat\DTO\GetMessagesForChatDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoadMoreRequest extends FormRequest
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
            'step' => 'integer|nullable',
            'chat_id' => 'integer|required|exists:App\Models\Chat,id'
        ];
    }

    /**
     * Returns data transfer object from request data
     *
     * @return GetMessagesForChatDTO
     */
    public function data(): GetMessagesForChatDTO
    {
        $data = $this->input();

        $dto = new GetMessagesForChatDTO($data['chat_id']);
        if (!empty($data['step'])) {
            $dto->setStep($data['step']);
        }

        return $dto;
    }
}
