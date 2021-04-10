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
				//console.log(data);
				validateFields(data, dadosForm); 
			},
			error: function(error) {
				console.log(error);
				console.log(error.responseText);
			}
		});
	});

	function validateFields(data, dadosForm) {

		let arrayForm = dadosForm.serializeArray();	

		$(`#button`).remove();

		arrayForm.forEach(element => {
			$(`input[name=${element.name}]`).removeClass('is-invalid');
			$('#'+ element.name).remove();
		});

		if(data.findEmptyFields){
			
			data.findEmptyFields.forEach(element => {	
				$(`input[name=${element}]`).addClass('is-invalid');
				$(`input[name=${element}]`).after(`<div id='${element}' class='text-danger text-center'>Campo vazio</div>`);
				$(`#${element}`).hide().fadeIn();
			});
		}

		if(data == `Date: SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '${arrayForm[0].value}-1' for key 'PRIMARY'`){

			$(`input[name=date]`).addClass('is-invalid');
			$(`input[name=date]`).after(`<div id='date' class='text-danger'>Data já registrada</div>`);
		}

		if(data == `UserDate have register for this day`){

			$(`input[name=date]`).addClass('is-invalid');
			$(`input[name=date]`).after(`<div id='date' class='text-danger'>Data já registrada</div>`);
		}

		if(data == 'success'){
			$(`.btn-primary`).after(`<div id='button' class='bg-success text-center rounded p-2 mt-3 mb-5'>Salvo!</div>`).fadeIn();
			$(`input`).val('');
		}
	}
});