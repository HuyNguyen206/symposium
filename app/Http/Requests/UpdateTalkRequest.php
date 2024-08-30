<?php

namespace App\Http\Requests;

use App\Enums\TalkType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTalkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->talk);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', Rule::unique('talks')->ignoreModel($this->talk), 'max:255'],
            'length' => 'sometimes|required',
            'type' => Rule::enum(TalkType::class),
            'abstract' => '',
            'organizer_notes' => '',
        ];
    }
}
