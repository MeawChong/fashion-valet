<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ReportRequest;
use Carbon\Carbon;

class ReportController extends Controller
{
    protected $data = [];

    public function index()
    {
        $this->data = [
            'result' => false,
            'report_name' => null,
            'report_type' => 'D',
            'report_date' => '2017-09-22'
        ];
        return view('reports', $this->data);
    }

    public function filter(ReportRequest $request)
    {
        $files = Storage::disk('report')->files();
        $report_name = $request->input('report_name', '(?:[A-Z]+)(?:[a-z]+)');
        $report_type = $request->input('report_type', '(?:D|H)');
        $report_date = '(?:\d{6})';

        $this->data += [
            'report_name' => $request->input('report_name'),
            'report_type' => $request->input('report_type'),
            'report_date' => $request->input('report_date')
        ];

        if ($request->has('report_date')) {
            $report_date = Carbon::parse($request->input('report_date'))->format('ymd');
        }

        $regex = '/'.$report_name.$report_type.$report_date.'(?:\d{4}).csv/';

        $this->data['result'] = collect($files)->filter(function($file) use ($regex) {
            return preg_match($regex, $file);
        })->values()->toArray();
        $this->data['regex'] = $regex;

        return view('reports', $this->data);
    }
}
