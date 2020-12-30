@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<form id="EditForm" class="form-horizontal" method="post" action="/backend/site_management/edit">
				{{ csrf_field() }}
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">編輯網站</h4>
					</div>
					<div class="panel-body">
						<div>
							<input type="hidden" name="site_id" value="{{ $row->site_id }}" style="display:none">
							<table class="table" cellspacing="0" style="border-collapse:collapse;">
								<tbody>	
									<tr>
										<td class="header-require col-lg-2"><span style="color:red">*</span>會員名稱</td>
										<td>
											<div class="col-lg-4 nopadding">
												<input type="text" id="username" name="username" value="{{ $row->user_id }}" maxlength="80" class="form-control" readonly>
												<label class="error" for="username"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-2"><span style="color:red">*</span>目錄名稱</td>
										<td>
											<div class="col-lg-4 nopadding">
												<input type="text" id="folder_name" name="folder_name" value="{{ $row->folder_name }}" maxlength="80" class="form-control">
												<label class="error" for="folder_name"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-2"><span style="color:red">*</span>站名</td>
										<td>
											<div class="col-lg-4 nopadding">
												<input type="text" id="site_name" name="site_name" value="{{ $row->site_name }}" maxlength="80" class="form-control">
												<label class="error" for="site_name"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-2">標題</td>
										<td>
											<div class="col-lg-4 nopadding">
												<input type="text" id="title" name="title" value="{{ $row->title }}" maxlength="80" class="form-control">
												<label class="error" for="title"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-2">敘述</td>
										<td>
											<div class="col-lg-4 nopadding">
												<input type="text" id="description" name="description" value="{{ $row->description }}" maxlength="80" class="form-control">
												<label class="error" for="description"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-2">SEO meta</td>
										<td>
											<div class="col-lg-4 nopadding">
												<input type="text" id="og_meta" name="og_meta" value="{{ $row->og_meta }}" maxlength="80" class="form-control">
												<label class="error" for="og_meta"></label>
											</div>
										</td>
									</tr>
									<!-- 下控制按鈕 -->
									<tr>
										<td>&nbsp;</td>
										<td>
											<div style="text-align: right">			
												<a class="btn btn-xs btn-default" href="/backend/site_management">返回</a>
												<input type="submit" value="更新" class="btn btn-primary btn-xs" onclick="submitForm();">
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
			// jQuery Validation - start
			$('#EditForm').validate();

			$.validator.addMethod(
					"regex",
					function (value, element, regexp)
					{
						var re = new RegExp(regexp);
						return this.optional(element) || re.test(value);
					}
			);

			$('#folder_name').rules("add",
					{
						required: true,
						messages: {
							required: "required"
						}
					});

			$('#site_name').rules("add",
					{
						required: true,
						messages: {
							required: "required"
						}
					});
			// jQuery Validation - end

		});

		function submitForm()
		{
			if ($("#EditForm").valid() === false) {
				return false;
			} else {
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
		}
	</script>
@endsection
