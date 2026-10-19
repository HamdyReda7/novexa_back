<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

public function index()
{
    $categories = Category::withCount('products')->get();

    return view('categories.index', compact('categories'));
}

    public function create()
    {
        $categories = Category::all();

        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'image' => 'required|image|max:5120',
            'status' => 'required'
        ]);

        if ($request->hasFile("image")) {
            $image = $request->image;
            $imageName = rand(1, 1000) . "_" . time() . "." . $image->extension();
            $image->move(public_path("img/categories"), $imageName);
        }

        Category::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'image' => $imageName,
            'status' => $request->status,
        ]);

        return redirect()
            ->route("categories.index")
            ->with(
                'success',
                'تم إضافة القسم بنجاح'
            );
    }

    public function show($id)
    {
        $categories=Category::findOrFail($id);
        return view('categories.show',compact('categories'));
    }

    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return view('categories.edit', compact('categories'));
    }

    public function update(Request $request)
    {
        $old_id = $request->old_id;
        $categories = Category::findOrFail($old_id);

        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'image' => 'nullable|image|max:5120',
            'status' => 'required'
        ]);

        if ($request->hasFile("image")) {

            if (File::exists(public_path("img/categories/" . $categories->image))) {
                File::delete(public_path("img/categories/" . $categories->image));
            }

            $image = $request->image;
            $imageName = rand(1, 1000) . "_" . time() . "." . $image->extension();

            $image->move(
                public_path("img/categories"),
                $imageName
            );
        } else {
            $imageName = $categories->image;
        }

        $categories->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'image' => $imageName,
            'status' => $request->status,
        ]);

        return redirect()->route("categories.index")->with("success", "تم تعديل هذا القسم بنجاح");
    }

    public function delete($id)
    {
        $categories = Category::findOrFail($id);

        $imageName = public_path('img/categories/' . $categories->image);

        if (File::exists($imageName)) {
            File::delete($imageName);
        }

        $categories->delete();
        return redirect()->route("categories.index")->with("success", "تم حذف هذا القسم بنجاح");
    }
}
