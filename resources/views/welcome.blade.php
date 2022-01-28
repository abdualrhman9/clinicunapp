@extends('layouts.app')

@section('content')
    <div style="
    /* background-color: #726363; */
    width: 320px;
    margin-left: auto;
    margin-right: auto;
    transform: translateY(calc(100% + 95px));
    text-align: center;
    border-radius: 10px;
    ">
        <h1>{{ config('app.name', 'Laravel') }}</h1>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
    </div>
@endsection