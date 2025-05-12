<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'class_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'phone_number' => 'string'
        ];
    }
    // Get the classrooms associated with the teacher.
    public function classRooms()
    {
        return $this->belongsToMany(Classroom::class, 'teaching_assignments', 'teacher_id', 'class_id');
    }
    // Get the classrooms associated with the student.
    public function classRoom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }
    // Get the subjects assigned to the teacher.
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teaching_assignments', 'teacher_id', 'subject_id');
    }
    // Get the overall performance record for the student.
    public function overallPerformance()
    {
        return $this->hasOne(OverallPerformances::class, 'student_id');
    }
    // Get the parents associated with a student.
    public function parents()
    {
        return $this->belongsToMany(User::class, 'parent_students', 'student_id', 'parent_id')
            ->withPivot('id');
    }

    public function children()
    {
        return $this->belongsToMany(User::class, 'parent_students', 'parent_id', 'student_id')
            ->withPivot('id');
    }
    // Get the subject performance records for the student.
    public function subjectPerformances()
    {
        return $this->hasMany(SubjectPerformance::class, 'student_id');
    }
    // Get the attendance records for the student.
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

    public function teachingAssignments()
    {
        return $this->hasMany(TeachingAssignment::class, 'teacher_id');
    }
    public function getPerformanceForSubject($subject)
    {
        return $this->subjectPerformances()
            ->whereHas('teachingAssignment', function ($query) use ($subject) {
                $query->where('subject_id', $subject->id);
            })
            ->first();
    }
    //get student belong to teacher
    public function students()
    {
        return User::whereHas('classRoom', function ($query) {
            $query->whereIn('id', $this->classRooms()->pluck('classrooms.id'));
        })->whereHas('roles', function ($q) {
            $q->where('name', 'student');
        });
    }
}
