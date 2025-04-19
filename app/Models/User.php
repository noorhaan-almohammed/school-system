<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'phone_number'
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
            'phone_number'=>'string'
        ];
    }
    public function classRooms(){
        return $this->belongsToMany(Classroom::class , 'teaching_assignments','teacher_id','class_id');
    }
    public function subjects(){
        return $this->belongsToMany(Subject::class, 'teaching_assignments','teacher_id','subject_id');
    }
    public function receivedMessages(){
        return $this->hasMany(message::class, 'Recieve_id');
    }
    public function sentMessages(){
        return $this->hasMany(message::class, 'Sender_id');
    }
    public function overallPerformance(){
        return $this->hasOne(OverallPerformances::class ,'student_id');
    }
    public function parents(){
        return $this->belongsToMany(User::class, 'parent_students', 'student_id', 'parent_id');
    }
    public function children(){
        return $this->belongsToMany(User::class, 'parent_students', 'parent_id', 'student_id');
    }
    public function payments(){
        return $this->hasMany(payment::class , 'student_id');
    }
    public function subjectPerformances(){
        return $this->hasMany(SubjectPerformance::class, 'student_id');
    }
    public function attendances(){
        return $this->hasMany(Attendance::class, 'student_id');
    }
}
