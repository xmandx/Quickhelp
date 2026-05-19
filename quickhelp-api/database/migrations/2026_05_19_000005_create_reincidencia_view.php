<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE OR REPLACE VIEW reincidencia AS
            SELECT u.name_user, COUNT(s.id_sos) AS total_sos    
            FROM user u
            LEFT JOIN sos s ON u.id_user = s.id_user
            GROUP BY u.id_user, u.name_user
            ORDER BY total_sos DESC
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS reincidencia");
    }
};
