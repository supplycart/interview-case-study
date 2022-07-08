<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Movie;
use App\Models\Producer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Show the actor list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Actor::with(['movie'])->get();
        
        $actor = [];
        foreach($data as $value){
            $actor[] = (object) array_merge((array) $value->toArray(), (array) [
                'imagePath' => $value->image ? 'images/'.$value->image : 'images/no_photo.png',
                'dateFormat' => Carbon::parse($value->date_of_birth)->format('d M Y'),
            ]);
        }
        $actor = collect($actor);
        
        return view('actor', compact('actor'));
    }

    /**
     * Remove actor from page.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            $actor = Actor::find($request->id)->delete();

            if ($actor) {
                $data = Actor::with(['movie'])->get();
        
                $actor = [];
                foreach($data as $value){
                    $actor[] = (object) array_merge((array) $value->toArray(), (array) [
                        'imagePath' => $value->image ? 'images/'.$value->image : 'images/no_photo.png',
                        'dateFormat' => Carbon::parse($value->date_of_birth)->format('d M Y'),
                    ]);
                }
                $actor = collect($actor);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Actor successfully deleted.',
                'data' => $actor,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Store new actor from create page
     *
     * @return mixed
     */
    public function store(Request $request)
    {   
        try{
            $validator = validator(
                $request->all(),
                [
                    'name' => ['required'],
                    'image' => ['nullable', 'max:2000', 'mimes:jpeg,jpg,png'],
                ],
                [
                    'name.required' => 'Actor name is required',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ]);
            }
            
            $file_name = 'actor-'.rand(). '.' .$request->image->getClientOriginalExtension();
        
            $dataList = [
                'name' => $request->name,
                'date_of_birth' => $request->date_of_birth == '0000-00-00' ? Carbon::now() : $request->date_of_birth,
                'biography' => $request->biography,
                'sex' => $request->sex,
                'image' => $file_name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];

            $actor = Actor::create($dataList);
            
            if ($actor) {
                $request->image->move(public_path('images/'), $file_name);
                $data = Actor::with(['movie'])->get();
        
                $actor = [];
                foreach($data as $value){
                    $actor[] = (object) array_merge((array) $value->toArray(), (array) [
                        'imagePath' => $value->image ? 'images/'.$value->image : 'images/no_photo.png',
                        'dateFormat' => Carbon::parse($value->date_of_birth)->format('d M Y'),
                    ]);
                }
                $actor = collect($actor);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Actor successfully created.',
                'data' => $actor,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update actor from create page
     *
     * @return mixed
     */
    public function update(Request $request)
    {   
        $request->setMethod('PATCH');
        try{
            $validator = validator(
                $request->all(),
                [
                    'name' => ['required'],
                    'imageNew' => ['nullable', 'max:2000', 'mimes:jpeg,jpg,png'],
                ],
                [
                    'name.required' => 'Actor name is required',
                    'imageNew.max' => 'The image may not be greater than 2000 kilobytes',
                    'imageNew.mimes' => 'The image must be a file of type: jpeg, jpg, png',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ]);
            }
            
            $file_name = $request->imageNew ? 'actor-'.rand(). '.' .$request->imageNew->getClientOriginalExtension() : $request->image;
        
            $dataList = [
                'name' => $request->name,
                'date_of_birth' => $request->date_of_birth == '0000-00-00' ? Carbon::now() : $request->date_of_birth,
                'biography' => $request->biography,
                'sex' => $request->sex,
                'image' => $file_name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];

            $actor = Actor::find($request->id)->update($dataList);
            
            if ($actor) {
                $request->imageNew ? $request->imageNew->move(public_path('images/'), $file_name) : '';

                $data = Actor::with(['movie'])->get();
        
                $actor = [];
                foreach($data as $value){
                    $actor[] = (object) array_merge((array) $value->toArray(), (array) [
                        'imagePath' => $value->image ? 'images/'.$value->image : 'images/no_photo.png',
                        'dateFormat' => Carbon::parse($value->date_of_birth)->format('d M Y'),
                    ]);
                }
                $actor = collect($actor);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Actor successfully updated.',
                'data' => $actor,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
