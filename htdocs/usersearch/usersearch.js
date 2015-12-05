var sb = '#searchbar';
var res = '#results';

$(document).ready( function() {
    $(res).load('usersearch.php?q=');
	$(sb).keyup(function() {
        $(res).load('usersearch.php?q='+encodeURIComponent($(sb).val()));
    });
});
