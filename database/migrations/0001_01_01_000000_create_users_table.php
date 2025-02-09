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
    {/**
     * table authentication for register and login
     */
        Schema::create('authentications', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile')->default("profile.png");
            $table->enum("role", ["agricultor", "admin", "superadmin"])->default("agricultor");
            $table->boolean("is_accept_privacy_policy")->default(false);
            $table->enum("type", ["google", "facebook", "twitter", "oauth"])->default("oauth");
            $table->string("social_id")->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        /*
         * table session for stock the data about user after login
         */
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignUuid('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        /*
         * table users for add more information professionel and personnel about the user
         */
        Schema::create('users', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("user_id");
            $table->foreign("user_id")->references("id")->on("authentications")->onDelete("cascade");
            $table->enum("genre", ["male", "female"]);
            $table->string("city");
            $table->date("date_birth");
            $table->string("experience");
            $table->string("phone")->unique();
            $table->string("domain");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authentications');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists("personal_access_token");
        Schema::dropIfExists("users");
    }
};
