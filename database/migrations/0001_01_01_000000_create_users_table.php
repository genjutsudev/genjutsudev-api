<?php

declare(strict_types=1);

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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            $table->increments('nid');
            $table->string('profilelink', 16)->nullable();
            $table->string('email')->nullable();
            $table->dateTime('email_verified_at')->nullable(); # timestamp
            $table->dateTime('email_changed_at')->nullable();
            $table->string('password')->nullable();
            $table->dateTime('password_changed_at')->nullable();
            $table->string('profilename', 32)->nullable();
            $table->date('birthday')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('type', [
                'regular',  // Обычный
                'admin',    // Администратор
                'api',      // API
            ])->default('regular')->comment('тип уч. записи');
            $table->string('token', 64)->nullable();
            $table->boolean('is_active')->default(false);
            $table->dateTime('activity_at')->nullable();
            $table->rememberToken();
            $table->string('api_key', 128)->nullable()->default(null);
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unique('id', 'unq_uu_id');
            $table->unique('profilelink', 'unq_uu_profilelink');
            $table->unique(['email', 'type'], 'unq_uu_email_type');
            $table->index('profilename', 'idx_uu_profilename');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
