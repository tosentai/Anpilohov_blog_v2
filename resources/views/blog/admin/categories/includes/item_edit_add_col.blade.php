<div class="card mb-3">
    <div class="card-header">
        Дії з категорією
    </div>
    <div class="card-body">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-save me-2"></i>Зберегти зміни
        </button>
    </div>
</div>

@if ($item->exists)
    <div class="card mb-3">
        <div class="card-header">
            Інформація про запис
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    ID: <strong>{{ $item->id }}</strong>
                </li>
            </ul>
            <div class="mb-3">
                <label for="created_at" class="form-label">Створено</label>
                <input type="text" value="{{ $item->created_at }}" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="updated_at" class="form-label">Змінено</label>
                <input type="text" value="{{ $item->updated_at }}" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="deleted_at" class="form-label">Видалено</label>
                <input type="text" value="{{ $item->deleted_at }}" class="form-control" disabled>
            </div>
        </div>
    </div>
@endif
