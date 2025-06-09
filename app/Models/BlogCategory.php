<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable
        = [
            'title',
            'slug',
            'parent_id',
            'description',
        ];

    /**
     * Get the parent category that owns the BlogCategory.
     *
     * Додаємо метод для батьківської категорії
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }

    /**
     * Додаємо аксессор для отримання заголовка з відступом для дочірніх категорій
     * @return string
     */
    public function getParentTitleAttribute()
    {
        $parent = $this->parentCategory;

        return $parent ? $parent->title : 'Коренева';
    }
}
