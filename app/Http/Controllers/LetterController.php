<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\LetterFile;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    //
    function index($type = 'letter')
    {
        $letters = Letter::type($type)->get();
        $title = Letter::title($type);
        return view('front.letters.index', compact('letters', 'title'));
    } //

    function create($id)
    {
        $letter = Letter::findOrFail($id);
        $title = $letter->getTitle() . " | " . $letter->title;
        $title_2 = $letter->getTitle(true);
        return view('front.letters.create', compact('letter', 'title', 'title_2'));
    }

    function store($id, Request $request)
    {
        $letter = Letter::findOrFail($id);
        $this->validate($request, [
            'variables' => "required|array",
            'variables.*' => "required",
            'image' => 'required|in:' . implode(',', array_keys($letter->images))
        ]);


        $file = $letter->files()->create([
            'user_id' => auth()->id(),
            'variable' => $request->variables,
            'status' => 1,
            'image' => $request->image,
        ]);


        \App\Jobs\UpdateFileImage::dispatch($file);

        return $this->response()->with('file', $file->toArray())->with('redirect_to', route('letters.files.show', $file->id))->success();
    }

    function files($type = 'letter')
    {
        $file = LetterFile::whereHas('letter', function ($q) {
            $q->type('letter');
        })->findOrFail($id);

    }


    function shareFilePdf($id)
    {
        $file = LetterFile::with('letter')->findOrFail($id);


//        return view('front.files.pdf', $data);
        $pdf = \PDF::loadView('front.files.pdf', compact('file'));


        return $pdf->download('ete.pdf');
    }

    function shareFilePrint($id)
    {
        $file = LetterFile::with('letter')->findOrFail($id);

        $print = true;

//        return view('front.files.pdf', $data);
        return view('front.files.pdf', compact('file', 'print'));

    }

    function filesShow($id)
    {
        $file = LetterFile::with('letter')->findOrFail($id);
        return view('front.files.show', compact('file'));
    }
}
