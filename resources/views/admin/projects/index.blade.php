@extends('layouts.admin')

@section('header')
    <h1>Projects</h1>
    <a href="{{ route('admin.projects.create') }}" role="button" class="btn btn-success btn-sm">New Project</a>
@endsection

@section('content')
    @if (session('message'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast show bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Notification</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('message') }}
                </div>
            </div>
        </div>
    @endif

    <table class="table">
        <thead>
            <tr class="text-center">
                <th scope="col">#id</th>
                <th scope="col">Title</th>
                <th scope="col">Type</th>
                <th scope="col">Technology</th>
                {{-- <th scope="col">Language/Framework</th> --}}
                <th scope="col">Visibility</th>
                <th scope="col">Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr class="text-center">
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->type->title }}</td>
                    <td>
                        @foreach ($project->technologies as $technology)
                            {{ $technology->title }}
                            @unless ($loop->last)
                                -
                            @endunless
                        @endforeach
                    </td>
                    {{-- <td>{{ $project->language_framework }}</td> --}}
                    <td>{{ $project->visibility }}</td>
                    <td>
                        <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-info btn-sm">details</a>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary btn-sm">edit</a>
                        <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST"
                            class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
