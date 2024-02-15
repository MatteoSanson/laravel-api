@extends('layouts.admin')

@section('header')
    <h1>Types</h1>
    <a href="{{ route('admin.types.create') }}" role="button" class="btn btn-success btn-sm">New
        Type</a>
@endsection

@section('content')
    @if (session('message'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast show {{ session('notification_type') === 'danger' ? 'bg-danger text-white' : 'bg-success' }}"
                role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong
                        class="me-auto">{{ session('notification_type') === 'danger' ? 'Delete' : 'Notification' }}</strong>
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
                <th scope="col">Slug</th>
                <th scope="col">Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr class="text-center">
                    <th scope="row">{{ $type->id }}</th>
                    <td>{{ $type->title }}</td>
                    <td>{{ $type->slug }}</td>
                    <td>
                        <a href="{{ route('admin.types.show', $type) }}" class="btn btn-info btn-sm">details</a>
                        <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-primary btn-sm">edit</a>
                        <form action="{{ route('admin.types.destroy', $type->slug) }}" method="POST"
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
