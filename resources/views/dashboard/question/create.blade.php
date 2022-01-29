@extends('layouts.app')

@section('content')
    <div class="container">

        @if(session()->has('message'))
            @include('dashboard.status',['message'=>session('message')])
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <legend> Create Question </legend>
                <form method="POST" action="{{ route('dashboard.questions.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Question</label>
                        <input name="question" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Question">
                        <small id="emailHelp" class="form-text text-muted">Question for patients when they register</small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            @include('dashboard.sidebar')
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
            <caption> Recent Questions </caption>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Question</th>
                        <th scope="col">Create At</th>
                        <th scope="col">Answers</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $key=>$question)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $question->question }}</td>
                            <td> {{ $question->created_at->format('m/d/Y h:s') }} </td>
                            <td>@mdo</td>
                        </tr>
                    @endforeach
                    
                    
                   
                </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection