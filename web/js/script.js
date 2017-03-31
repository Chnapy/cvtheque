
window.onload = onLoad;


function onLoad() {

	function butClicked(but) {
		$(but).attr('disabled', true);
		$(but).addClass('load disabled');
	}

	$('.but:not([type="submit"])').click(e => butClicked(e.target));

	$('form').submit(e => {
		let form = e.target;
		if ($(form)[0].checkValidity()) {
			butClicked($(form).find('.but[type="submit"]'));
		}
	});
	
	$('#ip_hobbys').keypress(e => {
		if(e.key !== 'Enter') {
			return;
		}
		e.preventDefault();
		
		let i = e.target;
		let val = i.value;
		if(!val || !i.checkValidity()) {
			return;
		}
		
		newHobby(val);
		e.target.value = '';
	});
	
	setHobbyDeletable('.hobbys-item');
	
}

function newHobby(value) {
	let hobby = `<span class="hobbys-item tag deletable onhover">${value}<span class="delete mini-but glyphicon glyphicon-remove"></span></span>`;
	
	$('.hobbys .hobbys-content .hobbys-add').after(hobby);
	
	setHobbyDeletable($('.hobbys .hobbys-content .hobbys-item').first());
}

function setHobbyDeletable(hobby) {
	$(hobby).find('.delete').click(e => $(e.target).parent().remove());
}