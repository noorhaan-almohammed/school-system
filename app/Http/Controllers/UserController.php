<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function createUser(Request $request)
{
    // تحقق من صحة البيانات
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email|max:255',
        'password' => 'required|string',
        'phone_number' => 'required|string|min:8|max:100'
    ]);

    try {
        // إنشاء المستخدم
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number']
        ]);

        // تعيين الدور
        $user->assignRole('teacher');

        // رد النجاح مع تفاصيل المستخدم
        return redirect()->back()->with('success', 'تم إنشاء المدرس بنجاح');
    } catch (\Exception $e) {
        // في حال حدوث أي استثناء آخر
        Log::error($e);

        return redirect()->back()->with('error', 'حدث خطأ أثناء إضافة المدرس');
    }
}

//     public function createUser(Request $request)
// {
//     $data = $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|email|unique:users,email|max:255',
//         'password' => 'required|string',
//         'phone_number' => 'required|string|min:8|max:100'
//     ]);

//     try {
//         $user = User::create([
//             'name' => $data['name'],
//             'email' => $data['email'],
//             'password' => Hash::make($data['password']),
//             'phone_number' => $data['phone_number']
//         ]);

//         $user->assignRole('teacher');

//         return response()->json([
//             'success' => true,
//             'message' => 'تم إنشاء المدرس بنجاح',
//             'user' => $user
//         ]);
//      } catch (ValidationException $e) {
//         return response()->json([
//             'success' => false,
//             'message' => 'أخطاء تحقق',
//             'errors' => $e->errors()
//         ], 422);
//      } catch (\Exception $e) {
//         Log::error($e);

//         return response()->json([
//             'success' => false,
//             'message' => 'حدث خطأ أثناء إضافة المدرس'
//         ], 500);
//     }
// }

}
