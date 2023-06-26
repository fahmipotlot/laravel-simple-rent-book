@extends('layouts.app')
 
@section('title', 'User List')
 
@section('content')

	<a class="btn btn-success" href="javascript:void(0)" id="createNewUser"> Create New User</a>
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
				<th>Name</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $item)
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
	{{ $users->links() }}

	<div class="modal fade" id="ajaxModel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modelHeading"></h4>
				</div>
				<div class="modal-body">
					<form id="userForm" name="userForm" class="form-horizontal">
					    <input type="hidden" name="user_id" id="user_id">
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
			$('#saveBtn').val("create-user");
			$('#user_id').val('');
			$('#userForm').trigger("reset");
			$('#modelHeading').html("Create New User");
			$('#ajaxModel').modal('show');
		});

		$('body').on('click', '.editUser', function () {
			var user_id = $(this).data('id');
			var url = '{{ route("users.show", ":id") }}';
			url = url.replace(':id', user_id );
			$.get(url, function (data) {
				$('#modelHeading').html("Edit User");
				$('#saveBtn').val("edit-user");
				$('#ajaxModel').modal('show');
				$('#user_id').val(data.id);
				$('#name').val(data.name);
			})
		});

		$('#saveBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Sending..');

			var action = $('#saveBtn').val();

			if (action === 'create-user') {
				var method = 'POST';
				var url = "{{ route('users.store') }}";
			} else {
				var method = 'PUT';

				var user_id = $('#user_id').val();
				var url = '{{ route("users.update", ":id") }}';
				url = url.replace(':id', user_id );
			}
		
			$.ajax({
				data: $('#userForm').serialize(),
				url: url,
				type: method,
				dataType: 'json',
				success: function (data) {			
					$('#userForm').trigger("reset");
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
			var user_id = $(this).data('id');
			var url = '{{ route("users.destroy", ":id") }}';
			url = url.replace(':id', user_id );
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