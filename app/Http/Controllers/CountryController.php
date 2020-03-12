<?php

namespace App\Http\Controllers;

use App\Country;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $country = Country::where('country_name', 'LIKE', '%' . $request->search . '%')->paginate(10);
//        if ($request->pagination) {
//            $data = $country->paginate(10);
//        } else {
//            $data = $country;
//        }
        return response()->json(['status' => 'success', 'data' => $country]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('create-country');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $country = Country::create($request->all());
        return response()->json($country, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Country $country
     * @return void
     */
    public function show(Country $country)
    {
        return response()->json(['status' => 'success', 'data' => $country]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Country $country
     * @return void
     */
    public function edit(Country $country)
    {
        return view('edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Country $country
     * @return Country
     */
    public function update(Request $request, Country $country)
    {
        $country->update($request->all());
        return response()->json($country, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Country $country
     * @return bool|null
     * @throws Exception
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return response()->json(null, 204);
    }

    public function getLocationInfo()
    {

        $json = json_decode(file_get_contents("https://worldtimeapi.org/api/ip"), true);
        date_default_timezone_set($json['timezone']);
        $data = [
            'client_ip' => $json['client_ip'],
            'timezone' => $json['timezone'],
            'utc_datetime' => date("d F Y h:ia", strtotime($json['utc_datetime'])),
        ];
        return response()->json(['status' => 'success', 'data' => $data]);

    }

    public function convertTime(Request $request)
    {
        $rules = [
            'to_tz' => 'required',
            'from_tz' => 'required',
        ];

        $validator = validator($request->all(), $rules, []);

        if ($validator->fails()) {
            return response()->json(['status' => 200, 'errors' => $validator->getMessageBag()->toarray()]);
        }
        $to_tz = $request->to_tz;
        $from_tz = $request->from_tz;

        date_default_timezone_set($from_tz);
        if (isset($request->datetime)) {
            $currentDateTime = date('Y-m-d H:i:sP', strtotime($request->datetime));
        } else {
            $currentDateTime = date('Y-m-d H:i:sP');
        }
        $fromDateTime = date('Y-m-d h:iA', strtotime($currentDateTime));
        date_default_timezone_set($to_tz);

        $formated_to = date("d F Y h:i:s P", strtotime($currentDateTime));
        $toDateTime = date('Y-m-d h:iA', strtotime($formated_to));

        $data = [
            'from_tz' => $fromDateTime,
            'to_tz' => $toDateTime,
        ];
        return response()->json(['status' => 'success', 'data' => $data]);
    }


    public function countryList(){
        return view('country-list');
    }

    public function getLocation(){
        return view('location');
    }

    public function convertZone(){
        return view('convert');
    }

    public function vueTable(){
        return view('vueTable');
    }


}
