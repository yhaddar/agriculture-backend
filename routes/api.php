<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
 *  api for controller AuthenticationController
 * @controller = AuthenticationController
 * @headers = null
 */
Route::controller(AuthenticationController::class)->group(function () {

    /*
     * prefix auth for api login and register and reset password and active the compte
     */
    Route::prefix("auth")->group(function () {
        /*
         * @function = register
         * @method = POST
         * @params = null
         * @request = email, full_name, password, is_accept_privacy_policy
         */
        Route::post("/register", "register");
        /*
         * @function = validateEmail
         * @method = PUT
         * @params = email
         * @request = email
         */
        Route::put("/activate/account", "validateEmail");
        /*
         * @function = login
         * @method = POST
         * @params = null
         * @request = email, password
         */
        Route::post("/login", "login");
        /*
         * @function = redirectToResetPassword
         * @method = POST
         * @params = reset-type : email | phone
         * @request = null
         */
        Route::post("/redirect", "redirectToResetPassword");
        /*
         * @function = resetPassword
         * @method = PUT
         * @params = null
         * @request = newPassword, confirmPassword
         */
        Route::put("/reset-password", "resetPassword");

    });

    /*
     * prefix oauth2 for login and register with google and facebook and twitter
     */
    Route::prefix("oauth2/login")->group(function () {

        Route::prefix("{social}")->group(function () {
            Route::get("/", "loginWithOauth");
            Route::get("/callback", "handleSocialCallback");
        });

    });

});

/*
 * api middleware for access to this api after the login
 * @method = middleware : sanctum
 * @params = null
 * @request = null
 * @headers = Authorization Bearer token
 */
Route::middleware("auth:sanctum")->group(function () {

    /*
     * api for get data user and logout
     * @controller = AuthenticationController
     */
    Route::controller(AuthenticationController::class)->group(function () {

        Route::prefix("auth")->group(function () {
            /*
             * @function = user
             * @method = get
             * @params = null
             * @request = null
             */
            Route::get("user", "user");
            /*
              * @function = user
              * @method = post
              * @params = null
              * @request = null
             */
            Route::post("logout", "logout");
        });

    });

});
