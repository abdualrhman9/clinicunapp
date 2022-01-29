@extends('layouts.app')

@section('content')



    <div class="container">
        @if(session()->has('message'))
            @include('dashboard.status',['message'=>session('message')])
        @endif

        <div class="row justify-content-center align-items-center">
            <div class="col-md-8">
                <legend>Create Staff Email</legend>
                <form action="{{ route('dashboard.emails.store') }}" method="post" class="form">

                    @csrf
                    @method('post')

                    <div class="form-row">
                        <div class="col-6">
                            <label for="email"> Email </label>
                            <input class="form form-control" name="email">
                        </div>

                        <div class="col-6">
                            <label for="role"> Roles </label>
                            <select class="form form-control" name="role">
                                <option disabled selected> Select role </option>
                                <option value="1"> Admin </option>
                                <option value="3"> Doctor </option>
                            </select>
                            <button class="mt-2 btn btn-success"> Save </button>
                        </div>
                    </div>
                    
                
                </form>
            </div>

            @include('dashboard.sidebar')
        </div>
    </div>
@endsection