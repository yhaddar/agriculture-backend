<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ["title", "description", "cover"];
    protected $casts = ["id" => "string"];

    public function blogs(){
        return $this->hasMany(Blog::class, "category_id", "id");
    }
}
