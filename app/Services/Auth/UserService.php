<?php
namespace App\Services\Auth;

use App\Models\User;
use App\Models\ParentStudent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserService{
    public function createUser(array $data)
{
    try {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'class_id' => $data['class_id'] ?? null,
        ]);

        $role = $data['role'];
        $user->assignRole($role);

        if ($role === 'student') {
            isset($data['parent_id']) && ParentStudent::create([
                'student_id' => $user->id,
                'parent_id' => $data['parent_id'],
            ]);
        }

        $roleLabel = [
            'teacher' => 'المدرس',
            'student' => 'الطالب',
            'parent' => 'ولي الأمر'
        ];

        $roleName = $roleLabel[$role] ?? 'المستخدم';
        return "تم إنشاء $roleName بنجاح";

    } catch (\Exception $e) {
        Log::error($e);
        $roleLabel = [
            'teacher' => 'المدرس',
            'student' => 'الطالب',
            'parent' => 'ولي الأمر'
        ];
        $roleName = $roleLabel[$data['role']] ?? 'المستخدم';
        return "حدث خطأ أثناء إضافة $roleName";
    }
}
    public function updateUser($data, $id)
    {
        $user = User::findOrFail($id);

        $user->update($data);

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
        ]);
    }

    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'تم حذف '.$user->name.' بنجاح']);
    }
}
