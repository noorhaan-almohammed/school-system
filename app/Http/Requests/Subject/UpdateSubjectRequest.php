<?php

namespace App\Http\Requests\Subject;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateSubjectRequest extends FormRequest
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
            'name'=>[
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('subjects','name')->ignore($this->subject)
            ]
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new HttpResponseException(
            response()->json([
                'status'=>'error',
                'message'=>'فشلت عملية التحقق من البيانات. يرجى التأكد من صحة المعلومات المدخلة',
                'errors'=>$validator->errors()
            ],422)
        );
    }
    public function attributes(){
        return [
            'name'=>'أسم المادة التعليمية'
        ];
    }
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
