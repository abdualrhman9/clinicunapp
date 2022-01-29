@extends('layouts.app')

@section('content')
    <div class="container">

        @if(session()->has('message'))
            @include('dashboard.status',['message'=>session('message')])
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
            <caption> Questions List </caption>
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

            @include('dashboard.sidebar')

        </div>

        <div class="row">
            {{ $questions->links() }}
        </div>
    </div>
@endsection