@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-dark">
				<div class="panel-heading">`
					<div class="row">
						<div class="form-group">
							<div class="panel-title">網站管理</div>
						</div>
						<div class="form-inline">
                            <form method="post" action="/backend/site_management" name="searchFrom">
								{{ csrf_field() }}
                                <div class="form-group">
                                    <label for="username" class="control-label" style="color:white;">會員名稱</label>
                                    <input type="text" id="username" name="username" value="{{ $cond->username }}" class="form-control">
                                </div>
								<div class="form-group">
									<label for="folder_name" class="control-label" style="color:white;">目錄名稱</label>
									<input type="text" id="folder_name" name="folder_name" value="{{ $cond->folder_name }}" class="form-control">
								</div>
								<div class="form-group">
									<label for="enable" class="control-label" style="color:white;">狀態</label>
									<select id="enable" name="enable" class="form-control">
										<option value="" {{ ($cond->enable == "") ? 'selected' : '' }}>不拘</option>
										<option value="1" {{ ($cond->enable == "1") ? 'selected' : '' }}>已生成</option>
										<option value="0" {{ ($cond->enable == "0") ? 'selected' : '' }}>未生成</option>
									</select>
								</div>
                                <div class="form-group">
                                    <a id="btnOK" class="btn btn-danger btn-xs">搜尋</a>
                                </div>
                            </form>
                        </div>
					</div>
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>編號</th>
							<th>會員</th>
							<th>目錄名稱</th>
							<th>站名</th>
							<th>標題</th>
							<th>敘述</th>
							<th>Keywords</th>
							<th>生成狀態</th>
							<th>建立時間</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($rows as $key => $row)
							<tr>
								<td>{{ $rows->firstItem() + $key }}</td>
								<td>{{ $row->nickname }}</td>
								<td>{{ $row->folder_name }}</td>
								<td>{{ $row->site_name }}</td>
								<td>{{ $row->title }}</td>
								<td>{{ $row->description }}</td>
								<td>{{ $row->og_meta }}</td>
								<td>{{ $row->enable === 1 ? '已生成' : '未生成' }}</td>
								<td>{{ $row->created_at }}</td>

								<td style="text-align: right">
									<a class="btn btn-warning btn-xs" href="/backend/site_management/edit/{{ $row->site_id }}">
										<strong>編輯</strong>
									</a>
									@if ($row->enable !== 0)
										<a class="btn btn-info btn-xs" href="/backend/page_manage/">
											<strong>前往建立網頁</strong>
										</a>
									@elseif ($isAdmin === true)
										<button type="button" class="btn btn-success btn-xs enableSite" data-siteid="{{ $row->site_id }}">
											<strong>生成網站</strong>
										</button>
									@endif
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

            $("#btnOK").on("click", function ()
            {
                $('form[name="searchFrom"]').submit();
            });

			$('.enableSite').click(function (e) {
				showBlockUI();

				$.ajax({
					type: "POST",
					url: "/backend/site_management/enable_site",
					dataType: "json",
					data: {
						'siteId': $(this).attr('data-siteid')
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
