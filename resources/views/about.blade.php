<!DOCTYPE html>
<html>
<head>
	<title>insert</title>
</head>
<body>
<form action="/insert" method="POST">
{{ csrf_field() }}
	Name:<input type="txt" name="name" >
	Phone:<input type="txt" name="phone">
	<input type="submit" name="submit" value="submit">
</form>
</body>
</html>