@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(isset($pageID))
                    <h2>Statistics for page ID#{{ $pageID }}</h2>
                @else
                    <h2>Statistics for site</h2>
                @endif

                <div class="panel panel-default">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#os" aria-controls="os" role="tab" data-toggle="tab">Operating Systems</a></li>
                        <li role="presentation"><a href="#browsers" aria-controls="browsers" role="tab" data-toggle="tab">Browsers</a></li>
                        <li role="presentation"><a href="#geo" aria-controls="geo" role="tab" data-toggle="tab">Geo</a></li>
                        <li role="presentation"><a href="#referrals" aria-controls="referrals" role="tab" data-toggle="tab">Referrals</a></li>
                    </ul>

                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane active" id="os">
                            <div class="panel-body">
                                @include('partials.statistics.tables', ['data' => $platforms])
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="browsers">
                            <div class="panel-body">
                                @include('partials.statistics.tables', ['data' => $browsers])
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="geo">
                            <div class="panel-body">
                                @include('partials.statistics.tables', ['data' => $geolocations])
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="referrals">
                            <div class="panel-body">
                                @include('partials.statistics.tables', ['data' => $referers])
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
