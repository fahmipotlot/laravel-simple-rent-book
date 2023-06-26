@extends('layouts.app')
 
@section('title', 'Dashboard')
 
@section('content')
  <div class="card" style="width: 18rem;">
    <div class="card-body">
      <h3 class="card-title">{{$month}}</h3>
      <h6 class="card-subtitle mb-2 text-muted">Jumlah buku yang dipinjam bulan ini</h6>
    </div>
  </div>
  <br>
  <div class="card" style="width: 18rem;">
    <div class="card-body">
      <h3 class="card-title">{{$sixmonth}}</h3>
      <h6 class="card-subtitle mb-2 text-muted">Jumlah buku yang dipinjam 6 bulan terahir</h6>
    </div>
  </div>
  <br>
  <div class="card" style="width: 18rem;">
    <div class="card-body">
      <h3 class="card-title">Top User Peminjam</h3>
      <h6 class="card-subtitle mb-2 text-muted">5 user yang meminjam buku terbanyak</h6>
      <p class="card-text">
        <ul>
          @foreach ($topuser as $item)
            <li>{{$item->username}} meminjam {{$item->total}} Buku</li>
          @endforeach
        </ul>
      </p>
    </div>
  </div>
@endsection