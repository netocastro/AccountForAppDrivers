$(document).ready(function(){

	$('#form-register').on('submit',function(event) {
		event.preventDefault();

		let dadosForm = $('#form-register');

		$.ajax({
			url: $('#form-register').attr('action'),
			type: $('#form-register').attr('method'),
			dataType: 'JSON',
			data: $('#form-register').serialize(),
			success: function(data) {
				console.log(data);
				validateFields(data,dadosForm);
			},
			error: function(error) {
				console.log(error);
				console.log(error.responseText);
			}
		});
	});
	
	function validateFields(data, dadosForm) {

		let arrayForm = dadosForm.serializeArray();
		console.log(dadosForm);	
		console.log(dadosForm.button);	
		console.log(dadosForm.clientTop);	

		arrayForm.forEach(element => {
			if(element.name != "apps[]"){ // dar um jeito de tirar esse carái;
				$(`input[name=${element.name}]`).removeClass('is-invalid');
				$('#'+ element.name).fadeOut().remove();
			}
		});
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
				console.log(fields[field]);
				$(`input[name=${field}]`).addClass('is-invalid');
				if(field == 'apps'){
					$(`.form-check"`).after(`<div id='${field}' class='text-danger'>${fields[field]}</div>`)
				}else{
					$(`input[name=${field}]`).after(`<div id='${field}' class='text-danger'>${fields[field]}</div>`)
				}
			}
		}

		if(data == 'success'){
			$('button[type=submit]').after(`<h6 id="success" class="bg-success text-light p-2 mt-3 rounded text-center">Registrado com sucesso!</h6>`).hide().fadeIn();
			$('input').val('');
		}
	}
});		