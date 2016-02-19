<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link href="http://hayageek.github.io/jQuery-Upload-File/4.0.10/uploadfile.css" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="http://hayageek.com/examples/jquery/jquery-multiple-file-upload/jquery.uploadfile.js"></script>


</head>
<body>
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h1>Image Uploader</h1>
				<hr>

				<div class="form-group">
			    		<div id="extraupload">Upload</div>

				    	<div id="extrabutton" class="ajax-file-upload-green">Start Upload</div>
			    </div>
				     
				
				<script>
					var extraObj = $("#extraupload").uploadFile({
						url:"{{url('gallery/store')}}",
						fileName:"myfile[]",
						multiple:true,
						dragDrop:true,
						returnType:'json',
						//serialize:false,
						showPreview:true,
							previewHeight: "100px",
							previewWidth: "100px",

						
						extraHTML:function()
						{
						    	var html = "<div><b>File Tags:</b><input type='text' name='caption[]' value='' /> <br/>";
								html += "</div>";
								return html;    		
						},
						autoSubmit:false
						});
						$("#extrabutton").click(function()
						{
							extraObj.startUpload();
						}); 

				</script>

				<!--  Errors include-->
					@if($errors->count() > 0)
						<li class="alert alert-danger">
							@foreach($errors->all() as $error)
								{{ $error }}
							@endforeach
						</li>
					@endif
				<!-- End error -->
		

			</div><!-- end .col-md-6 -->
		</div><!-- end .row -->
	</div><!-- end .container -->

	<!-- display succes message -->
	@if(Session::has('flash_message'))
		<li id="important" class="alert alert-success">
			{{ Session::get('flash_message') }}
		</li>
		
		<script type="text/javascript">  
			$('li#important').delay(3000).slideUp(300);
		</script>

	@endif
		
</body>
</html> 