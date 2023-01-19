@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="text-center">Modifica {{ $project->title }}</h2>
        <div class="row justify-content-center">
            <div class="col-8">
                @include('partials.errors')
                <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="title">Titolo</label>
                        <input type="text" id="title" name="title" class="form-control"
                            value="{{ old('title', $project->title) }}">
                    </div>

                    {{-- Tipologia --}}
                    <div class="form-group mb-3">
                        <label for="type">Tipologia</label>
                        <select name="type_id" id="type" class="form-select">
                            <option value="">Nessuna tipologia</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" @selected(old('type_id') == $type->id)>{{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Tecnologia --}}

                    <div class="form-group mb-3">
                        <h4>Tecnologie</h4>
                        @foreach ($technologies as $technology)
                            <div class="form-check">
                                <input type="checkbox" name="technologies[]" id="technology-{{ $technology->id }}"
                                    class="form-check-input" value="{{ $technology->id }}">
                                <label for="technology-{{ $technology->id }}"
                                    class="form-check-label">{{ $technology->name }}</label>
                            </div>
                        @endforeach

                    </div>

                    {{-- Cover --}}
                    <div class="form-group mb-3">
                        <label for="cover_image">Immagine</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control">

                        {{-- Preview dell'immagine esistente --}}
                        <div class="mt-3" style="max-height: 200px">
                            <img id="image_preview" src="{{ asset('storage/' . $project->cover_image) }}"
                                alt="{{ 'Cover image di ' . $project->title }}">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" rows="10" class="form-control">{{ old('content', $project->content) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-warning">Salva</button>
                </form>
            </div>
        </div>
    </div>
@endsection
