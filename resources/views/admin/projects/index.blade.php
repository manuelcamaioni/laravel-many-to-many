@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Type</th>
                            <th scope="col">Date</th>
                            <th scope="col">Slug</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($projects as $project)
                            <tr>
                                <th>
                                    {{ $project->id }}
                                </th>
                                <td>
                                    <strong>
                                        {{ $project->title }}
                                    </strong>
                                </td>
                                <td>
                                    {{ $project->type->name }}
                                </td>
                                <td>
                                    {{ $project->date }}
                                </td>
                                <td>
                                    {{ $project->slug }}
                                </td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-sm btn-primary">
                                        View
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-success">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-warning">
                                            Delete
                                        </button>

                                    </form>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>



            </div>
        </div>
    </div>
@endsection
