<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddressOptionsStoreRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AddressController extends Controller
{

    public function store(AddressOptionsStoreRequest $request)
    {
        try{
            $address = new Address;

            $address->user_id = auth()->user()->id;
            $address->addr1 = $request->get('addr1');
            $address->addr1 = $request->get('addr2');
            $address->addr1 = $request->get('city');
            $address->addr1 = $request->get('postcode');
            $address->addr1 = $request->get('country');
            
            $address->save();

            return Redirect::route('profile.edit');
        } catch (\Exception $e){
            return response()->json($e->getMessage());
        }
    }

}
