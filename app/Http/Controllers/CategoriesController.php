<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->regex = [
            "/^[a-zA-Z0-9\s?.]+$/",
            "/^[a-zA-Z0-9\s?.!@#$%^&*()_+=,-;:'\"\\[\\]{}|<>\/]*$/"
        ];
        $this->role = Auth::authenticate()->role;
    }

    /**
     * show all categories from the blogs and the news
     */
    public function index(string $service): JsonResponse
    {
        try {

            $categories = Category::where("category_type", "=", $service)->get();

            return response()->json([
                "data" => $categories->isEmpty() ? "no category available" : $categories,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * add new category of all type of categories
     */
    public function store(Request $request, string $service): JsonResponse
    {
        try {

            if ($this->role === RoleEnum::ADMIN->value || $this->role === RoleEnum::SUPERADMIN->value) {

                $request->validate([
                    "title" => "required|string|max:15",
                    "description" => "required|string|min:15",
                    "cover" => "required|mimes:jpeg,png,jpg"
                ]);


                if (!preg_match($this->regex[0], $request["title"])) throw new \Exception("the title is incorrect format");
                else if (!preg_match($this->regex[1], $request["description"])) throw new \Exception("the description is incorrect format");
                else {

                    if ($request->hasFile("cover")) {
                        $cover = time() . "-" . $request["cover"]->getClientOriginalName();

                    }

                    $category = new Category();
                    $category["id"] = Str::uuid();
                    $category["title"] = $request["title"];
                    $category["description"] = $request["description"];
                    $category["user_id"] = Auth::authenticate()->id;
                    $category["cover"] = $cover;
                    $category["category_type"] = $service;

                    if ($category->save()) {
                        $request["cover"]->move(public_path("/images/categories"), $cover);
                    }

                    return response()->json([
                        "data" => $service . " category was added",
                    ]);

                }

            } else {

                throw new \Exception("you need to be admin or superadmin");
            }

        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * show the specific category with the specific blogs or news
     */
    public function show(string $service): JsonResponse
    {
        $id = request()->query("id");
        $categoryWithService = Category::where("category_type", $service)->where("id", $id)->with($service)->get();


        return response()->json([
            "data" => $categoryWithService
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): JsonResponse
    {
        try {

            $id = request()->query("id");

            if ($this->role === RoleEnum::SUPERADMIN->value || $this->role === RoleEnum::ADMIN->value) {

                $category = Category::find($id);


                if ($request->hasFile("cover")) {

                    $category_image = time(). "-". $request["cover"]->getClientOriginalName();
                    $request["cover"]->move(public_path("/images/categories"), $category_image);


                    if(File::exists(public_path("/images/categories/".$category["cover"]))){
                        File::delete(public_path("/images/categories/".$category["cover"]));
                    }


                }

                $category->title = $request["title"] == null ? $category["title"] : $request["title"];
                $category->description = $request["description"] == null ? $category["description"] : $request["description"];
                $category->cover = $request["cover"] == null ? $category["cover"] : $category_image;

                if ($category->update()) {

                        return response()->json([
                            "data" => "this category was updated"
                        ]);

                    } else {
                        throw new \Exception("failed to update this category");
                    }


            } else {
                throw new \Exception("you need to be admin or superadmin");
            }


        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * remove the specific category using id
     */
    public function destroy(): JsonResponse
    {
        try {

            if ($this->role === RoleEnum::ADMIN->value || $this->role === RoleEnum::SUPERADMIN->value) {

                $id = request()->query("id");

                $categoryExist = Category::where("id", $id)->first();

                $category = Category::destroy($id);
                if ($category) {
                    if (File::exists(public_path("/images/categories/" . $categoryExist->cover))) {
                        File::delete(public_path("/images/categories/" . $categoryExist->cover));
                    }

                    return response()->json([
                        "data" => "this category was deleted"
                    ], 200);
                } else {
                    throw new \Exception("failed to remove this category, maybe is not exist or check the id if correct");
                }
            }

        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ], 400);
        }
    }
}
