<!DOCTYPE html>
<html>
<head>
	<title>Generate PDF in Laravel</title>
	<link rel="stylesheet" type="text/css" href="/datatableasset/css/bootstrap-3.3.6.min.css">
</head>
<body>
	<div class="container">
		<br>
		<div class="panel panel-info">
			<div class="panel-heading">Generate PDF in Laravel</div>
			<div class="panel-body">
				<a href="#"><button class="btn btn-info btn-sm pull-right">Download PDF</button></a>
				<table class="table">
					<tr class="success">
						<th>No</th>
						<th>Name</th>
						<th>Sex</th>
						<th>Age</th>
						<th>Email</th>
					</tr>
					@foreach ( $data as $key => $value )
					<tr>
						<td>{{ $value->disporder }}</td>
						<td>{{ $value->name }}</td>
						<td>{{ $value->sex }}</td>
						<td>{{ $value->age }}</td>
						<td>{{ $value->email }}</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</body>
</html>