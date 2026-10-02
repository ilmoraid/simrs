<?php

use App\Enums\Authorization\Permissions\GeneralPermissions;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tableNames = config("permission.table_names");

        Schema::table($tableNames["permissions"], function (
            Blueprint $table,
        ): void {
            $table->string("name", 225)->change(); // For MyISAM use string('name', 225); // (or 166 for InnoDB with Redundant/Compact row format)
            $table->string("label", 225);
            $table->text("description")->nullable();
            $table->string("module")->default(GeneralPermissions::GENERAL);
            $table->string("guard_name", 25)->change(); // For MyISAM use string('guard_name', 25);
        });

        Schema::table($tableNames["roles"], function (Blueprint $table): void {
            $table->string("name", 255)->change(); // For MyISAM use string('name', 225); // (or 166 for InnoDB with Redundant/Compact row format)
            $table->string("guard_name", 25)->change(); // For MyISAM use string('guard_name', 25);
            $table->text("description")->nullable();
            $table->boolean("is_system")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("permissions", function (Blueprint $table) {
            //
        });

        Schema::table("roles", function (Blueprint $table) {
            //
        });
    }
};
