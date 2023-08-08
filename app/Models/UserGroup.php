<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'date:Y-m-d'
    ];
    protected $table = 'user_groups';
    protected $fillable = [
        'group_name',
        'description',
        'created_at' ,
        'updated_at' ,
        'active_status',
 
    ];
    public $sortable = ['id','description','created_at'];
}
