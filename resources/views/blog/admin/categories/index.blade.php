@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0" style="margin-right: 1rem;">Список категорій блогу</h3>
                        <a href="{{ route('blog.admin.categories.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle me-2"></i>Додати категорію
                        </a>
                    </div>
                    <div class="card-body">
                        @if($paginator->isEmpty())
                            <p class="text-center">Категорій поки немає.</p>
                        @else
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Категорія</th>
                                    <th scope="col">Батьківська</th>
                                    <th scope="col">Дії</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($paginator as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td @if(in_array($item->parent_id, [0, 1])) class="text-muted" @endif>
                                            {{ $item->parentTitle }}
                                        </td>
                                        <td>
                                            <a href="{{ route('blog.admin.categories.edit', $item->id) }}"
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-edit me-1"></i> Редагувати
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($paginator->total() > $paginator->count())
            <div class="row justify-content-center mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body d-flex justify-content-center">
                            {{ $paginator->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
