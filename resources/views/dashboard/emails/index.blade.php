@extends('layouts.app')

@section('content')

@if(session()->has('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
@endif

<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <table class="table">
                <th>
                    <tr>
                        <td>#</td>
                        <td>Email</td>
                        <td> Role </td>
                        <td> Delete </td>
                    </tr>
                </th>
                <tbody>

                    @foreach($emails as $key=>$email)

                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $email->email }}</td>
                        <td>{{ $email->role }}</td>
                        <td><a href="{{ route('dashboard.emails.destroy', $email) }}" class="btn-sm btn-danger"> Delete </a></td>
                    </tr>

                    @endforeach

                    
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection