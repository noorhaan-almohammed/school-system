<?php

namespace App\Services;

use App\Models\Subject;
use App\Models\SubjectPerformance;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class SubjectPerformanceService
{
    public function createSubjectPerformance($data){
        try{
            SubjectPerformance::create($data);
            return 'تمت الإضافة بنجاح';
        }catch(Exception $e){
            Log::error('Error when create SubjectPerformance '.$e->getMessage());
            return 'حدث خطأ أثناء عملية الإضافة';
        }
    }
    public function updateSubjectPerformance($data,$id){
        try{
            $subjectPerformance = SubjectPerformance::findOrFail($id);
            $subjectPerformance->update($data);
            return 'تمت التعديل بنجاح';
        }catch(Exception $e){
            Log::error('Error when update SubjectPerformance '.$e->getMessage());
            return 'حدث خطأ أثناء عملية التعديل';
        }
    }
    public function deleteSubjectPerformance($id){
        try{
            $subjectPerformance = SubjectPerformance::findOrFail($id);
            $subjectPerformance->delete();
            return 'تمت الحذف بنجاح';
        }catch(Exception $e){
            Log::error('Error when delete SubjectPerformance '.$e->getMessage());
            return 'حدث خطأ أثناء عملية الحذف';
        }
    }

    public function showPerformanceForSubject(User $student,Subject $subject)
    {
        return $student->getPerformanceForSubject($subject);
    }
    public function showPerformanceForAllSubjects(User $student)
    {
        return $student->load('subjectPerformances');
    }
}
