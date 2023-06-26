@extends('layouts.app')
 
@section('title', 'Soal 1')
 
@section('content')
	<div class="panel panel-default">
		<h3>Table</h3>
		<table class="table">
			<thead>
				<tr>
					<th>Code</th>
					<th>Name</th>
					<th>Parent</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $dt)
					<tr>
						<td>{{ $dt['code'] }}</td>
						<td>{{ $dt['name'] }}</td>
						<td>{{ $dt['parent'] }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
					<div class="panel-heading">Get All Child</div>
					<div class="panel-body">
							<form action="" method="GET">
									<div class="control-group after-add-more">
											<label>Code</label>
											<input type="text" name="input" class="form-control" value={{ request()->get('input') }}>
									</div>
									<br/>
									<button class="btn btn-success" type="submit">Submit</button>
							</form>
			<br/>
			@isset($all_child)
				@foreach($all_child as $child)
					<li>{{ $child }}</li>
				@endforeach
			@endisset
		</div>
			</div>
	</div>
@endsection