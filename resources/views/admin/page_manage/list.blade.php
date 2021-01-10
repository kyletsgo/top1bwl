@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-dark">
				<div class="panel-heading">`
					<div class="row">
						<div class="form-group">
							<div class="panel-title">網頁管理</div>
						</div>
						<div class="form-inline">
							<form method="post" action="{{ asset('/backend/page_manage') }}" name="searchFrom">
								{{ csrf_field() }}
								<div class="form-group">
									<a class="btn btn-darkblue btn-xs" href="/backend/page_manage/create_select_template">新增網頁</a>
								</div>
							</form>
                        </div>
					</div>
				</div>
				<table class="table table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>編號</th>
							<th>標題</th>
							<th>URL</th>
							<th>會員</th>
							<th>建立時間</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($rows as $key => $row)
							<tr>
								<td>{{ $rows->firstItem() + $key }}</td>
								<td>{{ $row->title }}</td>
								<td>{{ $row->url }}</td>
								<td>{{ $row->nickname }}</td>
								<td>{{ $row->created_at }}</td>

								<td style="text-align: right">
									<a class="btn btn-warning btn-xs" href="/backend/page_manage/edit/{{ $row->page_id }}">
										<strong>編輯</strong>
									</a>
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
