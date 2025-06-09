<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class BlogCategoryRepository.
 *
 * Репозиторій для роботи з категоріями блогу.
 */
class BlogCategoryRepository extends CoreRepository
{
    /**
     * Повертає назву класу моделі, з якою працює репозиторій.
     *
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * Отримати модель для редагування в адмінці.
     *
     * @param int $id
     * @return Model
     */
    public function getEdit(int $id): Model
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Отримати список категорій для виводу в випадаючий список.
     *
     * @return Collection
     */
    public function getForComboBox(): Collection
    {
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title',
        ]);

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->get();

        return $result;
    }

    /**
     * Отримати категорії для виводу пагінатором.
     *
     * @param int|null $perPage Кількість елементів на сторінці.
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate(?int $perPage = null): LengthAwarePaginator
    {
        $columns = ['id', 'title', 'parent_id', 'created_at', 'updated_at'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->with(['parentCategory:id,title'])
            ->paginate($perPage);

        return $result;
    }
}
