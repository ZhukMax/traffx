@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $page->title }} &nbsp; | &nbsp; Author: {{ $page->author }}</div>

                    <div class="panel-body">
                        {{ $page->text }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
