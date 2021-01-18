@extends('admin.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-dark">
				<div class="panel-heading">`
					<div class="row">
						<div class="form-group">
							<div class="panel-title">行事曆區</div>
						</div>
						<div class="form-inline">
                            <form method="post" action="" name="searchFrom">
								{{ csrf_field() }}
                            </form>
                        </div>
					</div>
				</div>
				<div class="panel-body">
					<div>
						<table class="table" cellspacing="0" style="border-collapse:collapse;">
							<tbody>
							<tr>
								<td class="header-require col-lg-2">圖片</td>
								<td>
									<div class="col-lg-3 nopadding">
										<input id="promoImage" name="promoImage" type="file" class="form-controller" />
										<label class="error" for="promoImage"></label>
									</div>
									<div class="col-md-8 nopadding">
										<img src="" alt="promoImagePreview" width="500">
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
				<iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Asia%2FTaipei&amp;src=b2dpbHZ5d29yay50ZXN0QGdtYWlsLmNvbQ&amp;src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&amp;src=emgudGFpd2FuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&amp;color=%23039BE5&amp;color=%2333B679&amp;color=%230B8043" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>
			</div>
		</div>
	</div>

	<script>
		$(function ()
		{
        });
    </script>
@endsection
