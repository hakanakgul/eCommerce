<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

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

    public function edit(Category $category)
    {
        return view("admin.category.edit", compact("category"));
    }

    public function update(CategoryFormRequest $request, $category)
    {

        $validatedData = $request->validated();
        $category = Category::findOrFail($category);
        $category->name = $validatedData["name"];
        $category->slug = Str::slug($validatedData["slug"]);
        $category->description = $validatedData["description"];

        if ($request->hasFile("image")) {
            $path = "uploads/category/" . $category->image;
            if (File::exists($path))
                File::delete($path);

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

        return redirect()->route("admin.category.index")->with("message", "Category Updated Successfully");
    }
}