<?php

use Illuminate\Support\Facades\Route;

Route::get('/validate/email', function (\Illuminate\Http\Request $request) {
    $user = $request->query("email");
    return view('mail/validate', ["user" => $user]);
})->name("home");

/*
 * return the user to the page validate email fron the boite email
 */
//
//Route::get("auth/google", [\App\Http\Controllers\AuthenticationController::class, "loginWithGoogle"])->name("auth.google");
//Route::get("/login/google/callback", [\App\Http\Controllers\AuthenticationController::class, "handleGoogleCallback"]);
