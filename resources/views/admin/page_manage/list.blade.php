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
									@if ($current_user_site_enable === 1)
									<a class="btn btn-darkblue btn-xs" href="/backend/page_manage/create_select_template">新增網頁</a>
									@endif
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
					@if ($current_user_role === 1 && $current_user_site_enable === 0)
						<tr>
							<td>
								網站未生成，請洽管理員。
							</td>
						</tr>
					@else
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
									<button type="button" class="btn btn-danger btn-xs deleteItem" data-itemId="{{ $row->page_id }}">
										<strong>刪除</strong>
									</button>
								</td>
							</tr>
						@endforeach
					@endif
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
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$('.deleteItem').click(function () {
				if (confirm("確認要刪除") !== true) {
					return;
				}

				$.ajax({
					'type': "POST",
					'url': '/backend/page_manage/delete',
					data: {
						'itemId': $(this).attr('data-itemId')
					},
					dataType: 'json',
					success: function (result) {
						console.log(result);

						if (result.code === 0) {
							location.reload();
						}
					},
					error: function (e) {
						console.log(e);
					}
				});
			});
        });
    </script>
@endsection
