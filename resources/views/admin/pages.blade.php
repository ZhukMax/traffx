@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Pages</h2>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <ol>
                        @foreach($pages as $page)
                            <li><a href="/admin/page/{{ $page->id }}">{{ $page->title }}</a></li>
                        @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
