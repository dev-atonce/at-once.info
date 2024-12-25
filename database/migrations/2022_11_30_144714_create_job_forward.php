<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobForward extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('job_forward')) 
        {
            Schema::create('job_forward', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->charset = 'utf8';
                $table->collation = 'utf8_unicode_ci';
                $table->id();
                $table->integer('job_progress')->nullable();
                $table->integer('content')->nullable();
                $table->dateTime('content_date',$precision = 0)->nullable();
                $table->integer('designer')->nullable();
                $table->dateTime('designer_date',$precision = 0)->nullable();
                $table->integer('qc')->nullable();
                $table->dateTime('qc_date',$precision = 0)->nullable();
                $table->dateTime('created', $precision = 0)->nullable();
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
        Schema::dropIfExists('job_forward');
    }
}
