<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIncidentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            $data = $this->validate([
                'title' => 'required',
                'description' => 'required',
                'location' => 'required',
                'type' => 'required',
                'incident_at' => 'required|date',
                'attachment' => 'nullable|file|max:2048',
            ])
        ];
    }
}
