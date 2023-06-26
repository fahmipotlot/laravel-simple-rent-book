<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rental;
use App\Models\Book;
use DB;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->q) {
            $rentals = Rental::whereHas('user', function ($query) {
                    return $query->where(DB::raw("LOWER(users.name)"), 'LIKE', "%".strtolower(request()->input('q'))."%");
                })
                ->orWhereHas('book', function ($query) {
                    return $query->where(DB::raw("LOWER(books.name)"), 'LIKE', "%".strtolower(request()->input('q'))."%");
                })
                ->with(['user', 'book'])
                ->paginate(10);
        } else {
            $rentals = Rental::with(['user', 'book'])->paginate(10);
        }
        $books = Book::all();
        $users = User::all();

        return view('rental.index', ['rentals' => $rentals, 'books' => $books, 'users' => $users]);
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
        Rental::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => $request->borrow_date
        ]);

        return response()->json(['success'=> 'Rental saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Rental::with(['user', 'book'])->find($id);
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
        $rental = Rental::find($id);
        $rental->user_id = $request->user_id;
        $rental->book_id = $request->book_id;
        $rental->borrow_date = $request->borrow_date;
        return $rental->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Rental::find($id)->delete();
    }
}
