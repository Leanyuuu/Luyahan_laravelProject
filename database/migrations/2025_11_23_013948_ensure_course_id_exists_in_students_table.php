<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if column exists
        if (!Schema::hasColumn('students', 'course_id')) {
            // First, add the column without foreign key constraint
            Schema::table('students', function (Blueprint $table) {
                $table->unsignedBigInteger('course_id')->nullable()->after('address');
            });
            
            // Then add the foreign key constraint if courses table exists
            if (Schema::hasTable('courses')) {
                try {
                    DB::statement('ALTER TABLE `students` ADD CONSTRAINT `students_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE SET NULL');
                } catch (\Exception $e) {
                    // If foreign key already exists or fails, continue
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('students', 'course_id')) {
            Schema::table('students', function (Blueprint $table) {
                $table->dropForeign(['course_id']);
                $table->dropColumn('course_id');
            });
        }
    }
};
