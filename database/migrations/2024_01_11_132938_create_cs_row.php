<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsRow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cs_row')) {
            Schema::create('cs_row', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->charset = 'utf8';
                $table->collation = 'utf8_unicode_ci';
                $table->id();
                $table->integer('company')->nullable();
                $table->text('first_name')->nullable();
                $table->text('last_name')->nullable();
                $table->integer('name_th')->nullable();
                $table->integer('name_en')->nullable();
                $table->integer('category')->nullable();
                $table->text('telephone')->nullable();
                $table->text('email')->nullable();
                $table->text('website')->nullable();
                $table->text('ranking')->nullable();
                $table->text('assignment')->nullable();
                $table->text('remark_color')->nullable();
                $table->dateTime('booking', $precision = 0)->nullable();
                $table->integer('booking_by')->nullable();
                $table->dateTime('refuse', $precision = 0)->nullable();
                $table->integer('refuse_by')->nullable();
                $table->dateTime('confirm', $precision = 0)->nullable();
                $table->integer('confirm_by')->nullable();
                $table->dateTime('created', $precision = 0)->nullable();
                $table->integer('created_with')->nullable();
                $table->dateTime('designed', $precision = 0)->nullable();
                $table->integer('designed_with')->nullable();
                $table->integer('company')->nullable();
                $table->text('pvw')->nullable();
                $table->text('usr')->nullable();
                $table->text('ctr')->nullable();
                $table->text('status')->nullable();
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
        Schema::dropIfExists('cs_row');
    }
}
