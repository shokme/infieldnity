<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyProperty;

class FieldController extends Controller
{
    public function store(Request $request)
    {
        return CompanyProperty::create($request->all());
    }
}
