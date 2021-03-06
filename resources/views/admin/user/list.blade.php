@extends('admin.master')
@inject('BackendPresenter', 'App\Presenter\BackendPresenter')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-dark">
				<div class="panel-heading">
					<div class="row">
						<div class="form-group">
							<div class="panel-title">會員管理</div>
						</div>
						<div class="form-inline">
							<form method="post" action="" name="searchFrom">
								{{ csrf_field() }}
								<div class="form-group">
									@if ($current_user_role !== 1)
										<a class="btn btn-darkblue btn-xs" href="/backend/user/create">
											<i class="fas fa-plus"></i><strong>新增</strong>
										</a>
									@endif
								</div>
							</form>
						</div>
					</div>
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>編號</th>
							<th>名稱</th>
							<th>帳號</th>
							<th>權限</th>
							<th>所屬代理管理員</th>
							<th>建立時間</th>
							<th>更新時間</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					@foreach($rows as $key => $row)
							<tr>
								<td>{{ $rows->firstItem() + $key }}</td>
								<td>{{ $row->nickname }}</td>
								<td>{{ $row->username }}</td>
								<td>{{ $BackendPresenter->convertUserRole($row->role) }}</td>
								<td>{{ $row->parent_username }}</td>
								<td>{{ $row->created_at }}</td>
								<td>{{ $row->updated_at }}</td>
								<td style="text-align: right">
									{!! $BackendPresenter->showUserControl($current_user_role, $row) !!}
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
@endsection

@section('extjs')
	<script>
		$(function()
		{
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$('.deleteUser').click(function () {
				if (confirm("確認要刪除") !== true) {
					return;
				}

				$.ajax({
					'type': "POST",
					'url': '/backend/user/delete',
					data: {
						'userId': $(this).attr('data-userid')
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

			$('.releaseAuth').click(function (e) {
				showBlockUI();

				$.ajax({
					type: "POST",
					url: "/backend/user/release_auth",
					dataType: "json",
					data: {
						'userId': $(this).attr('data-userid')
					},
				}).done( function(result) {
					console.log(result);

					if (result.code === 0) {
						location.reload();
					}
				}).fail(function() {
					console.log('error');
				}).always(function() {
					$.unblockUI();
				});
			});
		});

		function showBlockUI() {
			$.blockUI({
				css: {
					border: 'none',
					padding: '15px',
					backgroundColor: '#000',
					'-webkit-border-radius': '10px',
					'-moz-border-radius': '10px',
					opacity: .5,
					color: '#fff'
				}
			});
		}
	</script>
@endsection
