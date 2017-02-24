<!DOCTYPE html>
<html lang="en-us">
<head>
	<title>Laravel Datatable Page</title>

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
	<!-- Export Excel, CSV, PDF and Print Buttons -->
	<script type="text/javascript" src="/datatableasset/js/export/pdfmake-0.1.18.min.js"></script>
	<script type="text/javascript" src="/datatableasset/js/export/vfs_fonts-0.1.18.js"></script>
	<script type="text/javascript" src="/datatableasset/js/export/buttons.html5-1.2.4.min.js"></script>
	<script type="text/javascript" src="/datatableasset/js/export/jszip-2.5.0.min.js"></script>
	<script type="text/javascript" src="/datatableasset/js/export/buttons.print-1.2.4.min.js"></script>

	<style>
		table.dataTable tbody>tr.selected,
		table.dataTable tbody>tr>.selected {
			background-color: #A2D3F6;
		}

		/*::-webkit-input-placeholder {
		    color: #999!important;
		}
		:-moz-placeholder {
		    color: #999!important;
		}
		::-moz-placeholder {
		    color: #999!important;
		}
		:-ms-input-placeholder {
		    color: #999!important;
		}*/

		.help-block {
			margin: 0px;
			color: #ef5350;
		}
	</style>

	<script>
		var editor;

		$(document).ready(function() {

			var columnDefs = [{
				title: 'Id', name: 'id', className: 'hidden', searchable: false, orderable: false
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
				},
				{
					extend: 'collection',
					text: 'Export',
					buttons: [
						{
							extend: 'excel',
							text: 'Excel',
							title: 'DataTable Excel',
							exportOptions: {
								columns: ':visible',
								stripHtml: false		//don't display hidden field
							}
						},{
							extend: 'csv',
							text: 'CSV',
							title: 'DataTable CSV',
							exportOptions: {
								columns: ':visible',
								stripHtml: false
							}
						},{
							extend: 'pdf',
							text: 'PDF',
							title: 'DataTable PDF',
							message: '',
							download: 'open',
							// orientation: 'landscape',
							exportOptions: {
								columns: ':visible',
								stripHtml: false
							}
						},{
							extend: 'print',
							text: 'Print',
							title: '',
							exportOptions: {
								columns: ':visible',
								stripHtml: false
							}
						}
					]
				}
				],
				"initComplete": function(settings, json) {
					
					$('.dt-button').on('click', function(event) {

						//Set the display attribute of Id and No field in the altEditor-modal Window
						var btnName = $(this).text();

						$('#altEditor-modal #Id, #altEditor-modal #No').parent().parent().css('display', 'block');

						if (btnName == 'Add')
							$('#altEditor-modal #Id, #altEditor-modal #No').parent().parent().css('display', 'none');

						if (btnName == 'Edit')
							$('#altEditor-modal #Id').parent().parent().css('display', 'none');

						//Click Event of Add Record Button
						$('#altEditor-modal #addRowBtn').on('click', function(event) {
							event.stopPropagation();
							event.preventDefault();
							//Save row added
							addRow();
						});

						//Click Event of Save Changes Button
						$('#altEditor-modal #editRowBtn').on('click', function(event) {
							event.stopPropagation();
							event.preventDefault();
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
					name: $.trim($('#altEditor-modal #Name').val()),
					sex: $.trim($('#altEditor-modal #Sex').val()),
					age: $.trim($('#altEditor-modal #Age').val()),
					email: $.trim($('#altEditor-modal #Email').val())
				},
				success: function(result) {
					$('#altEditor-modal .help-block').remove();
					$("#altEditor-modal .modal-body .alert").remove();
					$("#altEditor-modal .modal-body").append('<div class="alert alert-success" role="alert"><strong>Success!</strong> This record has been updated.</div>');

					if (result == 'success') {
						myTable.ajax.reload();
					} else {
						alert('Save Error!');
					}
				},
				error: function(jqXhr, json, errorThrown) {
					$('#altEditor-modal .help-block').remove();
					$("#altEditor-modal .modal-body .alert").remove();
					$("#altEditor-modal .modal-body").append('<div class="alert alert-warning" role="alert"><strong>Warning!</strong> You should enter fields correctly.</div>');

					var errors = jqXhr.responseJSON;
		            $.each( errors, function( key, value ) {
		            	var inputboxId = key.toLowerCase().replace(/\b[a-z]/g, function(letter) {
						    return letter.toUpperCase();
						});

		                $("#altEditor-modal input#"+inputboxId).parent().append("<div class='help-block'>"+value[0]+"</div>");
		            });
				}
			});
		}

		//Update row edited
		function editRow() {
			var id = $('#altEditor-modal #Id').val();
			var o_no = $('#user-table tr.selected td:eq(1)').text();
			var no = $('#altEditor-modal #No').val();
			$.ajax({
				type: 'POST',
				url: '{!! url('datatable1/update') !!}' + '/' + id,
				// contentType: 'application/json',
				// dataType: 'json',
				data: {
					_token: $("[name='_token']").val(),
					o_no: o_no,
					no: no,
					name: $.trim($('#altEditor-modal #Name').val()),
					sex: $.trim($('#altEditor-modal #Sex').val()),
					age: $.trim($('#altEditor-modal #Age').val()),
					email: $.trim($('#altEditor-modal #Email').val())
				},
				success: function(result) {
					$('#altEditor-modal .help-block').remove();
					$("#altEditor-modal .modal-body .alert").remove();
					$("#altEditor-modal .modal-body").append('<div class="alert alert-success" role="alert"><strong>Success!</strong> This record has been updated.</div>');

					if (result == 'success') {
						myTable.ajax.reload();
					} else {
						alert('Update Error!');
					}
				},
				error: function(jqXhr, json, errorThrown) {
					$('#altEditor-modal .help-block').remove();
					$("#altEditor-modal .modal-body .alert").remove();
					$("#altEditor-modal .modal-body").append('<div class="alert alert-warning" role="alert"><strong>Warning!</strong> You should enter fields correctly.</div>');

					var errors = jqXhr.responseJSON;
		            $.each( errors, function( key, value ) {
		            	var inputboxId = key.toLowerCase().replace(/\b[a-z]/g, function(letter) {
						    return letter.toUpperCase();
						});

		                $("#altEditor-modal input#"+inputboxId).parent().append("<div class='help-block'>"+value[0]+"</div>");
		            });
				}
			});
		}

		//Delete row selected
		function deleteRow() {

			var id = $('#altEditor-modal #Id').val();
			$.ajax({
				type: 'POST',
				url: '{!! url('datatable1/destroy') !!}' + '/' + id,
				data: {
					_token: $("[name='_token']").val(),
				},
				success: function(result) {

					if (result == 'success') {
						myTable.ajax.reload();
					} else {
						alert('Delete Error!');
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
		<table cellpadding="0" cellspacing="0" border="0" class="dataTable table table-striped" id="user-table"></table>
		<br>
	</div>
</body>
</html>