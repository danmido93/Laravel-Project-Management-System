@extends('layouts.app')
@section('content')
<div class="col-md-6 col-lg-6 col-md-offset-4 col-lg-offset-3">
    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Companies - Index <a style="border-color: white" class="pull-right btn btn-primary btn-sm" href="/companies/create">Add Company</a></div>
        <div class="panel-body">
            <!-- List group -->
            <ul class="list-group">
                @foreach($companies as $company) 

                    <li class="list-group-item"><a href="{{ route('companies.show', [$company->id]) }}">{{ $company->name }}</a></li>
                
                @endforeach
            </ul>
        </div>
       
    </div>
</div>
@endsection
