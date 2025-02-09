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
        /*
         * table favorite for stock the favorite blogs and courses for each user
         */
        Schema::create("Favorites", function (Blueprint $table){
            $table->uuid("id")->primary();
            $table->enum("services_type", ["BLOGS", "COURSES"]);
            $table->uuid("service_id");
            $table->foreign("service_id")->references("id")->on("Blogs")->onDelete("cascade");
            $table->uuid("user_id");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("Favorites");
    }
};
