@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Pages</h2>

                <div class="panel panel-default">
                    <div class="panel-body">
                        @foreach($pages as $page)
                            <h3><a href="/admin/page/{{ $page->id }}">{{ $page->title }}</a></h3>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
