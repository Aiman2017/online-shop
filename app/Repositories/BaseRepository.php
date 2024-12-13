<?php

namespace App\Repositories;

use App\traits\UploadFiles;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    use UploadFiles;

    protected string $title;

    public function __construct(protected Model $model)
    {
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param  array  $where
     * @return mixed
     */
    public function getAllWithWhere(array $where = []): mixed
    {
        return $this->model->where($where)->get();
    }

    /**
     * @param  array  $relations
     * @return Collection|array
     */
    public function getAllWithRelations(array $relations = [], array $where = [], int $take = null): Collection|array
    {
        return $this->model->with(relations: $relations)->where($where)->take($take)->get();
    }

    /**
     * @param  array  $relations
     * @param  int  $page
     * @return LengthAwarePaginator
     */
    public function getPaginateWithRelations(
        array $relations = [],
        $whereNull = null,
        int $page = 10
    ): LengthAwarePaginator {
        return $this->model->with($relations)
            ->whereNull($whereNull)
            ->paginate($page);
    }

    public function update(string $id, array $data)
    {
        $record = $this->find($id);

        $record->update($data);
        return $record;
    }

    /**
     * @param  int  $id
     * @param  array  $relations
     * @return Model
     */
    public function find(int $id, array $relations = []): Model
    {
        return $this->model->with($relations)->findOrFail($id);
    }

    /**
     * @param  string  $title
     * @return string
     */
    public function title(string $title): string
    {
        return $this->title = $title;
    }

    /**
     * @param  Model  $model
     * @param $photos
     * @return mixed
     */
    public function addManyPhoto(Model $model, $photos): mixed
    {
        if (is_array($photos)) {
            foreach ($photos as $photo) {
                $model->photos()->create(['path' => $photo]);
            }
        }
        return true;
    }

    /**
     * @param  array  $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return $this->model->create($data);
    }

    /**
     * @param  Model  $model
     * @param $photo
     * @return mixed
     */
    public function addOnePhoto(Model $model, $photo): mixed
    {
        return $model->photos()->create(['path' => $photo]);
    }

    /**
     * @param  Model  $model
     * @param $file
     * @return void
     */
    public function deleteManyPhotos(Model $model, $file): void
    {
        $paths = $model->{$file};

        if ($paths) {
            foreach ($paths as $path) {
                $this->deleteFiles($path->path);
                $path->delete();
            }
        }
    }

    /**
     * @param  int  $id
     * @return bool|null
     */
    public function delete(int $id): ?bool
    {
        $record = $this->find($id);
        return $record->delete();
    }
}
