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
        * table _category for category of each blog
        */
        Schema::create("categories", function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("title")->nullable(false);
            $table->longText("description")->nullable(false);
            $table->string("cover")->nullable(false);
            $table->uuid("user_id")->nullable(true);
            $table->foreign("user_id")->references("id")->on("authentications")->onDelete("set null");
            $table->string("category_type");
            $table->timestamps();
        });

        /*
         * table Blogs for all blogs about agriculture
         */
        Schema::create("blogs", function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("title")->nullable(false);
            $table->longText("description")->nullable(false);
            $table->string("image")->nullable(false);
            $table->uuid("user_id");
            $table->foreign("user_id")->references("id")->on("authentications")->onDelete(null);
            $table->uuid("category_id");
            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("categories");
        Schema::dropIfExists("blogs");
    }
};
