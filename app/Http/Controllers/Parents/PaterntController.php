<?php

namespace App\Http\Controllers\Parents;

use App\Http\Controllers\Controller;
use App\Models\Teacher\studentParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaterntController extends Controller
{
    public function index(){

        $parent=studentParent::find(Auth::guard('studentparent')->id());

        return view("multiauth.parent.dashboard",compact('parent'));
    }
}
