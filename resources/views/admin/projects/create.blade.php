@extends('layouts.app')

@section('content')
    <div class="container" id="posts-container">
        <div class="row justify-content-center">
            <div class="col-12">
                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-5">
                        <label for="title" class="form-label">
                            Title
                        </label>
                        <input type="text" class="form-control" id="title" placeholder="Insert your project's title"
                            name="title">
                    </div>
                    @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="types" class="form-label">
                            Type
                        </label>
                        <select name="type_id" id="type_id" class="form-select">
                            <option value="" selected>-</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-5">
                        <label for="exampleFormControlInput1" class="form-label">
                            Image
                        </label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>

                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-5">
                        <label for="description" class="form-label">
                            Description
                        </label>
                        <textarea class="form-control" id="description" rows="7" name="description">
                    </textarea>
                    </div>

                    @error('date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-5">
                        <label for="date" class="form-label">
                            Date
                        </label>
                        <input class="form-control" id="date" type="date" name="date">
                        </input>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-success me-3">
                            Create new project
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            Reset
                        </button>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection
