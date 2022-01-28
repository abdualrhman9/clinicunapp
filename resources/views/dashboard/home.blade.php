@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row jsutify-content-center align-items-center">
            <div class="col-8">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header text-center">Patients Count</div>
                            <div class="card-body">
                                <h2>40</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card">
                            <div class="card-header text-center">Doctors Count</div>
                            <div class="card-body">
                                <h2>40</h2>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="col-12">
                    <a href="{{ route('dashboard.emails.create') }}"> Add Staff Email </a>
                </div>

                <div class="col-12">
                    <a href="{{ route('dashboard.emails.index') }}"> Emails List </a>
                </div>

            </div>
        </div>
    </div>
@endsection