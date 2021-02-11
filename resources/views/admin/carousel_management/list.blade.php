@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-dark">
				<div class="panel-heading">`
					<div class="row">
						<div class="form-group">
							<div class="panel-title">輪播模組</div>
						</div>
						<div class="form-inline">
                            <form method="post" action="" name="searchFrom">
								{{ csrf_field() }}
								<div class="form-group">
									<a class="btn btn-darkblue btn-xs" href="/backend/carousel_management/create">
										<i class="fas fa-plus"></i><strong>新增</strong>
									</a>
								</div>
                            </form>
                        </div>
					</div>
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>編號</th>
							<th>標題</th>
							<th>建立時間</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($rows as $key => $row)
							<tr>
								<td>{{ $rows->firstItem() + $key }}</td>
								<td>{{ $row->title }}</td>
								<td>{{ $row->created_at }}</td>

								<td style="text-align: right">
									<a class="btn btn-warning btn-xs" href="/backend/carousel_management/edit/{{ $row->carousel_id }}">
										<strong>編輯</strong>
									</a>
									<button type="button" class="btn btn-danger btn-xs deleteItem" data-itemId="{{ $row->carousel_id }}">
										<strong>刪除</strong>
									</button>
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
		$(function()
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
					'url': '/backend/carousel_management/delete',
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
