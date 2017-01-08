<!DOCTYPE html>
<html lang="en-us">
<head>
	<title>Datatable Test Page</title>

	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="/datatableasset/css/bootstrap-3.3.6.min.css">
	<link rel="stylesheet" type="text/css" href="/datatableasset/css/jquery.dataTables-1.10.11.min.css">
	<link rel="stylesheet" type="text/css" href="/datatableasset/css/buttons.dataTables-1.1.2.min.css">
	<link rel="stylesheet" type="text/css" href="/datatableasset/css/select.dataTables-1.1.2.min.css">
	<link rel="stylesheet" type="text/css" href="/datatableasset/css/responsive.dataTables-2.0.2.min.css">

	<script type="text/javascript" src="/datatableasset/js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="/datatableasset/js/bootstrap-3.3.6.min.js"></script>
	<script type="text/javascript" src="/datatableasset/js/jquery.dataTables-1.10.11.min.js"></script>
	<script type="text/javascript" src="/datatableasset/js/altEditor/dataTables.altEditor.free.js"></script>
	<script type="text/javascript" src="/datatableasset/js/dataTables.buttons-1.1.2.min.js"></script>
	<script type="text/javascript" src="/datatableasset/js/dataTables.select-1.1.2.min.js"></script>
	<script type="text/javascript" src="/datatableasset/js/dataTables.responsive-2.0.2.min.js"></script>

	<style>
		table.dataTable tbody>tr.selected,
		table.dataTable tbody>tr>.selected {
			background-color: #A2D3F6;
		}
	</style>

	<script>
		var editor;

		$(document).ready(function() {

			/*var columnDefs = [{
				title: 'Id', data: 'id', name: 'id', className: 'hidden'
			},{
				title: 'No', data: 'no', name: 'no'
			}, {
				title: 'Name', data: 'name', name: 'name'
			}, {
				title: 'Sex', data: 'sex', name: 'sex'
			}, {
				title: 'Age', data: 'age', name: 'age'
			}, {
				title: 'Email', data: 'email', name: 'email'
			}];*/
			var columnDefs = [{
				title: 'Id', name: 'id', className: 'hidden'
			},{
				title: 'No', name: 'no'
			}, {
				title: 'Name', name: 'name'
			}, {
				title: 'Sex', name: 'sex'
			}, {
				title: 'Age', name: 'age'
			}, {
				title: 'Email', name: 'email'
			}];

			myTable = $('#user-table').DataTable({
				"sPaginationType": "full_numbers",
				processing: true,
				// serverSide: true,
				stateSave: true,
				"order": [[1, 'asc']],
				// data: dataSet,
				ajax: '{!! url('datatable1/get') !!}',
				columns: columnDefs,
				dom: 'Bfrtip',        // Needs button container
				select: 'single',
				responsive: true,
				altEditor: true,     // Enable altEditor
				buttons: [{
					text: 'Add',
					name: 'add'        // do not change name
				},
				{
					extend: 'selected', // Bind to Selected row
					text: 'Edit',
					name: 'edit'        // do not change name
				},
				{
					extend: 'selected', // Bind to Selected row
					text: 'Delete',
					name: 'delete'      // do not change name
				}],
				"initComplete": function(settings, json) {
					$('.dt-button').on('click', function(event) {

						//Set the display attribute of Id and No item
						var btnName = $(this).text();
						$('#altEditor-modal #Id, #altEditor-modal #No').parent().parent().css('display', 'block');
						if (btnName == 'Add')
							$('#altEditor-modal #Id, #altEditor-modal #No').parent().parent().css('display', 'none');
						if (btnName == 'Edit')
							$('#altEditor-modal #Id').parent().parent().css('display', 'none');

						//Click Event of Add Record Button
						$('#altEditor-modal #addRowBtn').on('click', function(event) {
							/*event.stopPropagation();
							event.preventDefault();*/
							//Save row added
							addRow();
						});
						//Click Event of Save Changes Button
						$('#altEditor-modal #editRowBtn').on('click', function(event) {
							//Update row edited
							editRow();
						});
						//Click Event of Delete Button
						$('#altEditor-modal #deleteRowBtn').on('click', function(event) {
							//Delete row selected
							deleteRow();
						});
					});
					
				}
			});

		});
		//Save row added
		function addRow() {

			$.ajax({
				type: 'POST',
				url: '{!! url('datatable1/store') !!}',
				data: {
					_token: $("[name='_token']").val(),
					name: $('#altEditor-modal #Name').val(),
					sex: $('#altEditor-modal #Sex').val(),
					age: $('#altEditor-modal #Age').val(),
					email: $('#altEditor-modal #Email').val()
				},
				success: function(result) {

					if (result == 'success') {
						myTable.ajax.reload();
					} else if (result == 'field empty') {
						$("#altEditor-modal div.alert").attr('class', 'alert alert-warning').text('You should enter fields correctly.');
					} else {
						alert('save error!');
					}

				} 
			});
		}
		//Update row edited
		function editRow() {

			var id = $('#altEditor-modal #Id').val();
			$.ajax({
				type: 'POST',
				url: '{!! url('datatable1/update/') !!}'+'/'+id,
				data: {
					_token: $("[name='_token']").val(),
					// id: $('#altEditor-modal #Id').val(),
					o_no: $('#user-table tr.selected td:eq(1)').text(),
					no: $('#altEditor-modal #No').val(),
					name: $('#altEditor-modal #Name').val(),
					sex: $('#altEditor-modal #Sex').val(),
					age: $('#altEditor-modal #Age').val(),
					email: $('#altEditor-modal #Email').val()
				},
				success: function(result) {

					if (result == 'success') {
						myTable.ajax.reload();
					} else if (result == 'field empty') {
						$("#altEditor-modal div.alert").attr('class', 'alert alert-warning').text('You should enter fields correctly.');
					} else {
						alert('update error!');
					}
				} 
			});
		}
		//Delete row selected
		function deleteRow() {

			var id = $('#altEditor-modal #Id').val();
			$.ajax({
				type: 'POST',
				url: '{!! url('datatable1/destroy/') !!}'+'/'+id,
				data: {
					_token: $("[name='_token']").val(),
				},
				success: function(result) {

					if (result == 'success') {
						myTable.ajax.reload();
					} else {
						alert('delete error!');
					}
				} 
			});
		}
	</script>
</head>
<body>
	{{csrf_field()}}
	<div class="container">
		<br>
		<table cellpadding="0" cellspacing="0" border="0" class="dataTable table table-striped" id="user-table">

		</table>
		<br>
	</div>


</body>
</html>