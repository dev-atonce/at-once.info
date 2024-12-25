<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobAppointment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('job_appointment'))
        {
            Schema::create('job_appointment', function (Blueprint $table) {
                
                $table->engine = 'InnoDB';
                $table->charset = 'utf8';
                $table->collation = 'utf8_unicode_ci';
                $table->id();
                $table->integer('company')->nullable();
                $table->dateTime('date', $precision = 0)->nullable();
                $table->integer('by')->nullable();
                $table->dateTime('created_at', $precision = 0)->nullable();
                $table->dateTime('updated_at', $precision = 0)->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_appointment');
    }
}
