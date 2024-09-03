<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Faskes;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class InformationController extends Controller
{
    //

    public function index(Request $request, $slug = null)
    {
        try {
            $data = Content::select(
                'contents.*',
                'ref_contents.name as name_content'
            )
                ->join('ref_contents', 'ref_contents.id', '=', 'contents.ref_content_id');
            if (!empty($slug)) $data = $data->where('slug', '=', $slug)->first();
            else
                $data = $data->get();

            return $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }


    public function faskes(Request $request)
    {
        try {
            $data = Faskes::select(
                'faskes.*',
                'ref_jen_faskes.name as name_jenis'
            )
                ->join('ref_jen_faskes', 'ref_jen_faskes.id', '=', 'faskes.ref_jen_faskes_id')
                ->get();
            if (!empty($request->long) && !empty($request->lat)) {
                // dd($data);
                $newData =  $this->getDistance($request, $data);
            } else {
                // Handle the case when either $request->long or $request->lat is not set or is null
            }
            return $this->responseSuccess($newData);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }

    function getDistance($request, $dataLocation)
    {
        $origin = $request->lat . ',' . $request->long;
        $apiKey = env('GOOGLE_MAPS_API_KEY');
        $client = new Client();
        $results = [];

        foreach ($dataLocation as $location) {
            $destination = $location->lat . ',' . $location->long;
            $response = $client->get("https://maps.googleapis.com/maps/api/distancematrix/json", [
                'query' => [
                    'origins' => $origin,
                    'destinations' => $destination,
                    'key' => $apiKey,
                ],
            ]);

            // dd($origin, $destination);
            $data = json_decode($response->getBody(), true);
            if ($data['status'] == 'OK') {
                $distanceInMeters = $data['rows'][0]['elements'][0]['distance']['value'];
                $distanceInKilometers = $distanceInMeters / 1000; // Convert distance to kilometers
                $roundedDistance = round($distanceInKilometers, 1); // Round to 1 digit after the decimal point

                $tmp_result = $location;
                $tmp_result['distance'] = $roundedDistance . ' km'; // Include the rounded distance in kilometers
                $tmp_result['distance_o'] = $data['rows'][0]['elements'][0]['distance']['text'];
                $tmp_result['url'] = "https://www.google.com/maps/dir/?api=1&origin={$origin}&destination={$destination}";
                $results[] = $tmp_result;
            } else {
                return $this->ResponseError('Failed to fetch distance');
            }
        }

        // Sort results by duration (or distance) to find the fastest destination
        usort($results, function ($a, $b) {
            return strtotime($a['distance_o']) - strtotime($b['distance_o']);
        });
        return $results;
        // return response()->json(['fastest_destination' => $results[0]]);
    }
}
