<?php

namespace App\Http\Controllers;

use App\Helpers\DataStructure;
use App\Models\Content;
use App\Models\RefContent;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        $dataContent =  [
            'refContent' => RefContent::get(),
        ];
        return view('page.content.index', compact('request', 'dataContent'));
    }

    public function get(Request $request)
    {
        try {
            $query =  Content::with('ref_content');
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
            $slug = Content::createUniqueSlug($request->judul);
            $att = [
                'judul' => $request->judul,
                'content' => $request->content,
                'tanggal' => $request->tanggal,
                'ref_content_id' => $request->ref_content_id,
                'slug' => $slug,
            ];

            $data = Content::create($att);
            $data = Content::with('ref_content')->find($data->id);

            $request->validate([
                'file_sampul' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add appropriate validation rules
            ]);

            if ($request->hasFile('file_sampul')) {
                $photo = $request->file('file_sampul');
                $originalFilename = time() . $photo->getClientOriginalName(); // Ambil nama asli file
                $path = $photo->storeAs('upload/content', $originalFilename, 'public');
                // dd($path);
                $data->sampul = $originalFilename;
                $data->save();
            }

            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }

    public function show(string $slug)
    {
        try {
            $query =  Content::with('ref_content');
            $query->where('slug', '=', $slug);
            $res = $query->get()->first();
            return view('page.content.show', ['dataContent' => $res]);
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
            $data = Content::with('ref_content')->findOrFail($request->id);
            $att = [
                'judul' => $request->judul,
                'content' => $request->content,
                'tanggal' => $request->tanggal,
                'ref_content_id' => $request->ref_content_id,
            ];
            if ($request->judul != $data->judul)
                $att['slug'] = Content::createUniqueSlug($request->judul, $request->id);

            if ($request->hasFile('file_sampul')) {
                $photo = $request->file('file_sampul');
                $originalFilename = time() . $photo->getClientOriginalName(); // Ambil nama asli file
                $path = $photo->storeAs('upload/content', $originalFilename, 'public');
                // dd($path);
                $att['sampul']  = $originalFilename;
            }
            $data->update($att);
            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }


    public function delete(Request $request)
    {
        try {
            $data = Content::with('ref_content')->findOrFail($request->id);
            $data->delete();
            return  $this->responseSuccess($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }
}
