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
				validateFieldsLogin(data, dadosForm);
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

	function validateFieldsLogin(data, dadosForm) {

		let arrayForm = dadosForm.serializeArray();	

		arrayForm.forEach(element => {
			console.log(element.name);
			$(`input[name=${element.name}]`).removeClass('is-invalid');
			$('#'+ element.name).fadeOut().remove();
		});

		if(data.validateEmptyFields){
			data.validateEmptyFields.forEach(element => {
				$(`input[name=${element}]`).addClass('is-invalid');
				$(`input[name=${element}]`).after(`<div id='${element}' class='text-danger'>Campo vazio</div>`);
				$(`#${element}`).hide().fadeIn();
				console.log(element);
			});
		}

		if(data.userNotExist){	
			$(`input[name=password]`).addClass('is-invalid');
			$(`input[name=password]`).after(`<div id='password' class='text-danger'>informações inválidas</div>`)
		}

		if(data.validateFields){	
			$(`input[name=email]`).addClass('is-invalid');
			$(`input[name=email]`).after(`<div id='password' class='text-danger'>Formato do campo invalido Ex: teste@teste.com</div>`)
		}
	}
});