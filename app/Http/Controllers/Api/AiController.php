<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AiController extends Controller
{
    public function generateDescription(Request $request)
    {
        $prompt = $request->input('prompt');
        
        // In a real app, you'd call an LLM API here.
        // For now, we simulate a professional botanical response.
        $name = $request->input('name', 'This herb');
        
        $description = "Experience the pure essence of {$name}. Sourced directly from the Atlas Mountains, this premium selection is hand-picked for its potent natural properties and aromatic excellence. Perfect for aromatherapy, holistic wellness, or as a signature addition to your natural apothecary collection. 100% organic, cruelty-free, and ethically harvested.";

        return response()->json([
            'description' => $description
        ]);
    }
}