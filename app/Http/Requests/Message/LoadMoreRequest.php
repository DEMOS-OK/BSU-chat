<?php

namespace App\Http\Requests\Message;

use App\Actions\Chat\DTO\GetMessagesForChatDTO;
use App\Models\Chat;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class LoadMoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $chat = Chat::findOrFail((int)$this->input('chat_id'));
        return Gate::allows('load-more-messages', $chat);
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
