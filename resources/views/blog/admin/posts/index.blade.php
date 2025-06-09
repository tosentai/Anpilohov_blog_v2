@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('blog.admin.posts.includes.result_messages')

                <nav class="navbar navbar-toggleable-md navbar-light bg-faded mb-3">
                    <a href="{{ route('blog.admin.posts.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i> Додати статтю
                    </a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-striped">
                            <thead>
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
                                        <a href="{{ route('blog.admin.posts.edit', $post->id) }}">{{ $post->title }}</a>
                                    </td>
                                    <td>
                                        {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.M H:i') : '' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('blog.admin.posts.edit', $post->id) }}" class="btn btn-sm btn-info me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('blog.admin.posts.destroy', $post->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Ви впевнені, що хочете видалити цю статтю?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if($paginator->total() > $paginator->count())
            <br>
            <div class="row justify-content-center">
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
