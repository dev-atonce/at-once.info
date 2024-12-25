<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('job_activity'))
        {
            Schema::create('job_activity', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->charset = 'utf8';
                $table->collation = 'utf8_unicode_ci';
                $table->id();
                $table->text('job_cs')->nullable();
                $table->tinyInteger('message')->nullable();
                $table->tinyInteger('created_by')->nullable();
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
        Schema::dropIfExists('job_activity');
    }
}
