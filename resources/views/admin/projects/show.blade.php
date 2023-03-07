@extends('layouts.app')

@section('title', $project->title)

@section('content')

<h1 class="my-5">
    {{$project->title}}

</h1>

<div class="clearfix">
    @if($project->image)
    <img class="float-start me-3" src="{{$project->image}}" alt="{{$project->title}}">
    @endif
    <p>{{$project->content}}</p>
    
</div>
<div class="mt-3">
    <h5>Data: {{$project->date}}</h5>

</div>
    
@endsection