<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Services\Address;

class AddressController extends Controller
{
    protected $data = [];

    public function index()
    {
        $this->data = [
            'result' => false,
            'address_1' => '',
            'address_2' => '',
            'address_3' => ''
        ];

        return view('addresses', $this->data);
    }

    public function format(AddressRequest $request)
    {
        $address_1 = $request->input('address_1');
        $address_2 = $request->input('address_2');
        $address_3 = $request->input('address_3');

        $this->data = [
            'address_1' => $address_1,
            'address_2' => $address_2,
            'address_3' => $address_3
        ];

        $addresses = [$address_1, $address_2, $address_3];

        $address = new Address();
        $address->setAddress($addresses);

        $this->data['result'] = $address->format();

        return view('addresses', $this->data);
    }

    public function apiFormat(Request $request)
    {
        $address_1 = $request->input('address_1');
        $address_2 = $request->input('address_2');
        $address_3 = $request->input('address_3');

        $addresses = [$address_1, $address_2, $address_3];

        $address = new Address();
        $address->setAddress($addresses);

        $data = $address->format();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Address format is completed.'
        ];

        return response()->json($response, 200);
    }
}
