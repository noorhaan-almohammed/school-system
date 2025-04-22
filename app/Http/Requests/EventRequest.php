<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EventRequest extends FormRequest
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
            'title' => 'required|string|max:30',
            'date' => ['required', 'date', 'after:today'],
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:1|max:8',
            'description' => 'required|string|max:255',
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
            'title' => 'عنوان الحدث',
            'date' => 'تاريخ الحدث',
            'time' => 'وقت الحدث',
            'duration' => 'مدة الحدث',
            'description' => 'وصف الحدث',
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
            'title.required' => 'يرجى إدخال :attribute.',
            'title.string' => ':attribute يجب أن يكون نصاً.',
            'title.max' => 'لا يمكن أن يتجاوز :attribute :max حرفاً.',

            'date.required' => 'يرجى تحديد :attribute.',
            'date.date' => ':attribute يجب أن يكون تاريخاً صحيحاً.',
            'date.after' => ':attribute يجب أن يكون بعد تاريخ اليوم.',

            'time.required' => 'يرجى إدخال :attribute.',
            'time.date_format' => 'صيغة :attribute غير صحيحة. يجب أن تكون بصيغة 00:00.',

            'duration.required' => 'يرجى تحديد :attribute.',
            'duration.integer' => ':attribute يجب أن يكون رقماً صحيحاً.',
            'duration.min' => ':attribute يجب ألا يقل عن :min ساعة.',
            'duration.max' => ':attribute يجب ألا يزيد عن :max ساعات.',

            'description.string' => ':attribute يجب أن يكون نصاً.',
            'description.max' => 'لا يمكن أن يتجاوز :attribute :max حرفاً.',
            'description.required' => 'يرجى إدخال :attribute.',
        ];
    }
    /**
     * when validation error ocured send type form to open modal
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     * @return never
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('show_modal', 'event')
        );
    }
}
