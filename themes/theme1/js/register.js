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

		arrayForm.forEach(element => {
			
			$(`input[name=${element.name}]`).removeClass('is-invalid');
			$('#'+ element.name).remove();
		});

		if(data.emptyFields){
			
			data.emptyFields.forEach(element => {	
				$(`input[name=${element}]`).addClass('is-invalid');
				$(`input[name=${element}]`).after(`<div id='${element}' class='text-danger'>Campo vazio</div>`)
			});
		}

		if(data.validateFields){	
			console.log(data.validateFields);
			data.validateFields.forEach(element => {
				//console.log(element);
				//$(`input[name=${element}]`).addClass('is-invalid');
				//$(`input[name=${element}]`).after(`<div id='${element}' class='text-danger'>Campo vazio</div>`)
			});
		}
		//validateFields


	}
});