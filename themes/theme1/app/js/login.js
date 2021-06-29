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
                        _this.find('.load').html(`<img src="cdn/assets/media/gifs/load.gif" width="80">`);
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
                  _this.find('.load').html("");
            });
	});
});