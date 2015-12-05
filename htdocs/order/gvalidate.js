var gfield = 'input[name=goatName]';
var form1 = 'form:first';
var goodgoat;

$(document).ready( function() {
    $(gfield).keyup(goatcheck);
    $(form1).submit(function(ev) {
        ev.preventDefault();
        goatcheck();
        if(goodgoat) {
            this.submit();
        }
    });
    goatcheck();
});

function goatcheck() {
    $.post('goatcheck.php', { goat: $(gfield).val() }, function(result) {
        console.log(result);
        goodgoat = (result == '1');
        $(gfield).css('background-color',
        $(gfield).val()?(goodgoat?'PaleGreen':'Pink'):'initial');
    });
}
