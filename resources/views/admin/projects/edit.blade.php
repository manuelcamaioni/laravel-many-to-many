@extends('layouts.app')



@section('content')
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-8">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-8">
                <h2>ID: {{ $project->id }}</h2>
                <h1>
                    Edit {{ $project->title }}
                </h1>
            </div>

            <form class="col-8" action="{{ route('admin.projects.update', $project) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">
                        Title
                    </label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ old('title', $project->title) }}">
                </div>

                @error('type')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="types" class="form-label">
                        Type
                    </label>
                    <select name="type_id" id="type_id" class="form-select"
                        value="{{ old('type_id', $project->type_id) }}">

                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ $project->type_id == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label for="currentImage" class="form-label mb-2">Current Image:</label>
                    <p>{{ $project->image }}</p>

                    <p>Upload New Image:</p>
                    <input type="file" name="image" id="image">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">
                        Description
                    </label>
                    <input type="text" class="form-control" id="description" name="description"
                        value="{{ old('description', $project->description) }}">
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">
                        Date
                    </label>
                    <input type="date" class="form-control" id="date" name="date"
                        value="{{ old('date', $project->date) }}">
                </div>


                <button type="submit" class="btn btn-primary">
                    Edit project
                </button>
                <button type="reset" class="btn btn-warning">
                    Reset fields
                </button>

            </form>
        </div>
    </div>
@endsection
