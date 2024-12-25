<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogClicks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('blog_clicks'))
        {
            Schema::create('blog_clicks', function (Blueprint $table) {
                $table->engin = 'InnoDB';
                $table->charset = 'utf8';
                $table->collation = 'utf8_unicode_ci';
                $table->id();
                $table->integer('blogId')->nullable();
                $table->integer('contactId')->nullable();
                $table->tinyInteger('read_mail')->nullable();
                $table->dateTime('created', $precision = 0)->nullable();
                $table->dateTime('updated', $precision = 0)->nullable();
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
        Schema::dropIfExists('blog_clicks');
    }
}
