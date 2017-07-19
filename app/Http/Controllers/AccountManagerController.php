<?php
/**
 * Created by PhpStorm.
 * User: Sabila
 * Date: 7/19/2017
 * Time: 2:29 PM
 */

namespace App\Http\Controllers;


class AccountManagerController
{
    public function index()
    {
        return view('account_manager.index');
    }

    public function create()
    {
        return view('account_manager.create');
    }
}