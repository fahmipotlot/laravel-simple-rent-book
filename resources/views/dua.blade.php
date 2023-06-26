@extends('layouts.app')
 
@section('title', 'Soal 2')
 
@section('content')
        <div class="panel panel-default">
            <div class="panel-heading">Get Fibonanci Number</div>
            <div class="panel-body">
                <form action="" method="GET">
                    <div class="control-group after-add-more">
                        <label>Number</label>
                        <input type="text" name="input" class="form-control" value={{ request()->get('input') }}>
                    </div>
                    <br/>
                    <button class="btn btn-success" type="submit">Submit</button>
                </form>
				<br/>
				@isset($fibonanci)
					@foreach($fibonanci as $fib)
						<li>{{ $fib }}</li>
					@endforeach
				@endisset
			</div>
        </div>
@endsection