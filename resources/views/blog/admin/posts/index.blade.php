@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('blog.admin.posts.includes.result_messages')

                <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3 rounded-3">
                    <div class="container-fluid">
                        <a href="{{ route('blog.admin.posts.create') }}" class="btn btn-lg btn-primary d-flex align-items-center">
                            <i class="fas fa-plus-circle me-2"></i> Додати статтю
                        </a>
                    </div>
                </nav>

                <div class="card shadow-sm rounded-3">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">Список статей</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Автор</th>
                                    <th>Категорія</th>
                                    <th>Заголовок</th>
                                    <th>Дата публікації</th>
                                    <th>Дії</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($paginator as $post)
                                    @php /** @var \App\Models\BlogPost $post */ @endphp
                                    <tr @if (!$post->is_published) class="table-secondary" @endif>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->category->title }}</td>
                                        <td>
                                            <a href="{{ route('blog.admin.posts.edit', $post->id) }}" class="text-decoration-none fw-bold">{{ $post->title }}</a>
                                        </td>
                                        <td>
                                            {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.M H:i') : 'Не опубліковано' }}
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('blog.admin.posts.edit', $post->id) }}" class="btn btn-sm btn-info me-3 shadow-sm rounded d-flex align-items-center" title="Редагувати"> {{-- Змінено me-2 на me-3 для більшого відступу --}}
                                                    <i class="fas fa-edit me-1"></i> Редагувати
                                                </a>
                                                <form action="{{ route('blog.admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цю статтю?')" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger shadow-sm rounded d-flex align-items-center" title="Видалити">
                                                        <i class="fas fa-trash-alt me-1"></i> Видалити
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($paginator->total() > $paginator->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-sm rounded-3">
                        <div class="card-body d-flex justify-content-center">
                            {{ $paginator->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
