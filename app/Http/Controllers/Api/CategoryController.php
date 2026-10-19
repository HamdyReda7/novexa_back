<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // عرض كل الأقسام
    public function index()
    {
        $categories = Category::oldest()->paginate(5);

        return response()->json([
            'success' => true,
            'message' => 'All Categories',
            'data' => CategoryResource::collection($categories->items()),
            'pagination' => [
                'current_page' => $categories->currentPage(),
                'last_page' => $categories->lastPage(),
                'per_page' => $categories->perPage(),
                'total' => $categories->total(),
            ],
        ]);
    }

    // إضافة قسم
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {

            $imageName = 'category_' . time() . '_' . Str::random(10) . '.' . $request->image->getClientOriginalExtension();

            $request->image->move(public_path('img/categories'), $imageName);

            $data['image'] = $imageName;
        }

        $category = Category::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully.',
            'data' => new CategoryResource($category),
        ], 201);
    }

    // عرض قسم واحد
    public function show(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new CategoryResource($category),
        ]);
    }

    // تعديل قسم
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
            ], 404);
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {

            if ($category->image && file_exists(public_path('img/categories/' . $category->image))) {
                unlink(public_path('img/categories/' . $category->image));
            }

            $imageName = 'category_' . time() . '_' . Str::random(10) . '.' . $request->image->getClientOriginalExtension();

            $request->image->move(public_path('img/categories'), $imageName);

            $data['image'] = $imageName;
        }

        $category->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully.',
            'data' => new CategoryResource($category),
        ]);
    }

    // حذف قسم
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
            ], 404);
        }

        if ($category->image && file_exists(public_path('img/categories/' . $category->image))) {
            unlink(public_path('img/categories/' . $category->image));
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.',
        ]);
    }
}
