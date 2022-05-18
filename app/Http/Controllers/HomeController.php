<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://europeanastefan-skliarovv1.p.rapidapi.com/getDatasets",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "apiKey=lecitchysbun",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: Europeanastefan-skliarovV1.p.rapidapi.com",
                "X-RapidAPI-Key: 0ab2fe8b0amshde98fb0af00d23ap14855fjsneca8f465d72b",
                "content-type: application/x-www-form-urlencoded"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
        $books = Book::all();

        return view('home')->with('books', $books);
    }
}