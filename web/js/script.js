
window.onload = onLoad;


function onLoad() {

	function butClicked(but) {
		$(but).attr('disabled', true);
		$(but).addClass('load disabled');
	}

	$('.but:not([type="submit"])').click((event) => butClicked(event.target));

	$('form').submit((event) => {
		let form = event.target;
		if ($(form)[0].checkValidity()) {
			butClicked($(form).find('.but[type="submit"]'));
		}
	});
}