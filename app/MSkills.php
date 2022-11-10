<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MSkills extends Model
{
    use HasFactory;

    protected $table = "m_skills";

    protected $fillable = ['name'];

    protected $guarded = [];
}
