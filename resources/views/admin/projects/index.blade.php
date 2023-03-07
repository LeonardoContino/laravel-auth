@extends('layouts.app')

@section('title', 'Projects')
    
@section('content')
<header>
    <h1 class="my-5">My Projects</h1>
</header>
<table class="table table-hover">
    <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Titolo</th>
          <th scope="col">slug</th>
          <th scope="col">Data</th>
          <th scope="col">Aggiornato il</th>

        </tr>
      </thead>
      <tbody>
        @forelse ($projects as $project)
        <tr>
            <th scope="row">{{$project->id}}</th>
            <td>{{$project->title}}</td>
            <td>{{$project->slug}}</td>
            <td>{{$project->date}}</td>
            <td>{{$project->updated_at}}</td>
            <td>
                <a href="{{route('admin.projects.show', $project->id)}}"><i class="fa-solid fa-eye"></i></a>
            </td>
          </tr>
        @empty
            <tr>
                <td colspan="6">non ci sono progetti</td>
            </tr>
        @endforelse
        
      </tbody>
  </table>
@endsection