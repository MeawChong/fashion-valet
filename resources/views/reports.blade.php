@extends('container')

@section('content')
<div class="container-fluid p-3">
    <h2>Q1. Report File Regex</h2>
    {{ Form::open(['method' => 'POST']) }}
        {{ Form::token() }}
        <div class="form-group">
            <label>Report Name</label>
            {{ Form::select('report_name', ['' => 'Choose...', 'EVoucher' => 'EVoucher', 'ERVoucher' => 'ERVoucher', 'EOutslip' => 'EOutslip', 'EInvoice' => 'EInvoice'], $report_name, ['class' => 'custom-select']) }}
        </div>

        <div class="form-group">
            <label>Report Type</label>
            {{ Form::select('report_type', ['D' => 'Details', 'H' => 'Header'], $report_type, ['class' => 'custom-select']) }}
        </div>

        <div class="form-group">
            <label>Report Date</label>
            <input class="form-control" name="report_date" id="datepicker" value="{{ $report_date ?: '' }}">
        </div>

        {{ Form::submit('Submit', ['class' => 'btn btn-dark btn-block']) }}
    {{ Form::close() }}

    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach

    @if($result)
    <div class="container-fluid p-3">
        <h2>Result</h2>
        <u>Regex: {{ $regex }}</u>
        <ul class="list-group">
            @foreach($result as $data)
                <li class="list-group-item">{{ $data }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection