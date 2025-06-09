@extends('layouts.main')

@section('content')
    @php /** @var \App\Models\BlogCategory $item */ @endphp
    <div class="container mt-4">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($item->exists)
            <form method="POST" action="{{ route('blog.admin.categories.update', $item->id) }}">
                @method('PATCH')
                @else
                    <form method="POST" action="{{ route('blog.admin.categories.store') }}">
                        @endif
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <a href="{{ route('blog.admin.categories.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Повернутися до списку
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                @include('blog.admin.categories.includes.item_edit_main_col')
                            </div>
                            <div class="col-md-4">
                                @include('blog.admin.categories.includes.item_edit_add_col')
                            </div>
                        </div>
                    </form>
            </form>
    </div>
@endsection
