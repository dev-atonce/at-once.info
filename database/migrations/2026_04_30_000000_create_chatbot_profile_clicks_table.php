<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatbotProfileClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('chatbot_profile_clicks')) {
            Schema::create('chatbot_profile_clicks', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->charset = 'utf8';
                $table->collation = 'utf8_unicode_ci';
                $table->id();
                $table->unsignedBigInteger('company_id')->nullable()->comment('Company ID จาก table company');
                $table->string('profile_url')->nullable()->comment('URL key ของบริษัท เช่น siamnistrans');
                $table->string('category')->nullable()->comment('Category key เช่น logistics-warehouse-delivery');
                $table->string('lang', 5)->nullable()->comment('ภาษา: th, en, jp, zh');
                $table->string('ip', 50)->nullable()->comment('IP Address ของผู้คลิ้ก');
                $table->text('user_agent')->nullable()->comment('Browser/Device info');
                $table->timestamp('created_at')->useCurrent();
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
        Schema::dropIfExists('chatbot_profile_clicks');
    }
}
