<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        return AddressResource::collection($request->user()->addresses);
    }

    public function store(AddressRequest $request)
    {
        $address = Address::make($request->only(['user_name', 'address', 'city', 'postal_code']));

        $request->user()->addresses()->save($address);

        return new AddressResource($address);
    }


}
