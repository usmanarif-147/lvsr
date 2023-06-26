<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('username')->nullable();
            $table->text('bio')->nullable();
            $table->string('phone')->nullable();
            $table->string('job_title')->nullable();
            $table->string('company')->nullable();
            $table->string('photo')->nullable();
            $table->string('cover_photo')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('work_position')->nullable();
            $table->string('password');
            $table->string('user_direct')->nullable();
            $table->string('clicks')->default(0);
            $table->string('dob')->nullable();
            $table->tinyInteger('private')->default(0);
            $table->tinyInteger('is_verified')->default(0);

            $table->tinyInteger('fetured')->default(0);
            $table->string('fcm_token')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('plan_subscribed_till')->nullable();
            $table->softDeletes();
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
};
