@extends('layout')

@section('content')
    <h1>Projects</h1>

    <ul>
        @foreach ($projects as $project)
            <li>
                <a href="/projects/{{ $project->id }}">
                    {{ $project->title }} ,    {{ mb_strimwidth($project->description, 0, 50, "..." ) }}
                </a>
            </li>
        @endforeach
    </ul>

    <br>
    <p>
        <a href="/projects/create">Create new project</a>
    </p>  
@endsection

