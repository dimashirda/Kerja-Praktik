<?php
/**
 * Created by PhpStorm.
 * User: Sabila
 * Date: 7/19/2017
 * Time: 11:18 AM
 */

namespace App\Http\Controllers;


class PelangganController
{
    public function index()
    {
        return view('pelanggan.index');
    }

    public function create()
    {
        return view('pelanggan.create');
    }
}