<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TCandidate extends Model
{
    use HasFactory;

    protected $table = "t_candidate";

    protected $fillable = [
        'education_qualification_id', 
        'education_country_id', 
        'user_id',
        'education_name',
        'applicant_name', 
        'birthday', 
        'experience', 
        'last_position',
        'applied_position',
        'email',
        'phone',
        'resume'
    ];

    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class, 'education_country_id');
    }

    public function qualification()
    {
        return $this->belongsTo(MQualification::class, 'education_qualification_id');
    }

    public function skills()
    {
        return $this->belongsToMany(MSkills::class, 'candidate_skills', 'candidate_id', 'skill_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
