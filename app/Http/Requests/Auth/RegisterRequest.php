<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Rules\StrongPassword;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /**
         * @var User $user
         */
        $user = Auth::user();
        return Auth::check() && $user->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'password'=>['required','string','confirmed',new StrongPassword()],
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string',
            'phone_number' => 'nullable|string|min:8|max:100|unique:users,phone_number',
            'role' => 'required|string|in:teacher,parent,student',
        ];
    }

    /**
     * Define human-readable attribute names for validation errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'الاسم',
            'email' => 'الايميل',
            'password' => 'كلمة المرور',
            'phone_number' => 'رقم الهاتف',
        ];
    }

    /**
     * Define custom error messages for validation failures.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute هو حقل مطلوب.',
            'max' => ':attribute يجب ألا يتجاوز :max محرف.',
            'min' => ':attribute على الأقل :min محرف.',
            'unique' => ':attribute يجب أن يكون فريد.',
            'string' => ':attribute يجب أن يكون حقل نصي.',
            'email' => ':attribute يجب أن يكون بريد الكتروني'
        ];
    }

}
