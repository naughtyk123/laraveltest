<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemPermission extends Model
{
    use HasFactory;
    protected $table = 'system_permission';

    protected $fillable = [
        'url',
        'menu_type',
        'icon',
        'created_at' ,
        'updated_at' ,
        'menu_name',
        'parent',
        'active_status',
        'description',


 
    ];
    public function sub_functions()
    {
    return $this->hasMany(self::class, 'parent', 'id');
    }
}
