@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">ADMINISTRATOR</div>
                    @include('partials.admin-menu');
                    <div class="panel-body">
                       <h1>Administrator page</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
