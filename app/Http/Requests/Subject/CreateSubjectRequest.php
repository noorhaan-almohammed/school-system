<?php

namespace App\Http\Requests\Subject;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class CreateSubjectRequest extends FormRequest
{
    /**
     * Determine if the authenticated user is authorized to make this request.
     * Only users with the 'admin' role are allowed to create a subject.
     * @return bool
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
     * Define the validation rules for creating a subject.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|min:3|max:255|unique:subjects,name'
        ];
    }
    /**
     * Customize the failed validation response.
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     * @return never
     */
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new HttpResponseException(
            response()->json([
                'status'=>'error',
                'message'=>'فشلت عملية التحقق من البيانات. يرجى التأكد من صحة المعلومات المدخلة',
                'errors'=>$validator->errors()
            ],422)
        );
    }
    /**
     * Define human-readable attribute names for better error messages.
     * @return array{name: string}
     */
    public function attributes(){
        return [
            'name'=>'أسم المادة التعليمية'
        ];
    }
    /**
     * Summary of messages
     * @return array{max: string, min: string, required: string, string: string, unique: string}
     */
    public function messages(){
        return [
            'required'=>':attribute هو حقل مطلوب',
            'string'=>':attribute يجب أن يكون حقل نصي',
            'min'=>':attribute يجب ألا يقل عن :min محرف',
            'max'=>':attribute يجب ألا يزيد عن :max محرف',
            'unique'=>':attribute يجب أن يكون فريد',
        ];
    }
}
