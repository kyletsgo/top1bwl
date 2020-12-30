@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<form id="EditForm" class="form-horizontal" method="post" action="{{ asset('/backend/menu/' . $menu->id . '/function/store') }}">
				{{ csrf_field() }}
				<input type="hidden" name="menu_id" value="{{ $menu->id }}">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">新增功能 - 選單:{{ $menu->name }}</h4>
					</div>
					<div class="panel-body">
						<div>
							<table class="table" cellspacing="0" id="DetailsView1" style="border-collapse:collapse;">
								<tbody>
									<tr>
										<td class="header-require col-lg-1">名稱</td>
										<td>
											<div class="col-lg-2 nopadding">
												<input name="name" type="text" value="{{ old('name') }}" maxlength="100" id="name" class="form-control">
												<label class="error" for="name"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-1">連結</td>
										<td>
											<div class="col-lg-3 nopadding">
												<input name="link" type="text" value="{{ old('link') }}" maxlength="200" id="link" class="form-control">
												<label class="error" for="link"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-1">敘述</td>
										<td>
											<div class="col-lg-3 nopadding">
												<input name="description" type="text" value="{{ old('description') }}" maxlength="200" id="description" class="form-control">
												<label class="error" for="description"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-1">排序</td>
										<td>
											<div class="col-lg-1 nopadding">
												<input name="order" type="number" value="{{ old('order') }}" id="order" class="form-control">
												<label class="error" for="order"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-1">有無效</td>
										<td>
											<div class="col-lg-1 nopadding checkbox checkbox-primary">
												<input name="valid" type="checkbox" id="valid" checked>
												<label></label>
												<label class="error" for="valid"></label>
											</div>
										</td>
									</tr>
									<!-- 下控制按鈕 -->
									<tr>
										<td>&nbsp;</td>
										<td>
											<div style="text-align: right">
												<input type="submit" name="btnUpdate_foot" value="儲存" id="btnUpdate_foot" class="btn btn-primary btn-xs" onclick="submitForm();">
												<input type="button" name="btnBackTo2_foot" value="返回" id="btnBackTo2_foot" class="btn btn-default btn-xs">
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
	<link rel="stylesheet" href="{{ asset('assets/css/fontawesome-iconpicker.min.css') }}">
	<script src="{{ asset('assets/js/fontawesome-iconpicker.js') }}"></script>
	<script>
	//提交與取消按鈕
	function submitForm() {
		if (!!($("#EditForm").valid()) === false) {
			return false;
		} else {
			$(document).ready(function() {
				$.blockUI({ css: {
					border: 'none',
					padding: '15px',
					backgroundColor: '#000',
					'-webkit-border-radius': '10px',
					'-moz-border-radius': '10px',
					opacity: .5,
					color: '#fff'
				}});
			});
		}
	}
	</script>
@endsection
