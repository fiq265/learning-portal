<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'notes',
        'assignment_id',
        'user_id',
    ];

    public function image()
    {
        return $this->hasMany(FileUpload::class, 'model_id', 'id')->where('model', '=', get_class($this));
    }
}
