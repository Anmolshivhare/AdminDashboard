<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('
        ALTER TABLE `permissions`
            ADD `parent_id` BIGINT UNSIGNED NULL AFTER `guard_name`,
            ADD `_lft` INT UNSIGNED DEFAULT 0 NOT NULL AFTER `parent_id`,
            ADD `_rgt` INT UNSIGNED DEFAULT 0 NOT NULL AFTER `_lft`,
            ADD CONSTRAINT `permissions_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `permissions`(`id`) ON DELETE CASCADE;
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('
        ALTER TABLE `permissions`
            DROP FOREIGN KEY `permissions_parent_id_foreign`,
            DROP COLUMN `parent_id`,
            DROP COLUMN `_lft`,
            DROP COLUMN `_rgt`;
    ');
    }
};
