<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission_remove extends Model
{
    use HasFactory;
    protected $table = 'permission_map_remove';
    protected $fillable = [
        'permission_id',
        'parent_id',
        'created_at' ,
        'updated_at' ,
        'user_id',
        'group_id',


 
    ];
    public function permission_detail()
    {
        return $this->hasOne(SystemPermission::class, 'id', 'permission_id');
    }
}
