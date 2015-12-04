var ufield = '#inputUser';
var form1 = 'form:first';
var pw1 = '#inputPassword1';
var pw2 = '#inputPassword2';
var goodun;
var goodpw;

$(document).ready( function() {
    $(ufield).keyup(usercheck);
    $(pw1+","+pw2).keyup(pwcheck);
    $(form1).submit(function(ev) {
        ev.preventDefault();
        usercheck();
        pwcheck();
        if(goodun && goodpw) {
            this.submit();
        }
    });
});

function usercheck() {
    $.post('usercheck.php', { username: $(ufield).val() }, function(result) {
        goodun = (result == '1');
        $(ufield).css('background-color',
        $(ufield).val()?(goodun?'PaleGreen':'Pink'):'initial');
    });
}

function pwcheck() {
    if($(pw1).val() && $(pw2).val()) {
        goodpw = ($(pw1).val() == $(pw2).val());
        $(pw1+","+pw2).css('background-color', goodpw?'PaleGreen':'Pink');
    } else {
        $(pw1+","+pw2).css('background-color','initial');
    }
}
