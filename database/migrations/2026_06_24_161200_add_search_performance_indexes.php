<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $statements = [
            "ALTER TABLE cp_location ADD INDEX idx_cp_location_id_location (_id, location)",
            "ALTER TABLE provinces ADD INDEX idx_provinces_province_id (province_id)",
            "ALTER TABLE company ADD INDEX idx_company_category_public_type (category, public, type)",
            "ALTER TABLE our_customer ADD INDEX idx_our_customer_company_deleted (company, deleted)",
            "ALTER TABLE blog ADD INDEX idx_blog_status_category_id (status, category, id)",
        ];

        foreach ($statements as $sql) {
            try {
                DB::statement($sql);
            } catch (\Throwable $e) {
                // ignore when index already exists or table is different per environment
            }
        }
    }

    public function down(): void
    {
        $statements = [
            "ALTER TABLE cp_location DROP INDEX idx_cp_location_id_location",
            "ALTER TABLE provinces DROP INDEX idx_provinces_province_id",
            "ALTER TABLE company DROP INDEX idx_company_category_public_type",
            "ALTER TABLE our_customer DROP INDEX idx_our_customer_company_deleted",
            "ALTER TABLE blog DROP INDEX idx_blog_status_category_id",
        ];

        foreach ($statements as $sql) {
            try {
                DB::statement($sql);
            } catch (\Throwable $e) {
                // ignore when index does not exist
            }
        }
    }
};
