<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private $columns = ['linkedin', 'instagram', 'tiktok'];

    public function up(): void
    {
        foreach ($this->columns as $column) {
            if (!Schema::hasColumn('company', $column)) {
                Schema::table('company', function (Blueprint $table) use ($column) {
                    $table->text($column)->nullable()->after('line');
                });
            }
        }
    }

    public function down(): void
    {
        foreach ($this->columns as $column) {
            if (Schema::hasColumn('company', $column)) {
                Schema::table('company', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
