<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('job_log'))
        {
            Schema::create('job_log', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->charset = 'utf8';
                $table->collation = 'utf8_unicode_ci';
                $table->id();
                $table->integer('company')->nullable();
                $table->integer('job_cs')->nullable();
                $table->text('user')->nullable();
                $table->longText('message')->nullable();
                $table->integer('pin')->nullable();
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
        Schema::dropIfExists('job_log');
    }
}
