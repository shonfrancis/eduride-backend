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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('type', ['tutor', 'lsa', 'student_requirement']);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('description');
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('subject_id')->nullable()->constrained()->nullOnDelete();
            $table->string('education_level')->nullable();
            $table->string('qualification')->nullable();
            $table->string('experience')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('area')->nullable();
            $table->string('address')->nullable();
            $table->string('teaching_mode')->nullable(); // online, home, centre, online+home
            $table->string('availability')->nullable();
            $table->decimal('fee_min', 10, 2)->nullable();
            $table->decimal('fee_max', 10, 2)->nullable();
            $table->string('fee_type')->nullable(); // per hour, per month, etc.
            $table->text('requirements')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->json('media')->nullable();
            $table->enum('status', ['draft', 'pending_review', 'approved', 'rejected', 'published', 'suspended', 'expired'])->default('draft');
            $table->text('rejection_reason')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
