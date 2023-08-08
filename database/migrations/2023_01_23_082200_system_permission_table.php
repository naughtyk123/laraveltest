<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SystemPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('system_permission', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('url')->nullable();
        //     $table->string('menu_type')->nullable();
        //     $table->string('menu_name')->nullable();
        //     $table->string('parent')->default(0);
        //     $table->integer('active_status')->default(1);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('system_permission');
    }
}
