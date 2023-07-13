<?php

namespace App\Http\Requests\User;

use App\Actions\Chat\DTO\SearchUsersDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'name_query' => 'string|required|max:256',
            'except' => 'array|nullable',
            'except.*' => 'integer',
        ];
    }

    /**
     * Create DTO from request data
     *
     * @return SearchUsersDTO
     */
    public function data(): SearchUsersDTO
    {
        $data = $this->input();

        $dto = new SearchUsersDTO($data['name_query']);
        if (!empty($data['except'])) {
            $dto->setExcept($data['except']);
        }

        return $dto;
    }
}
