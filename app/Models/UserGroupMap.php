<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroupMap extends Model
{
    use HasFactory;
    protected $table = 'user_group_map';
    protected $fillable = [
        'user_id',
        'group_id',
        'created_at' ,
        'updated_at' ,
        'created_by',
 
    ];
    public function group_detail()
    {
        return $this->hasOne(UserGroup::class, 'id', 'group_id');
    }
}
