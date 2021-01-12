@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<form id="EditForm" class="form-horizontal" method="post" action="/backend/resource_manage/create">
				{{ csrf_field() }}
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">新增文章</h4>
					</div>
					<div class="panel-body">
						<div>
							<table class="table" style="border-collapse:collapse;">
								<tbody>
									<tr>
										<td class="header-require col-lg-2">標題</td>
										<td>
											<div class="col-lg-3 nopadding">
												<input type="text" id="title" name="title" value="{{ old('title') }}" maxlength="80" class="form-control">
												<label class="error" for="title"></label>
											</div>
										</td>
									</tr>
									<tr>
										<td class="header-require col-lg-2">內容</td>
										<td>
											<div class="col-lg-8 nopadding">
												<textarea id="content" name="content" class="form-control" rows="30" cols="30">{{ old('content') }}</textarea>
												<label class="error" for="content"></label>
											</div>
										</td>
									</tr>
									<!-- 下控制按鈕 -->
									<tr>
										<td>&nbsp;</td>
										<td>
											<div style="text-align: right">
												<input type="submit" value="新增" class="btn btn-primary btn-xs" onclick="submitForm();">
												<a class="btn btn-xs btn-default" href="/backend/resource_manage">返回</a>
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
			jqueryValidation();
		});

		function jqueryValidation() {
			$('#EditForm').validate();

			$.validator.addMethod(
					"regex",
					function (value, element, regexp)
					{
						var re = new RegExp(regexp);
						return this.optional(element) || re.test(value);
					}
			);

			$('#title').rules("add", {
				required: true,
				maxlength: 80,
				messages: {
					required: "此欄位必填",
					maxlength: "最長 80 個字"
				}
			});

			$('#content').rules("add", {
				required: true,
				maxlength: 60000,
				messages: {
					required: "此欄位必填",
					maxlength: "最長 60000 個字"
				}
			});
		}

		function submitForm() {
			if ($("#EditForm").valid() === false) {
				return false;
			}

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
