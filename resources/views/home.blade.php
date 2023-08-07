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

                    {{ __('You are logged in!') }}


                    <form action="{{route('course.add')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Select Courses</label>
                            <select multiple class="form-control" id="courses" name="courses[]">
                            @foreach($courses as $course)

                            <option value="{{$course->id}}">{{$course->title}}</option>

                            @endforeach 

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>

                        </form><hr>
                        <div>
                        <h2>My Subscriptions</h2>

                        <table class="table table-bordered">
                        <tr>
                            <th> Name </th>
                            <th> Action </th>
                            
                        </tr>
                        @forelse($items as $item)
                        <tr>
                            <td> {{ $item->getCourse->title }}</td>
                            <td>  <a class="btn btn-danger" href="{{URL::to('course/remove/'.$item->id)}}" onclick="return confirm('Are you sure?')">Remove</a></td>
                        </tr>
                        @empty
                                <tr class="text-center">
                                    NO data found
                                </tr>
                            @endforelse

                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
