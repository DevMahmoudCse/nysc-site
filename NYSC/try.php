<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="jquery.min.js"></script>
	<title>Try</title>
</head>
<body>
<form id="myForm">
	<div class="holder">
		<img src="#" id="imgPreview" alt="pic">
	</div>
	<input type="file" name="photograph" id="photo" required>
	<input type="button"  id ="formBtn" value="Upload Image">
</form>

<script type="text/javascript">
	$(document).ready(() => {
		const photoInp = $('#photo');
		let file;
		$('#formBtn').click((e) =>{
			e.preventDefault();
			if(file){
				alert("Image uploaded successfully");
			}
			else{
				alert("please select n image first");
			}
		}
	});
	photoInp.change(function(e){
		file = this.files[0];
		if(file){
			let reader = new FileReader();
			reader.onload = function(event){
				$('#imgPreview').attr("src", event.target.result);
			}
			reader.readAsDataURL(file);
		}
	})
</script>
</body>
</html>