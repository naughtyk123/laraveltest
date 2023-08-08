<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPortfolio extends Model
{
    use HasFactory;
    protected $table = 'company_portfolio';
    protected $fillable = [
        'name',
        'business_reg_no',
        'business_reg_cetificate',
        'logo',
        'approvale_letter',
        'industrial_sector',
        'subsector',
        'website_url',
        'clasification_no',

    ];
}
