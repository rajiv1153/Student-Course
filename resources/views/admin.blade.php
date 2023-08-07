@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div>
                    <form action="{{route('course.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="row" style="border-style: inset;">

                            <div class="col-xs-6 col-sm-7 col-md-6">
                                <div class="form-group">
                                    <strong>Course Title<strong>
                                    <input type="text" name="title" class="form-control" placeholder="Course Name"> 

                                </div>
                            </div>
                            <br>

                            <div class="col-xs-6 col-sm-7 col-md-6">
                                <div class="form-group">
                                    <strong>Image<strong>
                                    <input type="file" name="image" ></input>
                                </div>
                            </div>
                            <br>
                            <div class="col-xs-6 col-sm-7 col-md-6">
                            <button type="submit" class="btn btn-primary">Add Course</button>
                            </div>
                        </div>
                    <form>
                    </div><br>
                    <div>

                        <table class="table table-bordered">
                        <tr>
                            <th> Name </th>
                            <th> Course Logo </th>
                            <th> Action </th>
                        </tr>
                        @forelse($courses as $course)
                        <tr>
                            <td> {{ $course->title}} </td>
                            <td><img src="{{URL::to($course->image)}}" height="70px;"width="80px;"></td>
                            <td> 
                            <a class="btn btn-danger" href="{{URL::to('course/delete/'.$course->id)}}" onclick="return confirm('Are you sure?')">Delete</a>        
       
                            </td> 
                        </tr>
                        @empty
                                <tr class="text-center">
                                <td> NO data found</td>
                                </tr>
                            @endforelse

                        </table>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
