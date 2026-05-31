<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projects\ProjectIndexRequest;
use App\Http\Requests\Projects\StoreProjectRequest;
use App\Http\Requests\Projects\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Http\JsonResponse;

/**
 * Class ProjectsController
 */
class ProjectsController extends Controller
{
    /**
     * @param ProjectRepository $projectRepository
     */
    public function __construct(
        private readonly ProjectRepository $projectRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @param ProjectIndexRequest $request
     *
     * @return JsonResponse
     */
    public function index(ProjectIndexRequest $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $projects = $this->projectRepository->getPaginated($perPage);
        return response()->json([
            'values' => $projects->values(),
            'current_page' => $projects->currentPage(),
            'per_page' => $projects->perPage(),
            'last_page' => $projects->lastPage(),
            'total' => $projects->total(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProjectRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreProjectRequest $request): JsonResponse
    {
        $project = Project::create($request->validated());

        return response()->json([
            'message' => 'Project created successfully',
            'data' => new ProjectResource($project),
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     *
     * @return ProjectResource
     */
    public function show(Project $project): ProjectResource
    {
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProjectRequest $request
     * @param Project              $project
     *
     * @return JsonResponse
     */
    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $project->update($request->validated());

        return response()->json([
            'message' => 'Project updated',
            'data' => new ProjectResource($project)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     *
     * @return JsonResponse
     */
    public function destroy(Project $project): JsonResponse
    {
        $project->delete();

        return response()->json(null, 204);
    }
}
