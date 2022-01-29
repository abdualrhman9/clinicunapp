@extends('layouts.app')

@section('content')



<div class="container">
    @if(session()->has('message'))
        @include('dashboard.status',['message'=>session('message')])
    @endif
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
                        <td>
                            <button 
                            class="btn-sm btn-danger"
                            onclick="document.getElementById('delete-{{ $email->id }}').submit()"
                            > Delete </button>
                            <form 
                                action="{{ route('dashboard.emails.destroy', $email) }}" 
                                method="POST" 
                                id="delete-{{ $email->id }}">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>

                    @endforeach

                    
                </tbody>
            </table>
        </div>
        @include('dashboard.sidebar')
    </div>
</div>

@endsection