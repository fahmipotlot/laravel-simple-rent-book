<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rental;
use App\Models\Book;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $month = Rental::whereMonth('borrow_date', Carbon::now()->month)->get()->count();

        $sixmonth = Rental::whereBetween('borrow_date', 
                [Carbon::now()->subMonth(6)->format('Y-m-d H:i:s'), Carbon::now()->format('Y-m-d H:i:s')]
            )->get()->count();

        $topuser = DB::table('rentals')
            ->select('user_id', 'users.name as username', DB::raw('count(*) as total'))
            ->join('users', 'users.id', '=', 'rentals.user_id')
            ->groupBy(['user_id', 'username'])
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('month', 'sixmonth', 'topuser'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
