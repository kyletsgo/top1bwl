@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-dark">
				<div class="panel-heading">`
					<div class="row">
						<div class="form-group">
							<div class="panel-title">推廣表單</div>
						</div>
						<div class="form-inline">
                            <form method="post" action="" name="searchFrom">
								{{ csrf_field() }}
                            </form>
                        </div>
					</div>
				</div>
				<table class="table table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>編號</th>
							<th>Email</th>
							<th>姓名</th>
							<th>Line</th>
							<th>所屬會員</th>
							<th>建立時間</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($rows as $key => $row)
							<tr>
								<td>{{ $rows->firstItem() + $key }}</td>
								<td>{{ $row->email }}</td>
								<td>{{ $row->name }}</td>
								<td>{{ $row->line }}</td>
								<td>{{ $row->username }}</td>
								<td>{{ $row->created_at }}</td>

								<td style="text-align: right">
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="col-md-12 text-center no-margin">
					{{ $rows->links() }}
				</div>
			</div>
		</div>
	</div>

	<script>
		$(function ()
		{
        });
    </script>
@endsection
