@extends('container')

@section('content')
<div class="container-fluid p-3">
    <h2>Q2. Drivers Information</h2>
    {{ Form::open(['method' => 'POST']) }}
        {{ Form::token() }}
        {{ Form::submit('Get Data', ['class' => 'btn btn-dark']) }}
    {{ Form::close() }}

    @if($data)
    <div class="container-fluid p-3">
        <h2>Result</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Driver ID</th>
                    <th>No. of Completed Rides</th>
                    <th>No. of Cancelled Rides</th>
                    <th>No. of Unique Passengers</th>
                    <th>Total Fare</th>
                    <th>Total Commission</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $row->driver_id }}</td>
                        <td>{{ $row->number_of_completed_rides }}</td>
                        <td>{{ $row->number_of_cancelled_rides }}</td>
                        <td>{{ $row->number_of_unique_passengers }}</td>
                        <td>{{ $row->total_fare }}</td>
                        <td>{{ $row->total_commission }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection