<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->q) {
            $books = Book::where(function ($query) {
                    return $query->where(\DB::raw("LOWER(name)"), 'LIKE', "%".strtolower(request()->input('q'))."%");
                })
                ->paginate(10);
        } else {
            $books = Book::paginate(10);
        }

        return view('book.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Book::create([
            'name' => $request->name
        ]);

        return response()->json(['success'=> 'Book saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Book::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);
        $book->name = $request->name;
        return $book->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Book::find($id)->delete();
    }
}
