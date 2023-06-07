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
        Schema::create('user_platform', function (Blueprint $table) {
            $table->id();
            $table->foreignId('platform_id')->constrained('platforms');
            $table->foreignId('user_id')->constrained('users');
            $table->integer('clicks')->default(0);
            $table->string('path')->nullable();
            $table->integer('platform_order')->default(0);
            $table->string('label')->nullable();
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
        Schema::dropIfExists('user_platform');
    }
};
