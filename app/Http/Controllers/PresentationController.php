<?php

namespace App\Http\Controllers;

use App\Jobs\FetchPresentationDataJob;
use App\Models\Presentation;
use Illuminate\Http\Request;
use OpenAI;

class PresentationController extends Controller
{

    public function index()
    {

        $presentations = Presentation::all();

        return view('dashboard', compact('presentations'));
    }
    public function store(Request $request)
    {


        $presentation = Presentation::create([
            'title' => $request->title,
            'description' => $request->description,

            'user_id' => auth()->user()->id
        ]);
        FetchPresentationDataJob::dispatch($presentation);
    }
}
