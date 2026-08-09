<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Must be logged in, a company, and own the job
        $job = $this->route('job');
        return auth()->check() && 
               auth()->user()->hasRole('company') && 
               $job->company_id === auth()->user()->company->id;
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
