@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-dark">
				<div class="panel-heading">
					<div class="row">
						<div class="form-group">
							<div class="panel-title">Manage Member Terms</div>
						</div>
					</div>
				</div>
				<table class="table table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>編號</th>
							<th>類別</th>
							<th>內容</th>
							<th>更新時間</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $data)
							<tr>
								<td>{{ $data->id }}</td>
								<td>{{ $data->category }}</td>
								<td>
									<div style="width: 1024px; height: 300px; overflow:hidden;">{!! $data->content !!}</div>
								</td>
								<td>{{ $data->updated_at }}</td>
								<td style="text-align: right">
									<form method="post" action="">
										<a class="btn btn-warning btn-xs" href="{{ asset('/backend/member_terms/edit/'.$data->id) }}">
											<strong>Edit</strong>
										</a>
										{{ csrf_field() }}
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
