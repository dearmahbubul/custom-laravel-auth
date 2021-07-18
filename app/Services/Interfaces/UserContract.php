<?php
/**
 * Created by Mahbubul Alam
 * User: Orangetoolz
 * Date: 7/17/21
 * Time: 7:53 PM
 */


namespace App\Services\Interfaces;


use Illuminate\Http\Request;

interface UserContract
{
    public function register(Request $request);
}
