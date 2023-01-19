@extends('layouts.admin')

@section('content')
    <div class="container">
        <h4 class="text-center text-primary mt-3">
            {{ $project->type ? $project->type->name : 'Nessuna Tipologia' }}
        </h4>
        <h1 class="text-center mt-3">{{ $project->title }}</h1>
        <div class="d-flex justify-content-between mt-3">
            <h5>{{ $project->created_at }}</h5>
            <p>{{ $project->slug }}</p>
        </div>

        <div class="technologies">
            @forelse ($project->technologies as $technology)
                <span>#{{ $technology->name }}</span>
            @empty
                <span>Nessuna tecnologia</span>
            @endforelse
        </div>

        <div class="text-center">
            @if ($project->cover_image)
                <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ 'Cover image di ' . $project->title }}">
            @else
                <div class="w-50 bg-secondary py-4 text-center d-inline-block">
                    No image yet
                </div>
            @endif
        </div>


        <p class="mt-3">{{ $project->content }}</p>
    </div>
@endsection
