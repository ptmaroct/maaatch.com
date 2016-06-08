var sb = '#searchbar';
var res = '#results';

$(document).ready( function() {
    $(res).load('matchlist.php?q=');
	$(sb).keyup(function() {
        $(res).load('matchlist.php?q='+encodeURIComponent($(sb).val()));
    });
});
