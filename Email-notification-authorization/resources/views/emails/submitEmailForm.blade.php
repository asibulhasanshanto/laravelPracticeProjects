<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>

        <h1>Hello</h1>
        <div class="container container-fluid container-sm">
            <form
            class="email-form"
            method="POST"
            action="/email"
            >
            @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input  class="form-control" id="email" name="email" placeholder="Enter email">
                  @error('email')
                <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary email">Submit</button>
                @if (session('message'))
            <div>{{session('message')}}</div>
                @endif
              </form>
        </div>
    </body>
</html>
