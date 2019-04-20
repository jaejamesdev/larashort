@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('success'))
        <div class="alert alert-success">
            <p>{!! Session::get('success') !!}</p>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">
            <p>{!! Session::get('error') !!}</p>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <h2>Welcome, {{Auth::user()->name}}</h2>
                    <h5>You Have Generated <span class="badge badge-primary">{{count($urls)}}</span> Urls</h5>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">View Your Urls</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>Short URL</th>
                            <th>Original URL</th>
                            <th>Created</th>
                        </thead>
                        <tbody>
                            @foreach ($urls as $url)
                                <tr>
                                    <td>{{env('APP_URL') . '/short/' . $url->id}}</td>
                                    <td>{{$url->url}}</td>
                                    <td>{{$url->created_at}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Create A Url</div>
                <div class="card-body">
                    <form action="/create" method="post">
                        {{ csrf_field() }}
                        <input type="text" name="url" placeholder="Enter Your Url" id="" class="form-control">
                        <br>
                        <input type="submit" value="Create" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
