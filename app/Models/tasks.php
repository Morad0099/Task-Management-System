<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tasks extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'description',
        'status',
        'date',
        'rate'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
