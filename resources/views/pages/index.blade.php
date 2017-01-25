@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Articles</div>

                    <div class="panel-body">
                        @foreach($pages as $page)
                            <h3><a href="/pages/{{ $page->id }}">{{ $page->title }}</a></h3>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
