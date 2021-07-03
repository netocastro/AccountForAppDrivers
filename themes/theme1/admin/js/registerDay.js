$(document).ready(function(){

	$('#form-registerDay').on('submit',function(event) {
		event.preventDefault();
		_this = $(this);
		let dadosForm = $('#form-registerDay');

		$.ajax({
			url: $('#form-registerDay').attr('action'),
			type: $('#form-registerDay').attr('method'),
			dataType: 'JSON',
			data: $('#form-registerDay').serialize(),
			beforeSend: function() {
                        _this.find('.load').html(`<img src="cdn/assets/media/gifs/load.gif" width="80">`);
                  },
			success: function(data) {
				validateFields(data, dadosForm); 
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
