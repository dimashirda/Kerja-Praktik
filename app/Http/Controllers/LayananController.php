<?php
/**
 * Created by PhpStorm.
 * User: Sabila
 * Date: 7/19/2017
 * Time: 1:57 PM
 */

namespace App\Http\Controllers;


class LayananController
{
    public function index()
    {
        return view('layanan.index');
    }

    public function create()
    {
        return view('layanan.create');
    }
}