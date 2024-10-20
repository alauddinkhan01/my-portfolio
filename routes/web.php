<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $response = Http::get(env('BASE_URL') . '/api/profile?populate=*');
    $projectResponse = Http::get(env('BASE_URL') . '/api/projects?populate=*');
    $slidersResponse = Http::get(env('BASE_URL') . '/api/sliders?populate=*');
    
    if ($response->successful()) {
        
        $userProfile = $response->json();
        $projects = $projectResponse->json();
        $sliders = $slidersResponse->json();

        // dd($sliders['data']);
        // You can pass this data to the view or use it as needed
        return view('welcome', compact('userProfile','projects','sliders'));
    } else {
        // Handle the error here
        return response()->json(['error' => 'Failed to fetch user profile'], $response->status());
    }
});
