<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getCurrentWeather(Request $request)
    {
        // Fetch the API key from the environment file
        $apiKey = env('WEATHER_API_KEY');

        // Define the endpoint and parameters
        $city = $request->input('city', 'London'); // Default if no city is provided.

        // Update the endpoint to get both current weather and forecast
        $endpoint = "http://api.weatherapi.com/v1/forecast.json";

        // Make the API request
        $response = Http::get($endpoint, [
            'key' => $apiKey,
            'q' => $city,
            'days' => 7, // Requesting a 7-day forecast along with the current weather
        ]);

        // Return the json response.
        return response()->json($response->json());
    }
}
