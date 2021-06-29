$(document).ready(function(){

	$('#form-register').on('submit',function(event) {
		event.preventDefault();

		_this = $(this);

		let dadosForm = $('#form-register');

		$.ajax({
			url: $('#form-register').attr('action'),
			type: $('#form-register').attr('method'),
			dataType: 'JSON',
			data: $('#form-register').serialize(),
			beforeSend: function() {
                        _this.find('.load').html(`<img src="cdn/assets/media/gifs/load.gif" width="80">`);
                  },
			success: function(data) {
				console.log(data);
				validateFieldsRegister(data,dadosForm);
			},
			error: function(error) {
				console.log(error);
				console.log(error.responseText);
			}
		}).always( function() {
                  _this.find('.load').html("");
            });
	});
	
	function validateFieldsRegister(data, dadosForm) {

		let arrayForm = dadosForm.serializeArray();	

		arrayForm.forEach(element => {
			if(element.name != "apps[]"){ // dar um jeito de tirar essa condição;
				$(`input[name=${element.name}]`).removeClass('is-invalid');
				$('#'+ element.name).fadeOut().remove();
				$('#apps').fadeOut().remove();
			}
		});
		$('input[name="apps[]"]').removeClass('is-invalid');
		$('#success').fadeOut().remove();

		if(data.emptyFields){
			data.emptyFields.forEach(element => {	
				$(`input[name=${element}]`).addClass('is-invalid');
				$(`input[name=${element}]`).after(`<div id='${element}' class='text-danger'>Campo vazio</div>`);
				$(`#${element}`).hide().fadeIn();
			});
		}

		if(data.validateFields){
			let fields = data.validateFields;
			for (const field in fields) {
				$(`input[name=${field}]`).addClass('is-invalid');
				if(field == 'apps'){
					$(`input[name="${field}[]"]`).addClass('is-invalid');
					$(`.form-check`).after(`<div id='${field}' class='text-danger'>${fields[field]}</div>`)
				}else{
					$(`input[name=${field}]`).after(`<div id='${field}' class='text-danger'>${fields[field]}</div>`)
				}
			}
		}

		if(data == 'success'){
			$('button[type=submit]').after(`<h6 id="success" class="bg-success text-light p-2 mt-3 rounded text-center">Registrado com sucesso!</h6>`).hide().fadeIn();
			$('.form-control').val('');
			$('.form-check-input').prop("checked", false);
		}
	}
});		