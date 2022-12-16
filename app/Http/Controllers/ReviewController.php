<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ReviewController extends Controller
{
    
    public function __construct(){
        $this->middleware('verified', ['except' => ['index', 'films', 'books','records', 'show']]);
    }
    
    public function index()
    {
        $reviews = Review::orderBy('created_at', 'desc')->get();
        return view('review.index', ['reviews' => $reviews]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = [
            'film' => 'Movie',
            'record' => 'Record',
            'book' => 'Book',
        ];
        
        return view('review.create', ['types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $review = new Review();
            $review->nombre = $request->nombre;
            $review->tipo = $request->tipo;
            $review->review = $request->review;
            $iduser = Auth::user()->id;
            $review->iduser = $iduser;
            if($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
                $archivo = $request->file('thumbnail');
                $path = $archivo->getRealPath();
                $imagen = file_get_contents($path);
                $review->thumbnail = base64_encode($imagen);
            }
            $review->save();
            $images = $request->images;
            $img = new Image();
            $img->storeImg($images, $review->id);
            $type = $review->tipo;
            return redirect('reviews/' . $type);
        }catch(\Exception $e){
            return back()
                ->withInput()
                ->withErrors(['message' => 'An unexpected error occurred while creating.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        
        return view('review.show', ['review' => $review]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        $types = [
            'film' => 'Movie',
            'record' => 'Record',
            'book' => 'Book',
        ];
        if($review->iduser === Auth::user()->id){
            return view('review.edit', ['review' => $review, 'types' => $types]);
        }else{
            return back()->withErrors(['message' => 'You can not edit other people posts']);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        try{
            $remove = $request->toRemove;
            if($remove){
                foreach($remove as $id){
                    $img = Image::where('id', $id)->get();
                    foreach($img as $i){
                        $name = $i->name;
                        Storage::disk('local')->delete('public/images/' . $name);
                        Image::where('id', $id)->delete();
                    }
                }
            }
            
            $review->nombre = $request->nombre;
            $review->tipo = $request->tipo;
            $review->review = $request->review;
            $iduser = Auth::user()->id;
            $review->iduser = $iduser;
            if($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
                $archivo = $request->file('thumbnail');
                $path = $archivo->getRealPath();
                $imagen = file_get_contents($path);
                $review->thumbnail = base64_encode($imagen);
            }
            $images = $request->images;
            $img = new Image();
            if($images){
                $img->storeImg($images, $review->id);
            }
            $review->update();
            $type = $review->tipo;
            return redirect('reviews/' . $type);
        }catch(\Exception $e){
            return back()
                ->withInput()
                ->withErrors(['message' => 'An unexpected error occurred while creating.']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        if($review->iduser === Auth::user()->id){
            try{
                $imgs = Image::where('idreview', $review->id)->get();
                foreach($imgs as $img){
                    $name = $img->name;
                    Storage::disk('local')->delete('public/images/' . $name);
                }
                $type = $review->tipo;
                $review->delete();
                return redirect('reviews/' . $type);
            }catch(\Exception $e){
                return back()->withErrors();
                ['default' => 'Compruebe algo'];
            }
        }else{
            return back()->withErrors(['message' => 'No puedes editar las reviews de otros usuarios!']);
        }
    }
    
    public function films()
    {
        $reviews = Review::orderBy('created_at', 'desc')->get();
        return view('review.films', ['reviews' => $reviews]);
    }
    
    public function records()
    {
        $reviews = Review::orderBy('created_at', 'desc')->get();
        return view('review.records', ['reviews' => $reviews]);
    }
    
    public function books()
    {
        $reviews = Review::orderBy('created_at', 'desc')->get();
        return view('review.books', ['reviews' => $reviews]);
    }
}
