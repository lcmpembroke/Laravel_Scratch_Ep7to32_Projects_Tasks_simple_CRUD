@extends('layouts.app')

@section('content')
    <h1 class="title">Edit Project</h1>

    <form method="POST" action="/projects/{{ $project->id }}" style="margin-bottom: 1em">
    {{ method_field('PATCH') }} 
    {{ csrf_field() }}
        <div class="field">
            <label for="title" class="label">Title</label>
            <div class="control">
                <input type="text" class="input" name="title" placeholder="Title" value="{{ $project->title }}">
            </div>
        </div>
        <div class="field">
            <label for="description" class="label">Description</label>
            <div class="control">
                <textarea name="description" class="textarea">{{ $project->description }}</textarea>
            </div>
        </div> 
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Update project</button>
            </div>
        </div>
        
    </form>
    @include('errors')
    <form method="POST" action="/projects/{{ $project->id }}">
            @method('DELETE')
            @csrf
            <div class="field">
            <div class="control">
                <button type="submit" class="button">Delete project</button>
            </div>
        </div>
    </form>
@endsection