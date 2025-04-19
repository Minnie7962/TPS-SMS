<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('student_records', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('admission_number')->nullable();
            $table->date('admission_date');
            $table->foreignId('my_class_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('section_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('is_graduated')->default(false);
            $table->unique('admission_number');

            $table->string('contact_number')->nullable();
            $table->string('father_full_name')->nullable();
            $table->string('father_phone_number')->nullable();
            $table->string('father_address')->nullable();
            $table->string('mother_full_name')->nullable();
            $table->string('mother_phone_number')->nullable();
            $table->string('mother_address')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->string('emergency_contact_address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('student_records');
    }
};
