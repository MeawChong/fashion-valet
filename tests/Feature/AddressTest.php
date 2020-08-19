<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\Address;

class AddressTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAddress()
    {
        $address = new Address;
        $address->setAddress(['Business Office, Malcolm Long 92911 Proin Road Lake Charles Maine']);

        $expected = [
            'address_1' => 'Business Office, Malcolm Long',
            'address_2' => '92911 Proin Road Lake Charles',
            'address_3' => 'Maine'
        ];

        $actual = $address->format();

        $this->assertSame($expected, $actual);
    }
}
