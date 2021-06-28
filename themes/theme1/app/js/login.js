$(document).ready(function(){

	$('form').on('submit',function(event) {
		event.preventDefault();
		let dadosForm = $('#form-login');

		$.ajax({
			url: $('form').attr('action'),
			type: $('form').attr('method'),
			dataType: 'JSON',
			data: $('form').serialize(),
			success: function(data) {
				console.log(data);
				validateFields(data, dadosForm);
				if(data == 'redirect'){
					window.location.href = rota;
				}
			},
			error: function(error) {
				console.log(error);
				console.log(error.responseText);
			}
		});
	});
});