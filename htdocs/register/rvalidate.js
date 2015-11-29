var ufield = '#inputUser';
var form1 = 'form:first';
var good;

$(document).ready( function() {
	$(ufield).keyup(usercheck);
	$(form1).submit(function(ev) {
		ev.preventDefault();
		usercheck();
		if(good) {
			this.submit();
		}
	});
});

function usercheck() {
	$.post('usercheck.php', { username: $(ufield).val() },
		function(result) {
			good = (result == '1');
			$(ufield).css('background-color',
				$(ufield).val()?(good?'PaleGreen':'Pink'):'initial');
		});
}
