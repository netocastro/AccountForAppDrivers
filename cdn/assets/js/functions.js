function validateFields(data, dadosForm){

      $(dadosForm.find('input, select, textarea')).each(function(index) {
            $(`${$(this).prop('tagName')}[name=${$(this).attr('name')}]`).removeClass('is-invalid');
            $(`#error-${$(this).attr('name')}`).fadeOut().remove();
      });
      $('#success').fadeOut().remove();

      if(data.emptyFields){
            data.emptyFields.forEach(element => {	
                  $(`[name=${element}]`).addClass('is-invalid');
                  $(`[name=${element}]`).after(`<div id='error-${element}' class='text-danger'>Campo vazio</div>`);
                  $(`#error-${element}`).hide().fadeIn();
            });
      }

      if(data.validateFields){
            let fields = data.validateFields;
            for (const field in fields) {
                  $(`[name=${field}]`).addClass('is-invalid');
                  $(`[name=${field}]`).after(`<div id='error-${field}' class='text-danger'>${fields[field]}</div>`)
            }
      }

      if(data.success){
            $('button[type=submit]').after(`<h6 id="success" class="bg-success text-light p-2 mt-3 rounded text-center">${data.success}</h6>`).hide().fadeIn();
            $('.form-control').val('');
      }
}

function show_image(input) {
      if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                  $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
      }
}
