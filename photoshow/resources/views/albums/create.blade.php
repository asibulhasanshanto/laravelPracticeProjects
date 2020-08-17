@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Create new album</h1>
<form method="POST" action="{{route('album-store')}}" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                @error('name')
                <div class="text text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description">
                @error('description')
                <div class="text text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="cover-image">Cover Image</label>
                <input type="file" class="form-control" id="cover-image" name="cover-image">
                @error('cover-image')
                <div class="text text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>

      @endif
</div>
@endsection
