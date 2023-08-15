<?php

namespace App\Http\Controllers;
use DB;
use Str;
use Location;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function posts()
    {
        $posts = DB::table('posts')
                    ->leftJoin('users', 'users.id', '=', 'posts.user_id')
                    ->select('users.name', 'posts.id', 'posts.title', 'posts.categories', 'posts.created_at', 'posts.featured_image', 'posts.slug')
                    ->orderBy('posts.id', 'desc')
                    ->take(10)
                    ->get();
        return response()->json($posts);
    }
    public function allPosts()
    {
        $posts = DB::table('posts')
                    ->leftJoin('users', 'users.id', '=', 'posts.user_id')
                    ->select('users.name', 'posts.id', 'posts.title', 'posts.categories', 'posts.created_at', 'posts.featured_image', 'posts.slug')
                    ->orderBy('posts.id', 'desc')
                    ->take(50)
                    ->get();
        return response()->json($posts);
    }
    public function post($slug)
    {
        $post = DB::table('posts')
                    ->leftJoin('users', 'users.id', '=', 'posts.user_id')
                    ->select('users.name', 'posts.id', 'posts.title', 'posts.categories', 'posts.content', 'posts.created_at', 'posts.featured_image', 'posts.slug')
                    ->where('posts.slug', $slug)
                    ->first();
        return response()->json($post);
    }
    public function getLocation()
    {
        $ip = '102.89.45.239';
        //$ip =  request()->ip();
        $data = \Location::get($ip);
        $city = $data->cityName;
        return response()->json($city);
    }
    public function pharmacies()
    {
        $ip = '102.89.45.239';
        //$ip =  request()->ip();
        $data = \Location::get($ip);
        $city_name = $data->cityName;
        $pharmacies = DB::table('facility_signatures')
                            ->where(['state' => $city_name, 'facility_type' => 'Pharmaceutical Premises'])
                            ->orderBy('created_at', 'asc')
                            ->take(10)
                            ->get();
        return response()->json($pharmacies);
    }
    public function allPharmacies()
    {
        $ip = '102.89.45.239';
        //$ip =  request()->ip();
        $data = \Location::get($ip);
        $city_name = $data->cityName;
        $pharmacies = DB::table('facility_signatures')
                            ->where(['state' => $city_name, 'facility_type' => 'Pharmaceutical Premises'])
                            ->orderBy('created_at', 'asc')
                            ->get();
        return response()->json($pharmacies);
    }
    public function laboratories()
    {
        $ip = '102.89.45.239';
        //$ip =  request()->ip();
        $data = \Location::get($ip);
        $city_name = $data->cityName;
        $laboratories = DB::table('facility_signatures')
                            ->where(['state' => $city_name, 'facility_type' => 'Laboratory'])
                            ->orderBy('created_at', 'asc')
                            ->take(10)
                            ->get();
        return response()->json($laboratories);
    }
    public function allLaboratories()
    {
        $ip = '102.89.45.239';
        //$ip =  request()->ip();
        $data = \Location::get($ip);
        $city_name = $data->cityName;
        $laboratories = DB::table('facility_signatures')
                            ->where(['state' => $city_name, 'facility_type' => 'Laboratory'])
                            ->orderBy('created_at', 'asc')
                            ->get();
        return response()->json($laboratories);
    }
    public function privateHospitals()
    {
        $ip = '102.89.45.239';
        //$ip =  request()->ip();
        $data = \Location::get($ip);
        $city_name = $data->cityName;
        $hospitals = DB::table('facility_signatures')
                            ->where(['state' => $city_name, 'facility_type' => 'Hospital', 'ownership_type' => 'Private'])
                            ->orderBy('created_at', 'asc')
                            ->take(10)
                            ->get();
        return response()->json($hospitals);
    }
    public function allPrivateHospitals()
    {
        $ip = '102.89.45.239';
        //$ip =  request()->ip();
        $data = \Location::get($ip);
        $city_name = $data->cityName;
        $hospitals = DB::table('facility_signatures')
                            ->where(['state' => $city_name, 'facility_type' => 'Hospital', 'ownership_type' => 'Private'])
                            ->orderBy('created_at', 'asc')
                            ->get();
        return response()->json($hospitals);
    }
    public function publicHospitals()
    {
        $ip = '102.89.45.239';
        //$ip =  request()->ip();
        $data = \Location::get($ip);
        $city_name = $data->cityName;
        $hospitals = DB::table('facility_signatures')
                            ->where(['state' => $city_name, 'facility_type' => 'Hospital', 'ownership_type' => 'Public'])
                            ->orderBy('created_at', 'asc')
                            ->take(10)
                            ->get();
        return response()->json($hospitals);
    }
    public function allPublicHospitals()
    {
        $ip = '102.89.45.239';
        //$ip =  request()->ip();
        $data = \Location::get($ip);
        $city_name = $data->cityName;
        $hospitals = DB::table('facility_signatures')
                            ->where(['state' => $city_name, 'facility_type' => 'Hospital', 'ownership_type' => 'Public'])
                            ->orderBy('created_at', 'asc')
                            ->get();
        return response()->json($hospitals);
    }
    public function drugs()
    {
        $ip = '102.89.45.239';
        //$ip =  request()->ip();
        $data = \Location::get($ip);
        $city_name = $data->cityName;
        $drugs = DB::table('drugs')
                    ->leftJoin('stocks', 'stocks.drug_id', '=', 'drugs.id')
                    ->leftJoin('facility_signatures', 'facility_signatures.facility_id', '=', 'drugs.facility_id')
                    ->where('facility_signatures.state', $city_name)
                    ->orderBy('facility_signatures.created_at', 'asc')
                    ->select('drugs.name', 'drugs.nafdac_number', 'drugs.manufacturer', 'drugs.shelf_name', 'drugs.prescription_slip', 'stocks.total_quantity', 'stocks.price', 'facility_signatures.registered_facility_name', 'facility_signatures.physical_location', 'facility_signatures.state', 'facility_signatures.local_government_area', 'facility_signatures.phone_number', 'facility_signatures.website', 'facility_signatures.hours_of_operation', 'facility_signatures.slug')
                    ->take(20)
                    ->get();
        return response()->json($drugs);
    }
    public function laboratoryCentres()
    {
        $ip = '102.89.45.239';
        //$ip =  request()->ip();
        $data = \Location::get($ip);
        $city_name = $data->cityName;
        $laboratories =  DB::table('laboratory_medical_tests')
                            ->leftJoin('medical_laboratory_tests', 'medical_laboratory_tests.id', '=', 'laboratory_medical_tests.test_id')
                            ->leftJoin('facility_signatures', 'facility_signatures.facility_id', '=', 'laboratory_medical_tests.facility_id')
                            ->where('facility_signatures.state', $city_name)
                            ->orderBy('facility_signatures.created_at', 'asc')
                            ->select('laboratory_medical_tests.price', 'medical_laboratory_tests.test_name', 'medical_laboratory_tests.url', 'facility_signatures.registered_facility_name', 'facility_signatures.physical_location', 'facility_signatures.state', 'facility_signatures.local_government_area', 'facility_signatures.phone_number', 'facility_signatures.website', 'facility_signatures.hours_of_operation', 'facility_signatures.slug')
                            ->take(20)
                            ->get();
        return response()->json($laboratories);
    }
    public function medicalServices()
    {
        $ip = '102.89.45.239';
        //$ip =  request()->ip();
        $data = \Location::get($ip);
        $city_name = $data->cityName;
        $medical_services = DB::table('medical_services')
                                ->leftJoin('facility_signatures', 'facility_signatures.facility_id', '=', 'medical_services.facility_id')
                                ->where('facility_signatures.state', $city_name)
                                ->select('medical_services.name', 'medical_services.price', 'facility_signatures.registered_facility_name', 'facility_signatures.physical_location', 'facility_signatures.state', 'facility_signatures.local_government_area', 'facility_signatures.phone_number', 'facility_signatures.website', 'facility_signatures.hours_of_operation', 'facility_signatures.slug')
                                ->take(20)
                                ->get();
        return response()->json($medical_services);
    }
    public function facilityDetailsBySlug($slug)
    {
        $facility = DB::table('facility_signatures')
                        ->leftJoin('users', 'users.id', '=', 'facility_signatures.facility_id')
                        ->where('slug', $slug)
                        ->select('facility_signatures.*', 'users.name', 'users.email')
                        ->first();
        $services = DB::table('medical_services')->where('facility_id', $facility->facility_id)->get();
        $laboratories = DB::table('laboratory_medical_tests')
                            ->leftJoin('medical_laboratory_tests', 'medical_laboratory_tests.id', '=', 'laboratory_medical_tests.test_id')
                            ->where('laboratory_medical_tests.facility_id', $facility->facility_id)
                            ->select('medical_laboratory_tests.test_name', 'laboratory_medical_tests.price', 'medical_laboratory_tests.url')
                            ->get();
        return response()->json(['facility' => $facility, 'services' => $services, 'laboratories' => $laboratories]);
    }
    public function fewDiseases()
    {
        return response()->json(DB::table('disease_conditions')->take(50)->get());
    }
    public function diseasesGroup($letter)
    {
        $diseases = DB::table('disease_conditions')
                        ->where('name', 'LIKE', $letter . '%')
                        ->orWhere('name', 'LIKE', Str::upper($letter) . '%')
                        ->orderBy('name', 'asc')
                        ->get();
        return response()->json($diseases);
    }
    public function diseases()
    {
        return response()->json(DB::table('disease_conditions')->orderBy('name', 'asc')->select('name', 'url')->get());
    }
    public function laboratoryTests()
    {
        return response()->json(DB::table('medical_laboratory_tests')->orderBy('test_name', 'asc')->select('test_name', 'url')->get());
    }
    public function laboratoryTestsGroup($letter)
    {
        $tests = DB::table('medical_laboratory_tests')
                        ->where('test_name', 'LIKE', $letter . '%')
                        ->orWhere('test_name', 'LIKE', Str::upper($letter) . '%')
                        ->orderBy('test_name', 'asc')
                        ->get();
        return response()->json($tests);
    }
    public function fewLaboratoryTests()
    {
        return response()->json(DB::table('medical_laboratory_tests')->take(50)->get());
    }


}
