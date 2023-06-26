<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlgoritmaController extends Controller
{
    public function soalSatu()
    {
        $data = [];
        $data[0]['code'] = "A001";
        $data[0]['name'] = "Wati";
        $data[0]['parent'] = "";

        $data[1]['code'] = "A002";
        $data[1]['name'] = "Wira";
        $data[1]['parent'] = "A001";

        $data[2]['code'] = "A003";
        $data[2]['name'] = "Andi";
        $data[2]['parent'] = "A002";

        $data[3]['code'] = "A004";
        $data[3]['name'] = "Bagus";
        $data[3]['parent'] = "A002";

        $data[4]['code'] = "A005";
        $data[4]['name'] = "Siti";
        $data[4]['parent'] = "A001";

        $data[5]['code'] = "A006";
        $data[5]['name'] = "Hasan";
        $data[5]['parent'] = "A005";

        $data[6]['code'] = "A007";
        $data[6]['name'] = "Abdul";
        $data[6]['parent'] = "A006";

        $input = request()->input;

        if ($input) {
            $all_child = $this->getAllChild($data, $input);
        } else {
            $all_child = [];
        }

        return view('satu', ['data' => $data, 'all_child' => $all_child]);
    }

    public function getALlChild($data, $code)
    {
        $all = [];
        foreach ($data as $dt) {
            if ($dt['parent'] == $code) {
                $all[] = $dt['name'];
                array_push($all, ...$this->getAllChild($data, $dt['code']));
            }
        }
        
        return array_values(array_unique($all));
    }

    public function soalDua()
    {
        $input = request()->input;

        if ($input) {
            $fibonanci = $this->getFibonacci($input);
        } else {
            $fibonanci = [];
        }

        return view('dua', ['fibonanci' => $fibonanci]);
    }

    public function getFibonacci($n, $first = 0, $second = 1)
    {
        $fib = [$first,$second];
        for($i=1; $i<$n-1; $i++) {
            $fib[] = $fib[$i] + $fib[$i-1];
        }

        return $fib;
    }

    public function soalTiga()
    {
        return view ('tiga');
    }
}
