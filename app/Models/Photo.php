<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['path'];

    public static function deleteImage(int $id): Model|Collection|Builder|array|null
    {
        return self::query()->find($id);
    }

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
