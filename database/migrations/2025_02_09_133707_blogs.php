<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
        * table Blogs_category for category of each blog
        */
        Schema::create("Blogs_categories", function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("title")->nullable(false);
            $table->longText("description")->nullable(false);
            $table->string("cover")->nullable(false);
            $table->timestamps();
        });

        /*
         * table Blogs for all blogs about agriculture
         */
        Schema::create("Blogs", function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("title")->nullable(false);
            $table->longText("description")->nullable(false);
            $table->string("image")->nullable(false);
            $table->uuid("user_id");
            $table->foreign("user_id")->references("id")->on("users")->onDelete(null);
            $table->uuid("category_id");
            $table->foreign("category_id")->references("id")->on("Blogs_categories")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("Blogs_categories");
        Schema::dropIfExists("Blogs");
    }
};
