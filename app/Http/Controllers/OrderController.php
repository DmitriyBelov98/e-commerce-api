<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        return new OrderResource($request->user());
    }
    public function store(Request $request)
    {
        $request->user()->orders()->create(
            $request->only(['address_id'])
        );
    }
}
