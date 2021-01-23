@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<form id="EditForm" class="form-horizontal" method="post" action="/backend/calendar/edit" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">行事曆區</h4>
					</div>
					<iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Asia%2FTaipei&amp;src=b2dpbHZ5d29yay50ZXN0QGdtYWlsLmNvbQ&amp;src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&amp;src=emgudGFpd2FuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&amp;color=%23039BE5&amp;color=%2333B679&amp;color=%230B8043" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>
					<div class="panel-body">
						<div>
							<table class="table" cellspacing="0" style="border-collapse:collapse;">
								<tbody>
								<tr>
									<td class="header-require col-lg-2">電腦圖片</td>
									<td>
										<div class="col-lg-3 nopadding">
											<input id="largeImage" name="largeImage" type="file" class="form-controller" />
											<label class="error" for="largeImage"></label>
										</div>
										<div class="col-md-8 nopadding">
											<img src="{{ url($row->image_large) }}" alt="largeImageePreview" width="500">
										</div>
									</td>
								</tr>
								<tr>
									<td class="header-require col-lg-2">手機圖片</td>
									<td>
										<div class="col-lg-3 nopadding">
											<input id="smallImage" name="smallImage" type="file" class="form-controller" />
											<label class="error" for="smallImage"></label>
										</div>
										<div class="col-md-8 nopadding">
											<img src="{{ url($row->image_small) }}" alt="smallImagePreview" width="300">
										</div>
									</td>
								</tr>
								<!-- 下控制按鈕 -->
								<tr>
									<td>&nbsp;</td>
									<td>
										<div style="text-align: right">
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
		$(function ()
		{
		});

		function submitForm() {
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