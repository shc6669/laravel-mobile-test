<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MQualification extends Model
{
    use HasFactory;

    protected $table = "m_education_qualification";

    protected $fillable = ['name'];

    protected $guarded = [];
}
