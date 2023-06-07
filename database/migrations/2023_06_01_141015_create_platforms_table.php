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
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('base_url')->nullable();
            $table->string('icon')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('placeholder_en')->nullable();
            $table->string('placeholder_fr')->nullable();
            $table->string('placeholder_sp')->nullable();
            $table->string('description_en')->nullable();
            $table->string('description_fr')->nullable();
            $table->string('description_sp')->nullable();
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
        Schema::dropIfExists('platforms');
    }
};
