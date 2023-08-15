<?php

namespace App\Http\Controllers;
use Str;
use Auth;
use App\User;
use App\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'delivery_name' => 'required|string',
            'company_name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string'
        ]);
        $user = User::where('id', $request->id)->first();
        Delivery::create([
            'uniqueId' => Str::random(10),
            'facility_id' => $user->facility_id,
            'delivery_name' => ucwords($request->delivery_name),
            'company_name' => $request->company_name,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'url' => $request->url,
            'local_government_area' => $request->local_government_area,
            'gps_coordinate_longtitude' => $request->gps_coordinate_longtitude,
            'gps_coordinate_latitude' => $request->gps_coordinate_latitude,
            'postal_code' => $request->postal_code,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'added_by' => $user->name
        ]);
    }
    public function index($id)
    {
        $user = User::where('id', $id)->first();
        return response()->json(Delivery::where('facility_id', $user->facility_id)->get());
    }
    public function show($id)
    {
        return response()->json(Delivery::where('uniqueId', $id)->first());
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'delivery_name' => 'required|string',
            'company_name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string'
        ]);
        $user = User::where('id', $request->user_id)->first();
        $data = [
            'delivery_name' => ucwords($request->delivery_name),
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'added_by' => $user->name
        ];
        if (isset($request->new_address)) {
           $data['address'] = $request->new_address;
           $data['city'] = $request->new_city;
            $data['state'] = $request->new_state;
            $data['country'] = $request->new_country;
            $data['url'] = $request->new_url;
            $data['local_government_area'] = $request->new_local_government_area;
            $data['gps_coordinate_longitude'] = $request->new_gps_coordinate_longtitude;
            $data['gps_coordinate_latitude'] = $request->new_gps_coordinate_latitude;
            $data['postal_code'] = $request->new_postal_code;
        }
        Delivery::where('uniqueId', $id)->update($data);
    }
    public function destroy($id)
    {
        Delivery::where('uniqueId', $id)->delete();
    }
}
