$(document).ready(function(){

	$('#form-registerDay').on('submit',function(event) {
		event.preventDefault();

		let dadosForm = $('#form-registerDay');

		$.ajax({
			url: $('#form-registerDay').attr('action'),
			type: $('#form-registerDay').attr('method'),
			dataType: 'JSON',
			data: $('#form-registerDay').serialize(),
			success: function(data) {
				console.log(data);
				validateFields(data, dadosForm); 
			},
			error: function(error) {
				console.log(error);
				console.log(error.responseText);
			}
		});
	});
});