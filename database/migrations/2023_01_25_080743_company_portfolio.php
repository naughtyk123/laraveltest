<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompanyPortfolio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_portfolio', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('business_reg_no')->nullable();
            $table->string('business_reg_cetificate')->nullable();
            $table->string('logo')->nullable();
            $table->string('approvale_letter')->nullable();
            $table->integer('industrial_sector')->nullable();
            $table->integer('subsector')->nullable();
            $table->string('website_url')->nullable();
            $table->string('clasification_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_map');
        
    }
}
