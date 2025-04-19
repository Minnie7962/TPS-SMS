<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Required core fields
            'admission_date' => 'required|date',
            'my_class_id' => 'required|exists:my_classes,id',
            'section_id' => 'required|exists:sections,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            
            // Optional fields with validation rules when provided
            'admission_number' => 'nullable|unique:student_records,admission_number',
            'other_names' => 'nullable|string|max:255',
            'birthday' => 'required|date',
            'gender' => 'required|string|in:Male,Female',
            'blood_group' => 'nullable|string|in:A+,A-,B+,B-,AB+,Ab-,O+,O-', // Made optional
            'address' => 'required|string',
            'religion' => 'nullable|string', // Made optional
            'nationality' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|max:2048',
            
            // Make email and password optional
            'email' => 'nullable|email|unique:users,email',
            'password' => 'nullable|string|min:6',
            'password_confirmation' => 'nullable|same:password',
            
            // Parent information fields (optional)
            'father_full_name' => 'nullable|string|max:255',
            'father_phone_number' => 'nullable|string|max:20',
            'father_address' => 'nullable|string',
            'mother_full_name' => 'nullable|string|max:255',
            'mother_phone_number' => 'nullable|string|max:20',
            'mother_address' => 'nullable|string',
            
            // Emergency contact fields (optional)
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_relationship' => 'nullable|string|max:255',
            'emergency_contact_number' => 'nullable|string|max:20',
            'emergency_contact_address' => 'nullable|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'my_class_id.required' => 'Select a class',
            'section_id.required' => 'Select a section',
            'admission_date.required' => 'Admission date is required',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'my_class_id' => 'class selection',
            'section_id' => 'section selection',
        ];
    }
}
