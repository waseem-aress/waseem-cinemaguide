<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Image;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movies::latest()->paginate(5);
        return view("movies.index",compact("movies"))
            ->with("i", (request()->input("page", 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("movies.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
            "movie_length" => "required",
            "poster" => "required|mimes:jpeg,png |max:4096",
            "parental_rating" => "required",
        ]);

        $checker = Movies::select("title")->where("title",$request->title)->exists();

        if ($checker) {
           return redirect()->route("movies.create")->with("error","Movie title already exists.");
        }

        /* Upload Movie poster after Updating fields into db */
        if ($request->file("poster")) {
            $profileImagePath = storage_path("app/public/movie-images");
             if(!is_dir($profileImagePath))
            {
                mkdir($profileImagePath);
            }
            $fileName = time().'_'.$request->file("poster")->getClientOriginalName();
            $request->file("poster")->move($profileImagePath, $fileName);
        }

        $data = $request->all();
        $data['poster'] = $fileName;
        Movies::create($data);
        return redirect()->route("movies.index")->with("success","Cinema created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movies  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movies $movie)
    {
        return view("movies.show",compact("movie"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movies  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movies $movie)
    {
        return view("movies.edit",compact("movie"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movies  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movies $movie)
    {
        $request->validate([
            'title' => "required",
            "movie_length" => "required",
            "poster" => "required|mimes:jpeg,png|max:4096",
            "parental_rating" => "required",
        ]);

        if ($request->title != $movie->title) {
            $checker = Movies::select("title")->where("title",$request->title)->exists();
            
            if ($checker) {
                   return redirect()->route("movies.edit", $movie->id)->with("error","Movie title already exists.");
            }
        }

        /* Upload Movie poster after Updating fields into db */
        if ($request->file("poster")) {
            $profileImagePath = storage_path("app/public/movie-images");
            if(!is_dir($profileImagePath))
            {
                mkdir($profileImagePath);
            }
            $fileName = time().'_'.$request->file("poster")->getClientOriginalName();
            $request->file("poster")->move($profileImagePath, $fileName);
            
            // Delete poster image when adding new movie poster
              $movieData = Movies::where("id", "=", $movie->id)->first();
              $path = storage_path("app/public/movie-images")."/".$movieData->poster;

              if (File::exists($path)) {
                unlink($path);
              }
        }

        $data = $request->all();
        $data['poster'] = $fileName;
        $movie->update($data);
        return redirect()->route("movies.index")
                        ->with("success","Movies updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movies  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movies $movie)
    {
        $movie->delete();
        return redirect()->route("movies.index")
                        ->with("success","Movies deleted successfully");
    }

    /* Function to Upload profile images. [ THis function is not in use for now.] */

    public function movieImageUpload($file) {

        $input['poster'] = time() . "." . $file->getClientOriginalExtension();
        $profileImagePath = storage_path("app/public/movie-images");

        if(!is_dir($profileImagePath))
        {
            mkdir($profileImagePath);
        }

        // Delete Earlier profile images
        File::delete($profileImagePath);
        $destinationPath = storage_path("app/public/movie-images");

        $full_img->save($destinationPath . "/" . "movie-" . $input['poster'], 80);
        return $input['poster'];
    }
}
