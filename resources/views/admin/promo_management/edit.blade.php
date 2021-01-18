@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<form id="EditForm" class="form-horizontal" method="post" action="/backend/promo_management/edit" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">編輯促銷活動</h4>
					</div>
					<div class="panel-body">
						<div>
							<input type="hidden" name="promo_id" value="{{ $row->promo_id }}" style="display:none">
							<table class="table" cellspacing="0" style="border-collapse:collapse;">
								<tbody>
								<tr>
									<td class="header-require col-lg-2">標題</td>
									<td>
										<div class="col-lg-3 nopadding">
											<input type="text" id="title" name="title" value="{{ $row->title }}" maxlength="80" class="form-control">
											<label class="error" for="title"></label>
										</div>
									</td>
								</tr>
								<tr>
									<td class="header-require col-lg-2">圖片</td>
									<td>
										<div class="col-lg-3 nopadding">
											<input id="promoImage" name="promoImage" type="file" class="form-controller" />
											<label class="error" for="promoImage"></label>
										</div>
										<div class="col-md-8 nopadding">
											<img src="{{ url($row->image) }}" alt="promoImagePreview" width="500">
										</div>
									</td>
								</tr>
								<!-- 下控制按鈕 -->
								<tr>
									<td>&nbsp;</td>
									<td>
										<div style="text-align: right">
											<a class="btn btn-xs btn-default" href="/backend/promo_management">返回</a>
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
@endsection
