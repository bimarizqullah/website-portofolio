<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->string('cv_link')->nullable();
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('level', ['Junior', 'Mid-Level','Senior'])->default('Junior');
            $table->string('icon')->nullable();
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('project_link')->nullable();
            $table->string('tech_stack')->nullable();
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('project_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('image_path');
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();
            $table->text('message');
            $table->string('photo')->nullable();
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('companys', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('subject')->nullable();
            $table->text('message');
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('project_images');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('users');
    }
};
