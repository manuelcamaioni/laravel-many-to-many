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
                            <th scope="col">Dateedeee</th>
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
                                    {{ $project->date }}
                                </td>
                                <td>
                                    {{ $project->slug }}
                                </td>
                                <td class="d-flex gap-2">
                                    <form action="{{ route('admin.projects.restore', $project->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Restore
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.projects.hard-delete', $project->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
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
