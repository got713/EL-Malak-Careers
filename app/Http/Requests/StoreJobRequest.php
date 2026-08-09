<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Must be logged in and a company
        return auth()->check() && auth()->user()->hasRole('company');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'type' => 'required|in:full-time,part-time,remote,internship,contract',
            'location' => 'required|string|max:255',
            'vacancies' => 'required|integer|min:1',
            'experience_years' => 'required|string|max:255',
            'salary_range' => 'nullable|string|max:255',
        ];
    }
}
