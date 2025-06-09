<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;

/**
 * Class CoreRepository.
 *
 * Репозиторій для роботи з сутністю.
 * Може видавати набори даних.
 * Не може змінювати та створювати сутності.
 */
abstract class CoreRepository
{
    /**
     * @var Model
     */
    protected $model;

    /** CoreRepository constructor */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * Отримати назву класу моделі.
     *
     * @return string
     */
    abstract protected function getModelClass(): string;

    /**
     * Отримати "свіжий" екземпляр моделі для початку ланцюжка запитів.
     *
     * @return Model|\Illuminate\Database\Eloquent\Builder
     */
    protected function startConditions()
    {
        return clone $this->model;
    }
}
