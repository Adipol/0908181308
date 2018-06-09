<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\StringEndsWith;

class ApproveController extends Controller
{
    public function index()
    {
        return view('warehouse.output.request.index');
        
   
    }
}
