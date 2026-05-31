<?php

namespace App\Repositories;

use App\Models\Project;

/**
 * Class ProjectRepository
 */
class ProjectRepository
{
    /**
     * @param int $perPage
     *
     * @return mixed
     */
    public function getPaginated(int $perPage = 15): mixed
    {
        return Project::select('id', 'name', 'description')->paginate($perPage);
    }
}
