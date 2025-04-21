<?php
namespace App\Services\Subject;

use App\Models\Subject;
use Exception;

class SubjectService{
    /**
     * Create a new subject using the provided data.
     * This method wraps the subject creation process in a try-catch block
     * to handle and re-throw any exceptions with a descriptive error message.
     * @param array $data
     * @throws \Exception
     * @return Subject
     */
    public function createSubject(array $data){
        try{
            return Subject::create([
                'name'=>$data['name'],
            ]);
        }catch(Exception $e){
            throw new Exception('Error in Create Subject '.$e->getMessage());
        }
    }
    /**
     * Update an existing subject with the provided data.
     * @param array $data
     * @param \App\Models\Subject $subject
     * @throws \Exception
     * @return Subject
     */
    public function updateSubject(array $data , Subject $subject){
        try{
            $subject->update($data);
            return $subject->load(['teachers:name,email,phone_number','classes:name']);
        }catch(Exception $e){
            throw new Exception('Error in Update Subject '.$e->getMessage());
        }
    }
}
