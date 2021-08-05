$(document).ready(function(){

	$('form').on('submit',function(event) {
		event.preventDefault();
		_this = $(this);
		let dadosForm = $('#form-login');

		$.ajax({
			url: $('form').attr('action'),
			type: $('form').attr('method'),
			dataType: 'JSON',
			data: $('form').serialize(),
			beforeSend: function() {
                        _this.find('.load').removeClass('d-none').addClass('d-flex');
                  },
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
		}).always( function() {
                  _this.find('.load').removeClass('d-flex').addClass('d-none');
            });
	});
});