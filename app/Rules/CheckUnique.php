<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class CheckUnique implements ValidationRule
{
    protected $parentId;

    /**
     * Конструктор для передачи parent_id
     */
    public function __construct($parentId = null)
    {
        $this->parentId = $parentId;
    }

    /**
     * Выполнить правило валидации.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  Closure  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Строим запрос с учетом parent_id, если оно передано
        $query = DB::table('categories')->where('name', $value);

        // Если parent_id передано, добавляем условие для фильтрации по родительской категории
        if ($this->parentId !== null) {
            $query->where('parent_id', $this->parentId);
        }

        // Если категория с таким именем и parent_id уже существует, вызываем ошибку
        if ($query->exists()) {
            $fail('The category name already exists under the selected parent.');
        }
    }
}
