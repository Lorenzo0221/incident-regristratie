<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIncidentRequest extends FormRequest
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
     * @return array<str    ing, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'nullable|string|max:255',
            'type'        => 'required|in:geweld,ongeval,diefstal',
            'incident_at' => 'nullable|date',
            'attachment'  => 'nullable|file|max:10240',
        ];
    }
}
