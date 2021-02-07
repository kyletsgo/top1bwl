@extends('admin.master')

@section('content')
	<script src="/ckfinder/ckfinder.js"></script>
	<div class="row">
		<div class="col-lg-12">
			<form id="EditForm" class="form-horizontal" method="post" action="/backend/carousel_management/create" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 class="panel-title">新增輪播模組</h4>
					</div>
					<div class="panel-body">
						<div>
							<table class="table" style="border-collapse:collapse;">
								<tbody>
								<tr>
									<td class="header-require col-lg-2">輪播模組標題</td>
									<td>
										<div class="col-lg-3 nopadding">
											<input type="text" id="carouselTitle" class="form-control">
											<label class="error" for="carouselTitle"></label>
										</div>
									</td>
								</tr>
								<tr class="ckfinder-item">
									<td class="header-require col-lg-2">圖片 1</td>
									<td>
										<div class="col-lg-4 nopadding">
											<label>圖片標題</label>
											<input class="ckfinder-title form-control" type="text"><br>
											<input class="ckfinder-input" type="text" style="width:80%">
											<button class="ckfinder-popup">Browse</button>
										</div>
										<div class="col-md-8">
											<img src="/ckfinder/userfiles/images/cars.jpg" alt="NoImagee" width="500">
										</div>
									</td>
								</tr>
								<tr class="ckfinder-item">
									<td class="header-require col-lg-2">圖片 2</td>
									<td>
										<div class="col-lg-4 nopadding">
											<label>圖片標題</label>
											<input class="ckfinder-title form-control" type="text"><br>
											<input class="ckfinder-input" type="text" style="width:80%">
											<button class="ckfinder-popup">Browse</button>
										</div>
										<div class="col-md-8">
										</div>
									</td>
								</tr>
								<!-- 下控制按鈕 -->
								<tr>
									<td>&nbsp;</td>
									<td>
										<div style="text-align: right">
											<button id="addItem" type="button" class="btn btn-primary btn-xs">
												<strong>新增</strong>
											</button>
											<a class="btn btn-xs btn-default" href="/backend/carousel_management">返回</a>
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
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			jqueryValidation();

			$('#addItem').click(function () {
				// $.blockUI({ css: {
				// 		border: 'none',
				// 		padding: '15px',
				// 		backgroundColor: '#000',
				// 		'-webkit-border-radius': '10px',
				// 		'-moz-border-radius': '10px',
				// 		opacity: .5,
				// 		color: '#fff'
				// 	}});

				var images = [];
				$('.ckfinder-item').each(function( index, element ) {
					var title = $(this).find('.ckfinder-title').val();
					var img_url = $(this).find('.ckfinder-input').val();

					images.push({
						'title': title,
						'img_url': img_url
					});
				});

				$.ajax({
					'type': "POST",
					'url': '/backend/carousel_management/create',
					data: {
						'carouselTitle': $('#carouselTitle').val(),
						'images': JSON.stringify(images)
					},
					dataType: 'json',
					success: function (result) {
						console.log(result);

						if (result.code === 0) {
							location.reload();
						}
					},
					error: function (e) {
						console.log(e);
					}
				});
			});
		});

		$('.ckfinder-popup').click(function (e) {
			e.preventDefault();
			var $ckfinder_input = $(this).prevAll('.ckfinder-input').first();
			selectFileWithCKFinder($ckfinder_input);
		});

		function selectFileWithCKFinder($element) {
			CKFinder.popup( {
				chooseFiles: true,
				readOnly: true,
				width: 800,
				height: 600,
				onInit: function( finder ) {
					finder.on( 'files:choose', function( evt ) {
						var file = evt.data.files.first();
						$element.val(file.getUrl());
					} );

					finder.on( 'file:choose:resizedImage', function( evt ) {
						$element.val(evt.data.resizedUrl);
					} );
				}
			} );
		}

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

			// $('#title').rules("add", {
			// 	required: true,
			// 	maxlength: 80,
			// 	messages: {
			// 		required: "此欄位必填",
			// 		maxlength: "最長 80 個字"
			// 	}
			// });
			//
			// $('#promoImage').rules("add", {
			// 	required: true,
			// 	messages: {
			// 		required: "此欄位必填",
			// 	}
			// });
		}
	</script>
@endsection
