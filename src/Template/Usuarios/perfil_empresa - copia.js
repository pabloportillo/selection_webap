
;(function($, window, document, undefined) {

	$(document).ready(function() {

		var botaoAdd = $('#bota-add-nome'),

			botoesWrap = $('#UsuarioIndexForm').find('#botoes-wrap'),

			template = $.trim($('#template-inputs').html()),

			nextItem = 1;

		

		function addNewInputToTheForm() {

			var newItemHtml = template.replace(/::num/g, nextItem++)

                                              .replace(/::plus/, nextItem);



			botoesWrap.append(newItemHtml);

		}



		botaoAdd.on('click', function(e) {

			e.preventDefault();

			addNewInputToTheForm();

		});



	});

})(jQuery, window, document);