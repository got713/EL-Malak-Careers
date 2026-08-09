<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'location' => ['nullable', 'string', 'max:255'],
            'religion' => ['nullable', 'string', 'max:255'],
            'nationality' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:male,female'],
            'education_status' => ['nullable', 'in:studying,graduated'],
            'education_degree' => ['nullable', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'years_of_experience' => ['nullable', 'string', 'max:50'],
            'worker_type'         => ['nullable', 'in:white_collar,blue_collar'],
            'confession_father' => ['nullable', 'string', 'max:255'],
            'applicant_church' => ['nullable', 'string', 'max:255'],
            'current_company' => ['nullable', 'string', 'max:255'],
            'employment_status' => ['nullable', 'string', 'in:employed,unemployed,other'],
            'application_date' => ['nullable', 'date'],
            'languages' => ['nullable', 'array'],
            'microsoft_office_skills' => ['nullable', 'integer', 'min:1', 'max:5'],
            'experience_details' => ['nullable', 'string'],
            'last_salary' => ['nullable', 'string', 'max:255'],
        ];
    }
}
