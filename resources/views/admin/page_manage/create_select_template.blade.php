@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<form id="EditForm" class="form-horizontal" method="post" action="/backend/page_manage/create_page">
				{{ csrf_field() }}
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">選擇網站版型</h4>
					</div>
					<div class="panel-body">
						<div>
							<table class="table" cellspacing="0" style="border-collapse:collapse;">
								<tbody>
								<tr>
									<td class="header-require col-lg-2">版型</td>
									<td>
										<div class="col-lg-4 nopadding">
											<select name="template" id="template" class="form-control">
												<option value="1" selected>1</option>
												<option value="2">2</option>
												<option value="3">3</option>
											</select>
											<label class="error" for="template"></label>
										</div>
									</td>
								</tr>
								<!-- 下控制按鈕 -->
								<tr>
									<td>&nbsp;</td>
									<td>
										<div style="text-align: right">
											<a class="btn btn-xs btn-default" href="/backend/page_manage/">返回</a>
											<input type="submit" value="建立" class="btn btn-primary btn-xs" onclick="submitForm();">
										</div>
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- panel-body -->
				</div>
			</form>
		</div>
	</div>
@endsection

@section('extjs')
	<script>
		$(function()
		{

		});

		function submitForm()
		{
			$.blockUI({ css: {
					border: 'none',
					padding: '15px',
					backgroundColor: '#000',
					'-webkit-border-radius': '10px',
					'-moz-border-radius': '10px',
					opacity: .5,
					color: '#fff'
				}});
		}
	</script>
@endsection
