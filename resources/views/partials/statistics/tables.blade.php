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
    @foreach ($data as $value)
        @if($value['hits'] > 0 || $value['ipUnique'] > 0 || $value['cookieUnique'] > 0)
        <tr>
            <td>{{ $value['name'] }}</td>
            <td>{{ $value['hits'] }}</td>
            <td>{{ $value['ipUnique'] }}</td>
            <td>{{ $value['cookieUnique'] }}</td>
        </tr>
        @endif
    @endforeach
    </tbody>
</table>