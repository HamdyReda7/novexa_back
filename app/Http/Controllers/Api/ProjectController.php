<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProjectController extends Controller
{


    // عرض كل المشاريع في الداش بورد
    public function index()
    {
        $projects = Project::with('category')->oldest()->paginate(5);

        return response()->json([
            'success' => true,
            'message' => 'Projects retrieved successfully.',
            'data' => ProjectResource::collection($projects->items()),
            'pagination' => [
                'current_page' => $projects->currentPage(),
                'last_page' => $projects->lastPage(),
                'per_page' => $projects->perPage(),
                'total' => $projects->total(),
            ]
        ]);
    }


    //  عرض كل المشاريع في الموقع

    public function allindex()
    {
        $projects = Project::with('category')
            ->oldest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Projects retrieved successfully.',
            'data' => ProjectResource::collection($projects),
        ]);
    }

    // إضافة مشروع

    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {

            $imageName = 'project_' . time() . '_' . Str::random(10) . '.' . $request->image->getClientOriginalExtension();

            $request->image->move(public_path('img/projects'), $imageName);

            $data['image'] = $imageName;
        }

        $project = Project::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Project created successfully.',
            'data' => new ProjectResource($project->load('category')),
        ], 201);
    }

    // عرض مشروع واحد
    public function show(string $id)
    {
        $project = Project::with('category')->find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new ProjectResource($project),
        ]);
    }

    // تعديل مشروع

    public function update(UpdateProjectRequest $request, string $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found.',
            ], 404);
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {

            if ($project->image && file_exists(public_path('img/projects/' . $project->image))) {
                unlink(public_path('img/projects/' . $project->image));
            }

            $imageName = 'project_' . time() . '_' . Str::random(10) . '.' . $request->image->getClientOriginalExtension();

            $request->image->move(public_path('img/projects'), $imageName);

            $data['image'] = $imageName;
        }

        $project->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully.',
            'data' => new ProjectResource($project->load('category')),
        ]);
    }

    // حذف مشروع
    public function destroy(string $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found.',
            ], 404);
        }

        if ($project->image && file_exists(public_path('img/projects/' . $project->image))) {
            unlink(public_path('img/projects/' . $project->image));
        }

        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project deleted successfully.',
        ]);
    }
}
