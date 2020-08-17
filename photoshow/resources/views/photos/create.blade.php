@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Upload Photo</h1>
<form method="POST" action="{{route('photo-store')}}" enctype="multipart/form-data">
        @csrf
<input type="hidden" name="album-id" value="{{$albumId}}">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                @error('title')
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
                <label for="photo">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo">
                @error('photo')
                <div class="text text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <br><br><br>
</div>
@endsection
