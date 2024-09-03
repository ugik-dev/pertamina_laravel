<?php

namespace App\Http\Controllers;

use App\Events\LiveLocationEvent;
use App\Helpers\DataStructure;
use App\Models\LiveLocation;
use App\Models\RefLiveLocation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Hash;

class LiveLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        $dataContent =  [
            'refLiveLocation' => RefLiveLocation::get(),
        ];
        return view('page.live_location.index', compact('request', 'dataContent'));
    }

    public function get(Request $request)
    {
        try {
            $query =  LiveLocation::with('ref_live_location');
            if (!empty($request->id)) $query->where('id', '=', $request->id);
            $res = $query->get()->toArray();
            $data =   DataStructure::keyValueObj($res, 'id');

            return $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $att = [
                'name' => $request->name,
                'police_number' => $request->police_number,
                'key_login' => Hash::make($request->key_login), // Corrected the Hash::make syntax
                'id_login' => $request->id_login,
                'ref_live_location_id' => $request->ref_live_location_id,
                'description' => $request->description,
            ];
            $data = LiveLocation::create($att);
            $data = LiveLocation::with('ref_live_location')->find($data->id);
            // LiveLocationEvent::dispatch($data->id, $data->long, $data->lat, $data->name, $data->police_number);

            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }

    public function monitoring(string $id)
    {
        try {
            $data =  LiveLocation::with('ref_live_location')->find($id);
            // $pusher = new LiveLocationEvent($data->id, $data->long, $data->lat, $data->name, $data->police_number);
            // broadcast($pusher)->toOthers('1');

            return view('page.live_location.monitoring', ['dataContent' => $data]);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request)
    {
        try {
            $data = LiveLocation::with('ref_live_location')->findOrFail($request->id);
            $att = [
                'name' => $request->name,
                'police_number' => $request->police_number,
                'id_login' => $request->id_login,
                'ref_live_location_id' => $request->ref_live_location_id,
                'description' => $request->description,
            ];
            if (!empty($request->key_login)) $att['key_login'] = Hash::make($request->key_login);
            $data->update($att);

            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }


    public function delete(Request $request)
    {
        try {
            $data = LiveLocation::with('ref_live_location')->findOrFail($request->id);
            $data->delete();
            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }

    public function update_location(Request $request)
    {
        try {
            $validate  = $request->validate([
                'latitude' => 'required',
                'longitude' => 'required',
            ]);
            $new = [
                'lat' => $validate['latitude'],
                'long' => $validate['longitude'],
            ];
            $live = $request->user();
            $live->update($new);

            LiveLocationEvent::dispatch($live->id, $live->long, $live->lat, $live->name, $live->police_number);
            return  $this->responseSuccess('', 'Success update');
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }
}
