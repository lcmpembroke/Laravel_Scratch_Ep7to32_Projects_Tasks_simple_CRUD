@component('mail::message')
    # New Project: {{ $project->title }}

    Here is the project description you created:

    {{ $project->description }}

    @component('mail::button', ['url' => url('/projects/' . $project->id)])
    View project
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
