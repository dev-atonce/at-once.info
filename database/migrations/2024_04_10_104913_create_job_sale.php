<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('job_sale'))
        {
            Schema::create('job_sale', function (Blueprint $table) {
                
                $table->engine = 'InnoDB';
                $table->charset = 'utf8';
                $table->collation = 'utf8_unicode_ci';
                $table->id();
                $table->integer('company')->nullable();
                $table->integer('assignment')->nullable();
                $table->dateTime('call_again', $precision = 0)->nullable();
                $table->integer('call_again_by')->nullable();
                $table->dateTime('follow', $precision = 0)->nullable();
                $table->integer('follow_by')->nullable();
                $table->dateTime('on_process', $precision = 0)->nullable();
                $table->integer('on_process_by')->nullable();
                $table->dateTime('done', $precision = 0)->nullable();
                $table->integer('done_by')->nullable();
                $table->dateTime('not_interest', $precision = 0)->nullable();
                $table->integer('not_interest_by')->nullable();
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
        Schema::dropIfExists('job_sale');
    }
}
