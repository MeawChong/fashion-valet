<?php

namespace App\Services;

class Address
{
    protected $addresses = [];

    public function setAddress($addresses = [])
    {
        $this->addresses = $addresses;
    }

    public function format()
    {
        $concat_address = $this->concatAddress();

        $cut_string_address = $this->checkStringLength($concat_address);

        return $this->formatAddressLines($cut_string_address);
    }

    protected function concatAddress()
    {
        $filter_address = array_filter($this->addresses, function($address) {
            return !is_null($address);
        });

        return implode(', ', $filter_address);
    }

    protected function checkStringLength($string_address)
    {
        if (strlen($string_address) <= 90)
            return $string_address;

        return substr($string_address, 0, 87).'...';
    }

    protected function formatAddressLines($string_address)
    {
        $addresses = explode(' ', $string_address);

        $x = 1;
        $result['address_'.$x] = $addresses[0];
        $result['address_2'] = '';
        $result['address_3'] = '';

        for ($i = 1; $i < count($addresses); $i++) {
            if ((strlen($result['address_'.$x]) + strlen($addresses[$i]) + 1) <= 30) {
                $result['address_'.$x] .= " {$addresses[$i]}";
            } else {
                $x++;
                $result['address_'.$x] = $addresses[$i];
            }
        }
        return $result;
    }
}
