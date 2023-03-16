<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentUser extends Model
{
    use HasFactory;

    protected $table = 'assignment_user';
    protected $guarded = ['id'];
}
