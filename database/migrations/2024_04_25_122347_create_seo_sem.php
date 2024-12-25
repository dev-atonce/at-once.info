<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoSem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_sem', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->id();
            $table->integer('member');
            $table->integer('company');
            $table->text('type')->nullable();
            $table->text('word')->nullable();
            $table->text('difficult')->nullable();
            $table->tinyInteger('selected')->nullable();
            $table->dateTime('checked', $precision = 0)->nullable();
            $table->integer('sort');
            $table->integer('created_by');
            $table->dateTime('created_at', $precision = 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo_sem');
    }
}
