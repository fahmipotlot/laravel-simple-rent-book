@extends('layouts.app')
 
@section('title', 'Rental List')
 
@section('content')

	<a class="btn btn-success" href="javascript:void(0)" id="createNewUser"> Create New Rentals</a>
	<br>
	<br>
	<form action="">
		<div class="form-group">
			<div class="col-sm-12">
				<input type="text" class="form-control" id="q" name="q" placeholder="Search" value="{{ request()->q }}" maxlength="50" required="">
			</div>
		</div>
		<br>
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary">Search</button>
		</div>
	</form>
	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>User</th>
				<th>Book</th>
				<th>Borrow Date</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($rentals as $item)
				<tr>
					<td>{{ $item->id }}</td>
					<td>{{ $item->user->name }}</td>
					<td>{{ $item->book->name }}</td>
					<td>{{ $item->borrow_date }}</td>
					<td>
						<a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{ $item->id }}" data-original-title="Edit" class="edit btn btn-primary btn-sm editUser">Edit</a> ||
						<a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{ $item->id }}" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{ $rentals->links() }}

	<div class="modal fade" id="ajaxModel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modelHeading"></h4>
				</div>
				<div class="modal-body">
					<form id="rentalForm" name="rentalForm" class="form-horizontal">
					  <input type="hidden" name="rental_id" id="rental_id">
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">User</label>
							<div class="col-sm-12">
								<select name="user_id" id="user_id" class="form-control">
									@foreach($users as $user)
										<option value="{{$user->id}}">{{$user->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Book</label>
							<div class="col-sm-12">
								<select name="book_id" id="book_id" class="form-control">
									@foreach($books as $book)
										<option value="{{$book->id}}">{{$book->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Borrow Date</label>
							<div class="col-sm-12">
								<input type="datetime-local" id="borrow_date" name="borrow_date" class="form-control">
							</div>
						</div>
						<br>
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(function () {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$('#createNewUser').click(function () {
			$('#saveBtn').val("create-rental");
			$('#rental_id').val('');
			$('#rentalForm').trigger("reset");
			$('#modelHeading').html("Create New Book");
			$('#ajaxModel').modal('show');
		});

		$('body').on('click', '.editUser', function () {
			var rental_id = $(this).data('id');
			var url = '{{ route("rentals.show", ":id") }}';
			url = url.replace(':id', rental_id );
			$.get(url, function (data) {
				$('#modelHeading').html("Edit Book");
				$('#saveBtn').val("edit-rental");
				$('#ajaxModel').modal('show');
				$('#rental_id').val(data.id);
				$('#user_id').val(data.user.id).change();
				$('#book_id').val(data.book.id).change();
				$('#borrow_date').val(data.borrow_date).change();
			})
		});

		$('#saveBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Sending..');

			var action = $('#saveBtn').val();

			if (action === 'create-rental') {
				var method = 'POST';
				var url = "{{ route('rentals.store') }}";
			} else {
				var method = 'PUT';

				var rental_id = $('#rental_id').val();
				var url = '{{ route("rentals.update", ":id") }}';
				url = url.replace(':id', rental_id );
			}
		
			$.ajax({
				data: $('#rentalForm').serialize(),
				url: url,
				type: method,
				dataType: 'json',
				success: function (data) {			
					$('#rentalForm').trigger("reset");
					$('#ajaxModel').modal('hide');
					location.reload();				
				},
				error: function (data) {
					console.log('Error:', data);
					$('#saveBtn').html('Save Changes');
				}
			});
		});

		$('body').on('click', '.deleteUser', function () {
			var rental_id = $(this).data('id');
			var url = '{{ route("rentals.destroy", ":id") }}';
			url = url.replace(':id', rental_id );
			confirm("Are You sure want to delete !");
			
			$.ajax({
				type: "DELETE",
				url: url,
				success: function (data) {
					location.reload();
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		});
	});
</script>
@endpush