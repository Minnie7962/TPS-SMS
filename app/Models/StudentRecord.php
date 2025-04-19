<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StudentRecord extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'admission_number', 
        'admission_date', 
        'my_class_id', 
        'section_id', 
        'user_id',
        'is_graduated',
        'contact_number',
        'father_full_name',
        'father_phone_number',
        'father_address',
        'mother_full_name',
        'mother_phone_number',
        'mother_address',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_number',
        'emergency_contact_address'
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'admission_date' => 'datetime:Y-m-d',
        'is_graduated' => 'boolean',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        //gets only active users
        static::addGlobalScope('notGraduated', function (Builder $builder) {
            $builder->where('is_graduated', false);
        });
    }

    /**
     * Get formatted admission date attribute.
     * 
     * @param mixed $value
     * @return string
     */
    public function getAdmissionDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    /**
     * Get the MyClass that owns the Section.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function myClass()
    {
        return $this->belongsTo(MyClass::class);
    }

    /**
     * Get the section that owns the StudentRecord.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Get the user that owns the StudentRecord.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The academicYears that belong to the StudentRecord.
     */
    public function academicYears(): BelongsToMany
    {
        return $this->belongsToMany(AcademicYear::class)
            ->as('studentAcademicYearBasedRecords')
            ->using(AcademicYearStudentRecord::class)
            ->withPivot('my_class_id', 'section_id');
    }

    /**
     * Get current academic year.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function currentAcademicYear()
    {
        if (!$this->user || !$this->user->school || !$this->user->school->academicYear) {
            return $this->academicYears()->whereRaw('1 = 0'); // Return empty relationship
        }
        
        return $this->academicYears()->wherePivot('academic_year_id', $this->user->school->academicYear->id);
    }
}
