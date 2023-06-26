@extends('layouts.app')
 
@section('title', 'Book List')
 
@section('content')

	<a class="btn btn-success" href="javascript:void(0)" id="createNewUser"> Create New Book</a>
	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($books as $item)
				<tr>
					<td>{{ $item->id }}</td>
					<td>{{ $item->name }}</td>
					<td>
						<a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{ $item->id }}" data-original-title="Edit" class="edit btn btn-primary btn-sm editUser">Edit</a> ||
						<a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{ $item->id }}" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser">Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{ $books->links() }}

	<div class="modal fade" id="ajaxModel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modelHeading"></h4>
				</div>
				<div class="modal-body">
					<form id="bookForm" name="bookForm" class="form-horizontal">
					    <input type="hidden" name="book_id" id="book_id">
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Name</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
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
			$('#saveBtn').val("create-book");
			$('#book_id').val('');
			$('#bookForm').trigger("reset");
			$('#modelHeading').html("Create New Book");
			$('#ajaxModel').modal('show');
		});

		$('body').on('click', '.editUser', function () {
			var book_id = $(this).data('id');
			var url = '{{ route("books.show", ":id") }}';
			url = url.replace(':id', book_id );
			$.get(url, function (data) {
				$('#modelHeading').html("Edit Book");
				$('#saveBtn').val("edit-book");
				$('#ajaxModel').modal('show');
				$('#book_id').val(data.id);
				$('#name').val(data.name);
			})
		});

		$('#saveBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Sending..');

			var action = $('#saveBtn').val();

			if (action === 'create-book') {
				var method = 'POST';
				var url = "{{ route('books.store') }}";
			} else {
				var method = 'PUT';

				var book_id = $('#book_id').val();
				var url = '{{ route("books.update", ":id") }}';
				url = url.replace(':id', book_id );
			}
		
			$.ajax({
				data: $('#bookForm').serialize(),
				url: url,
				type: method,
				dataType: 'json',
				success: function (data) {			
					$('#bookForm').trigger("reset");
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
			var book_id = $(this).data('id');
			var url = '{{ route("books.destroy", ":id") }}';
			url = url.replace(':id', book_id );
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