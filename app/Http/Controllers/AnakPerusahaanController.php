<?php
/**
 * Created by PhpStorm.
 * User: Sabila
 * Date: 7/19/2017
 * Time: 1:19 PM
 */

namespace App\Http\Controllers;


class AnakPerusahaanController
{
    public function index()
    {
        return view('anak_perusahaans.index');
    }

    public function create()
    {
        return view('anak_perusahaans.create');
    }
}