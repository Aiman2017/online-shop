<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function __construct(public Category $category)
    {
        parent::__construct($category);
    }

    public function getAllWithChildrenRecursive(array $with = ['children']): Collection|array
    {
        return $this->model->with([
            'children' => function ($query) use ($with) {
                $query->with($with);
            }
        ])->whereNull('parent_id')->get();
    }
}
