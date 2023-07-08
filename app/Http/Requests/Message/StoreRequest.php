<?php

namespace App\Http\Requests\Message;

use App\Actions\Chat\DTO\MessageStoreDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'chat_id' => 'integer|required|exists:App\Models\Chat,id',
            'user_id' => 'integer|required|exists:App\Models\User,id',
            'text' => 'string|required|max:512',
            'file_id' => 'nullable',
        ];
    }

    /**
     * Create DTO from request data
     *
     * @return MessageStoreDTO
     */
    public function data(): MessageStoreDTO
    {
        $user = Auth::user();
        if (!$user) {
            abort(403);
        }

        $data = $this->input();

        $dto = new MessageStoreDTO($data['chat_id'], $user->id, $data['text']);
        if (!empty($data['file_id'])) {
            $dto->setFileId($data['file_id']);
        }

        return $dto;
    }
}
