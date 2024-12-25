<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToDoList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('to_do_list'))
        {
            Schema::create('to_do_list', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->charset = 'utf8';
                $table->collation = 'utf8_unicode_ci';
                $table->id();
                $table->text('type')->nullable();
                $table->text('list')->nullable();
                $table->text('do')->nullable();
                $table->text('test')->nullable();
                $table->text('done')->nullable();
                $table->dateTime('created', $precision = 0)->nullable();
                $table->dateTime('updated',$precision = 0)->nullable();
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
        Schema::dropIfExists('to_do_list');
    }
}
