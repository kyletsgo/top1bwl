@extends('admin.master')

@section('content')
	<!-- 列表段 -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-dark">
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6">
							<div class="panel-title">Manage Groups</div>
						</div>
						<div class="col-md-6" style="text-align: right">
							<a class="btn btn-darkblue btn-xs" href="{{ asset('/backend/Usergroups/create') }}"><strong>Add</strong></a>
						</div>
					</div>
				</div>
				<table class="table table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>no</th>
							<th>Group Name</th>
							<th>Valid</th>
							<th>Create Time</th>
							<th>Modify Time</th>
							<th>Operate</th>
						</tr>
					</thead>
					<tbody>
						@foreach($tables as $data)
							<tr>
								<td>{{ $data->id }}</td>
								<td>{{ $data->Name }}</td>
								<td><input type="checkbox" {{ ($data->Valid == 1) ? 'checked' : '' }} disabled></td>
								<td>{{ $data->created_at }}</td>
								<td>{{ $data->updated_at }}</td>
								<td style="text-align: right">
									<form method="post" action="{{ asset('/backend/Usergroups/'.$data->id) }}">
										<a class="btn btn-warning btn-xs" href="{{ asset('/backend/Usergroups/edit/'.$data->id) }}">
											<strong>Edit</strong>
										</a>
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="submit" class="btn btn-danger btn-xs"><strong>Delete</strong></button>
									</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
