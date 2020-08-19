@extends('container')

@section('content')
<div class="container-fluid p-3">
    <h2>Q3. Address Formatter</h2>
    {{ Form::open(['method' => 'POST']) }}
        {{ Form::token() }}
        <div class="form-group">
            <label>Address 1</label>
            {{ Form::text('address_1', $address_1, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            <label>Address 2</label>
            {{ Form::text('address_2', $address_2, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            <label>Address 3</label>
            {{ Form::text('address_3', $address_3, ['class' => 'form-control']) }}
        </div>
        {{ Form::submit('Submit', ['class' => 'btn btn-dark btn-block']) }}
    {{ Form::close() }}

    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach

    @if($result)
    <div class="container-fluid p-3">
        <h2>Result</h2>
        <ul class="list-group">
            @foreach($result as $key => $data)
                <li class="list-group-item">{{ $key }}: {{ $data }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection