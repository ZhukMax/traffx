@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Statistics</h2>

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
                                <table class="table table-bordered col-lg-12">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Hits</th>
                                        <th>IP unique</th>
                                        <th>Cookie unique</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($platforms as $platform)
                                    <tr>
                                        <td>{{ $platform['name'] }}</td>
                                        <td>{{ $platform['hits'] }}</td>
                                        <td>{{ $platform['ipUnique'] }}</td>
                                        <td>{{ $platform['cookieUnique'] }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="browsers">
                            <div class="panel-body">
                                <table class="table table-bordered col-lg-12">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Hits</th>
                                        <th>IP unique</th>
                                        <th>Cookie unique</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($browsers as $browser)
                                        <tr>
                                            <td>{{ $browser['name'] }}</td>
                                            <td>{{ $browser['hits'] }}</td>
                                            <td>{{ $browser['ipUnique'] }}</td>
                                            <td>{{ $browser['cookieUnique'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="geo">
                            <div class="panel-body">
                                <table class="table table-bordered col-lg-12">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Hits</th>
                                        <th>IP unique</th>
                                        <th>Cookie unique</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($geolocations as $geolocation)
                                        <tr>
                                            <td>{{ $geolocation['name'] }}</td>
                                            <td>{{ $geolocation['hits'] }}</td>
                                            <td>{{ $geolocation['ipUnique'] }}</td>
                                            <td>{{ $geolocation['cookieUnique'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="referrals">
                            <div class="panel-body">
                                <table class="table table-bordered col-lg-12">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Hits</th>
                                        <th>IP unique</th>
                                        <th>Cookie unique</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($referers as $referer)
                                        <tr>
                                            <td>{{ $referer['name'] }}</td>
                                            <td>{{ $referer['hits'] }}</td>
                                            <td>{{ $referer['ipUnique'] }}</td>
                                            <td>{{ $referer['cookieUnique'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
