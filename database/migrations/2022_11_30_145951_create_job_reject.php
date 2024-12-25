<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobReject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('job_reject')) {
            Schema::create('job_reject', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->charset = 'utf8';
                $table->collation = 'utf8_unicode_ci';
                $table->id();
                $table->integer('job_progress')->nullable();
                $table->integer('from')->nullable();
                $table->integer('to')->nullable();
                $table->char('reject')->nullable();
                $table->text('remark')->nullable();
                $table->text('image')->nullable();
                $table->text('message')->nullable();
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
        Schema::dropIfExists('job_reject');
    }
}
