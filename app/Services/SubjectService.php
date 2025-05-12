<?php
namespace App\Services;

use App\Models\Subject;
use Exception;
use Illuminate\Support\Facades\Log;
use Mockery\Matcher\Subset;

class SubjectService{
    /**
     * Create a new subject using the provided data.
     * This method wraps the subject creation process in a try-catch block
     * to handle and re-throw any exceptions with a descriptive error message.
     * @param array $data
     * @return string|Subject
     */
    public function createSubject(array $data){
        try{
            Subject::create([
                'name'=>$data['name'],
            ]);
            $message = 'تم إنشاء مادة ال '.$data['name'].' بنجاح';
            return $message ;
        }catch(Exception $e){
            Log::error('Error in create subject '.$e->getMessage());
            $message = 'حدث خطأ أثناء عملية الإنشاء  ';
            return $message ;
        }
    }
    /**
     * Update an existing subject with the provided data.
     * @param array $data
     * @param mixed $id
     * @return mixed|string|\Illuminate\Http\JsonResponse
     */
    public function updateSubject(array $data , $id){
        try{
            $subject = Subject::findOrFail($id);
            $subject->update($data);
            return response()->json([
                'id' => $subject->id,
                'name' => $subject->name,
            ]);
        }catch(Exception $e){
            Log::error('Error when update subject '.$e->getMessage());
            $message = 'حدث خطأ أثناء تحديث المادة '.Subject::find($id)->name ;
            return $message;
        }
    }
    public function delete($id){
        try{
            $subject = Subject::find($id);
            $subjectName = $subject->name;
            $subject->delete();
            return [
                'status'=>'success',
                'message'=>'تم حذف مادة ال '.$subjectName.' بنجاح'
            ];
        }catch(Exception $e){
            Log::error('Error when delete subject '.$e->getMessage());
            return [
                'status'=>'error',
                'message'=>'حدث خطأ أثناء عملية الحذف'
            ];
        }
    }
}
