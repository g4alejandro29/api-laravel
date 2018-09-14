<?php

namespace App\Http\Controllers\Carousel;

use App\Models\Carousel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Request\CarouselStoreRequest;
class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carousel = Carousel::toJSONArray(Carousel::getList());
        return response()->json([
            'data' => $carousel,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarouselStoreRequest $request)
    {
        $file = $request->input('image');
        $file_name = 'carousel_'.time().'.jpg';
        $public_path = storage_path();
        list(, $file) = explode(';', $file);
        list(, $file) = explode(',', $file);
        if ($file != "") {
            \Storage::disk('public')->put($file_name, base64_decode($file));
        }
        $carousel = new Carousel();
        $carousel->site_id = $request->input('site_id');
        $carousel->image = $file_name;
        $carousel->path = $public_path;
        $carousel->extension = $request->input('extension');
        $carousel->save();
        $response = response()->json([
            "data"=>$carousel->toJSONObject()
        ], 201);
       return json_encode($response, JSON_UNESCAPED_SLASHES);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carousel $carousel
     * @return \Illuminate\Http\Response
     */
    public function show(Carousel $carousel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carousel $carousel
     * @return \Illuminate\Http\Response
     */
    public function edit(Carousel $carousel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Carousel $carousel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carousel $carousel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carousel $carousel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carousel $carousel)
    {
        //
    }
}