<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'user_id',
    ];

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function image()
    {
        return $this->hasMany(FileUpload::class, 'model_id', 'id')->where('model', '=', get_class($this));
    }
}
