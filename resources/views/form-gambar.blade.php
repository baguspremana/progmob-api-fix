<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>
	<form method="post" action="/upload/{{$ticket->id}}" enctype="multipart/form-data">
		{{ csrf_field() }}

		<input type="hidden" name="_method" value="put">
		<input type="file" name="photo">
		<textarea name="etc"></textarea>
		<input type="submit" name="upload">
	</form>
</body>
</html>