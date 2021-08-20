<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Movies;
Use App\Models\Cinemas;
Use App\Models\Session_Times;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FrontAPIController extends Controller
{
        // API to register user with name/email/password/password_confirmation input parameters
       protected function register(Request $request)
       {
            $validatedData = $request->validate([
                'name'=>'required|max:55',
                'email'=>'email|required|unique:users',
                'password'=>'required|confirmed'
            ]);
            $validatedData['password'] = bcrypt($request->password);
            $user = User::create($validatedData);
            $accessToken = $user->createToken('authToken')->accessToken;
            return response(['user'=> $user, 'access_token'=> $accessToken]);
       }
       // API to get all movies list with number parameter for pagination
       protected function movies()
       {
            $data = Movies::latest()->simplePaginate(5);
            $status=400;
            if($data){
                $status=200;
            }
            return response()->json([
                'status' => $status,
                'data' => $data
            ]);
       }
       // API to get all cinemas list with number parameter for pagination
       protected function cinemas()
       {
            $data = Cinemas::latest()->simplePaginate(5);
            $status=400;
            if($data){
                $status=200;
            }
            return response()->json([
                'status' => $status,
                'data' => $data
            ]);
       }
       // API to get movie detail with title parameter 
       protected function movie_details($title="")
       {
           $data =  Movies::where('title', '=', $title)->first();
           $status=400;
           if($data){
               $status=200;
           }
           return response()->json([
               'status' => $status,
               'data' => $data
           ]);
       }
       // API to get cinema detail with name parameter 
       protected function cinema_details($name="")
       {
            $data = Cinemas::where('name', '=', $name)->first();
            $status=400;
            if($data){
                $status=200;
            }
            return response()->json([
                'status' => $status,
                'data' => $data
            ]);
       }

        // API to get cinema detail with name parameter 
        protected function movie_time($cinema, $date) {
        // Get List of movies associated with Cinema
            return  Movies::join('session__times', 'session__times.movie_id', '=', 'movies.id')
                    ->join('cinemas', 'session__times.cinema_id', '=', 'cinemas.id')
                    ->where('cinemas.name', 'like', '%' . $cinema . '%')
                    ->whereDate('session__times.date_time', '=', date("Y-m-d", strtotime($date)))
                    ->get(['movies.id', 'movies.title', 'movies.parental_rating', 'movies.movie_length', 'movies.poster', 'session__times.date_time']);
        }
}
