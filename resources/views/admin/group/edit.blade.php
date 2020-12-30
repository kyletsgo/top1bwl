@extends('admin.master')

@inject('BackendPresenter', 'App\Presenter\BackendPresenter')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/dragula.min.css') }}">
<style>
	select {
		padding: 0px 10px !important;
		height: 200px !important;
	}
	select > option {
		margin: 10px 0px;
		padding: 10px;
		border-radius: 5px;
	}
	select#users > option,
	select#functions > option {
		background-color: #d6ffe8;
	}
	select#users-unassign > option,
	select#functions-unassign > option {
		background-color: #ececec;
	}
	.mr-10 {
		margin-right: 10px;
	}
</style>
<div class="row">
	<div class="col-lg-12">
		<form id="EditForm" class="form-horizontal" method="post" action="{{ asset('/backend/group/' . $group->id) }}">
			{{ csrf_field() }}
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title">編輯群組</h4>
				</div>
				<div class="panel-body">
					<div>
						<table class="table" cellspacing="0" id="DetailsView1" style="border-collapse:collapse;">
							<tbody>
								<tr>
									<td class="header-require col-lg-2">名稱</td>
									<td>
										<div class="col-lg-3 nopadding">
											<input name="name" type="text" value="{{ $group->name }}" maxlength="20" id="name" class="form-control">
											<label class="error" for="name"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td class="header-require col-lg-2">成員</td>
									<td>
										<div class="col-lg-3 nopadding mr-10">
											<input type="hidden" name="users" value="{{ $group->users }}" />
											<label for="users">已指派</label>
											<select class="form-control" id="users" multiple>
												@foreach ($assignedUsers as $user)
													<option value="{{ $user->id }}">{{ $user->name }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-lg-3 nopadding">
											<label for="users-unassign">未指派</label>
											<select class="form-control" id="users-unassign" multiple>
												@foreach ($unassignedUsers as $user)
													<option value="{{ $user->id }}">{{ $user->name }}</option>
												@endforeach
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td class="header-require col-lg-2">功能</td>
									<td>
										<div class="col-lg-3 nopadding mr-10">
											<input type="hidden" name="functions" value="{{ $group->functions }}" />
											<label for="functions">已指派</label>
											<select class="form-control" id="functions" multiple>
												@foreach ($assignedFunctions as $function)
													<option value="{{ $function->id }}">{{ $function->name }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-lg-3 nopadding">
											<label for="functions-unassign">未指派</label>
											<select class="form-control" id="functions-unassign" multiple>
												@foreach ($unassignedFunctions as $function)
													<option value="{{ $function->id }}">{{ $function->name }}</option>
												@endforeach
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td class="header-require col-lg-2">有無效</td>
									<td>
										<div class="col-lg-3 nopadding checkbox checkbox-primary">
											<input name="valid" type="checkbox" id="valid" @if ($group->valid === 1) checked @endif>
											<label></label>
											<label class="error" for="valid"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td class="col-lg-2">建立時間</td>
									<td>{{ $group->created_at }}</td>
								</tr>

								<!-- Edit Mode -->
								<tr>
									<td class="col-lg-2">最後修改</td>
									<td>{{ $group->updated_at }}</td>
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
<script src='{{ asset('assets/js/dragula.min.js') }}'></script>
<script>
	
	$(document).ready(function () {
		dragula([document.querySelector('#users'), document.querySelector('#users-unassign')]);
		dragula([document.querySelector('#functions'), document.querySelector('#functions-unassign')]);
		//Back
		$("#btnBackTo2_foot").click(function () {
			location.href = '{{ asset('backend/group') }}';
		});
	});
	//提交與取消按鈕
	function submitForm() {
		var users = ",";
		var functions = ",";
		
		$("#users option").each(function(){
			users = users + $(this).val() + ",";
		});
		$("#functions option").each(function(){
			functions = functions + $(this).val() + ",";
		});

		$("input[name=users]").val(users);
		$("input[name=functions]").val(functions);


		if (!!($("#EditForm").valid()) === false) {
			return false;
		} else {
			$(document).ready(function () {
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
			});
		}
	}
</script>
@endsection