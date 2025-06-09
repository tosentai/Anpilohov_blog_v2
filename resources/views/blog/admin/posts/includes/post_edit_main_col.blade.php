@php /** @var \App\Models\BlogPost $item */ @endphp
<div class="card mb-3">
    <div class="card-header">
        @if ($item->is_published)
            Опубліковано
        @else
            Чернетка
        @endif
    </div>
    <div class="card-body">
        <div class="card-title"></div>
        <div class="card-subtitle mb-2 text-muted"></div>
        <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Основні дані</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#adddata" role="tab">Додаткові дані</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="maindata" role="tabpanel">
                <div class="mb-3">
                    <label for="title" class="form-label">Заголовок</label>
                    <input type="text" name="title" value="{{ old('title', $item->title) }}" id="title" class="form-control" minlength="3" required>
                </div>

                <div class="mb-3">
                    <label for="content_raw" class="form-label">Текст статті</label>
                    <textarea name="content_raw" id="content_raw" rows="20" class="form-control">{{ old('content_raw', $item->content_raw) }}</textarea>
                </div>
            </div>
            <div class="tab-pane" id="adddata" role="tabpanel">
                <div class="mb-3">
                    <label for="category_id" class="form-label">Категорія</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        @foreach ($categoryList as $categoryOption)
                            <option value="{{ $categoryOption->id }}"
                                    @if($categoryOption->id == old('category_id', $item->category_id)) selected @endif>
                                {{ $categoryOption->id_title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Псевдонім</label>
                    <input type="text" name="slug" value="{{ old('slug', $item->slug) }}" id="slug" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="excerpt" class="form-label">Короткий текст</label>
                    <textarea name="excerpt" id="excerpt" rows="3" class="form-control">{{ old('excerpt', $item->excerpt) }}</textarea>
                </div>
                <div class="form-check mb-3">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" value="1" class="form-check-input" id="is_published" @if($item->is_published) checked="checked"@endif>
                    <label for="is_published" class="form-check-label">Опубліковано</label>
                </div>
            </div>
        </div>
    </div>
</div>
