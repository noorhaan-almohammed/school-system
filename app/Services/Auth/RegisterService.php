<?php
namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class RegisterService{
    public function createUser(array $data){
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone_number' => $data['phone_number']
            ]);

            $role = $data['role'] ?? null;
            if ($role) {
                $user->assignRole($role);
            }

            $roleLabel = [
                'teacher' => 'المدرس',
                'student' => 'الطالب',
                'parent' => 'ولي الأمر'
            ];
            $roleName = $roleLabel[$role] ?? 'المستخدم';

            $message = "تم إنشاء $roleName بنجاح";
            return $message;

        } catch (\Exception $e) {
            Log::error($e);
            $message = 'حدث خطأ أثناء إضافة المدرس';
            return $message;
        }
    }
}
