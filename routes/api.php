<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;

/*
 * @description = api for controller AuthenticationController
 * @controller = AuthenticationController
 * @headers = null
 */
Route::controller(AuthenticationController::class)->group(function () {

    /*
     * prefix auth for api login and register and reset password and active the compte
     */
    Route::prefix("auth")->group(function () {
        /*
         * @description = user can create his account
         * @function = register
         * @method = POST
         * @params = null
         * @request = email, full_name, password, is_accept_privacy_policy
         */
        Route::post("/register", "register");
        /*
         * @description = after user create his account the system send the email for the verification
         * @function = validateEmail
         * @method = PUT
         * @params = email
         * @request = email
         */
        Route::put("/activate/account", "validateEmail");
        /*
         * @description = the user can login with the account after created and activated
         * @function = login
         * @method = POST
         * @params = null
         * @request = email, password
         */
        Route::post("/login", "login");
        /*
         * @description = redirection for the reset password
         * @function = redirectToResetPassword
         * @method = POST
         * @params = reset-type : email | phone
         * @request = null
         */
        Route::post("/redirect", "redirectToResetPassword");
        /*
         * @description = user can reset his password if forget it
         * @function = resetPassword
         * @method = PUT
         * @params = null
         * @request = newPassword, confirmPassword
         */
        Route::put("/reset-password", "resetPassword");

        /*
        * @description = api middleware for access to this api after the login
        * @middleware = sanctum
        * @params = null
        * @request = null
        * @headers = Authorization Bearer token
        */
        Route::middleware("auth:sanctum")->group(function () {

            /*
             * @description = user can show his information after login
             * @function = user
             * @method = get
             * @params = null
             * @request = null
             */
            Route::get("user", "user");
            /*
             *  @description = user can be logout after login
              * @function = user
              * @method = post
              * @params = null
              * @request = null
             */
            Route::post("logout", "logout");

        });


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
 * @description = api for controller CategoriesController with crud of category in blogs and news
 * @controller =  BlogsController
 * @header = null
 */
Route::controller(CategoriesController::class)->group(function () {
    /*
     * prefix for all api categories
     */
    Route::prefix("category")->group(function () {
        /*
         * @description = show all categories with the service specific : blogs or news
         * @function = index
         * @method = GET
         * @params = null
         * @request = null
         */
        Route::get("/{service}/", "index");
        /*
         * @description = show the specific category with the specific service
         * @function = show
         * @method = GET
         * @params = id, title
         * @request = null
         */
        Route::get("/{service}", "show");

        /*
         * @description = middleware for controller POST and DELETE and UPDATE after login and check if it admin or superadmin
         */
        Route::middleware("auth:sanctum")->group(function (){
            /*
             * @description = admin or superadmin can be add the new category in any service
             * @function = store
             * @method = POST
             * @params = type of service : blogs or news
             * @request = title, description, cover
             */
            Route::post("/{service}/add", "store");
            /*
             * @description = admin or superadmin can be remove the specific category in any service
             * @function = destroy
             * @method = DELETE
             * @params = id
             * @request = null
             */
            Route::delete("/{service}/delete", "destroy");
            /*
             * @description = admin or superadmin can update the specific category in any service
             * @function = update
             * @method = PUT
             * @params = id
             * @request = title, description, cover
             */
            Route::put("{service}/edit", "update");
        });
    });
});

