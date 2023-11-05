<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('student_id')->nullable();
            $table->string('addmission_id')->nullable();
            $table->string('student_image')->nullable();
            $table->string('name_bn')->nullable();
            $table->string('name_en')->nullable();
            $table->foreignId('school_class_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('school_class_section_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('roll')->nullable();
            $table->enum('group', ['Science', 'Commerce', 'Humanities'])->nullable();
            $table->string('ssc_roll')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->enum('religion', ['Islam', 'Hindu', 'Others'])->nullable();
            $table->string('birth_certificate_no')->nullable();
            $table->timestamp('dob')->nullable();
            $table->boolean('has_stipend')->default(false);
            $table->boolean('have_siblings_studying')->default(false);
            $table->foreignId('student_category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('student_quota_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name_of_siblings_studying')->nullable();
            $table->string('roll_of_siblings_studying')->nullable();
            $table->string('class_of_siblings_studying')->nullable();
            $table->string('freedomfighter_certificate_no')->nullable();
            $table->string('previous_institute')->nullable();
            $table->string('previous_study_class')->nullable();
            $table->string('division')->nullable();
            $table->string('zilla')->nullable();
            $table->string('upazilla_or_thana')->nullable();
            $table->string('union')->nullable();
            $table->string('postoffice')->nullable();
            $table->string('village')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('post_code')->nullable();
            $table->string('fathers_name_bn')->nullable();
            $table->string('mothers_name_bn')->nullable();
            $table->string('fathers_name_en')->nullable();
            $table->string('mothers_name_en')->nullable();
            $table->string('fathers_nid_no')->nullable();
            $table->string('mothers_nid_no')->nullable();
            $table->string('fathers_bc_no')->nullable();
            $table->string('mothers_bc_no')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('gurdian_in_absence_of_parent_en')->nullable();
            $table->string('gurdian_in_absence_of_parent_bn')->nullable();
            $table->string('gurdian_nid_no')->nullable();
            $table->string('relation_with_gurdian')->nullable();
            $table->string('gurdians_monthly_income')->nullable();
            $table->string('gurdians_occupation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
