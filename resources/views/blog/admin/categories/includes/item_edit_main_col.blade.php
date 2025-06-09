<div class="card mb-3">
    <div class="card-header">
        Основні дані категорії
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#maindata" role="tab">Загальна інформація</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="maindata" role="tabpanel">
                <div class="mb-3">
                    <label for="title" class="form-label">Заголовок</label>
                    <input type="text" name="title" value="{{ old('title', $item->title) }}" id="title" class="form-control" minlength="3" required>
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Псевдонім</label>
                    <input type="text" name="slug" value="{{ old('slug', $item->slug) }}" id="slug" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="parent_id" class="form-label">Батьківська категорія</label>
                    <select name="parent_id" id="parent_id" class="form-select" required>
                        @foreach ($categoryList as $categoryOption)
                            <option value="{{ $categoryOption->id }}"
                                    @if($categoryOption->id == old('parent_id', $item->parent_id)) selected @endif>
                                {{ $categoryOption->id }}. {{ $categoryOption->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Опис</label>
                    <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $item->description) }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
