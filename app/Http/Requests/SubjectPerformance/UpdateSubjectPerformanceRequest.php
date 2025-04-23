<?php

namespace App\Http\Requests\SubjectPerformance;

use App\Models\TeachingAssignment;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UpdateSubjectPerformanceRequest extends FormRequest
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
        if(!Auth::chech() || !$user->hasRole('teacher')){
            return false ;
        }
        $TeachingAssignmentId = $this->input('teaching_assignment_id');
        $TeachingAssignment = TeachingAssignment::findOrFail($TeachingAssignmentId);
        return $user->id === $TeachingAssignment->teacher_id ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_id'=>'required|exists:users,id',
            'teaching_assignment_id'=>'required|exists:teaching_assignments,id',
            'grad'=>'required|int|min:0|max:100',
            'comment'=>'nullable|string',
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new HttpResponseException(
            response()->json([
                'status'=>'error',
                'message'=>'فشلت عملية التحقق من البيانات يرجى التأكد من صحة المعلومات المدخلة',
                'errors'=>$validator->errors()
            ],422)
        );

    }
    public function attributes(){
        return [
            'student_id'=>'رقم الطالب',
            'teaching_assignment_id'=>'رقم المهمة التعليمية',
            'grad'=>'الدرجة',
            'comment'=>'الملاحظة',
        ];
    }
    public function messages(){
        return [
            'required'=>':attribute هو حقل مطلوب',
            'string'=>':attribute يجب أن يكون حقل نصي',
            'min'=>':attribute يجب ألا يقل عن :min محرف',
            'max'=>':attribute يجب ألا يزيد عن :max محرف',
            'exists'=>'قيمة الحقل :attribute يجب أن تكون قيمة صالحة'
        ];
    }
}
