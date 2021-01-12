@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<form id="EditForm" class="form-horizontal" method="post" action="/backend/line_management/edit">
				{{ csrf_field() }}
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">編輯line加好友連結</h4>
					</div>
					<div class="panel-body">
						<div>
							<table class="table" cellspacing="0" style="border-collapse:collapse;">
								<tbody>	
									<tr>
										<td class="header-require col-lg-2"><span style="color:red">*</span>line加好友連結</td>
										<td>
											<div class="col-lg-4 nopadding">
												<input type="text" id="line_link" name="line_link" value="{{ $add_friend_link }}" maxlength="200" class="form-control">
												<label class="error" for="line_link"></label>
											</div>
										</td>
									</tr>
									<!-- 下控制按鈕 -->
									<tr>
										<td>&nbsp;</td>
										<td>
											<div style="text-align: right">			
												<input type="submit" value="儲存" class="btn btn-primary btn-xs" onclick="submitForm();">
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

			$('#line_link').rules("add",
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
