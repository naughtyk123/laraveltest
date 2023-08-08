<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SystemPermitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_permission', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string('menu_type')->nullable();
            $table->string('menu_name')->nullable();
            $table->string('parent')->default(0);
            $table->string('active_status')->nullable();
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
        //
    }
}
