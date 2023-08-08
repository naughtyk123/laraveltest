<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('last_name',255)->nullable();
            $table->string('mobile',255)->nullable();
            $table->string('second_mobile_number',255)->nullable();
            $table->string('location',255)->nullable();
            $table->integer('user_role')->nullable();
            $table->integer('active_status')->nullable();
            $table->integer('is_admin')->nullable();
            $table->string('address',255)->nullable();
            $table->string('nic',255)->nullable();
            $table->string('last_login_time',255)->nullable();
            $table->string('last_login_mod',255)->nullable();
            $table->integer('failed_over_login_attempts')->nullable();
            $table->string('live_location',255)->nullable();
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
        Schema::dropIfExists('users');
    }
}
