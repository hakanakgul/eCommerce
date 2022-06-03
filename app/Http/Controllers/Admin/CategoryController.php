<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view("admin.category.index");
    }

    public function create()
    {
        return view("admin.category.create");
    }

    public function store(CategoryFormRequest $request)
    {

        $validatedData = $request->validated();
        $category = new Category;
        $category->name = $validatedData["name"];
        $category->slug = Str::slug($validatedData["slug"]);
        $category->description = $validatedData["description"];

        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $fileName = time() . "." . $file->getClientOriginalExtension();
            $file->move("uploads/category/", $fileName);
            $category->image = $fileName;
        }

        $category->metaTitle = $validatedData["metaTitle"];
        $category->metaDescription = $validatedData["metaDescription"];
        $category->metaKeyword = $validatedData["metaKeyword"];

        $category->status = $request->status == true ? 1 : 0;

        $category->save();

        return redirect()->route("admin.category.index")->with("message", "Category Created Successfully");
    }
}