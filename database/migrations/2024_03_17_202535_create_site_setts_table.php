<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_setts', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('email')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
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
        Schema::dropIfExists('site_setts');
    }
}
