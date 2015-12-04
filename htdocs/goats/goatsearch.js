var sb = '#searchbar';
var res = '#results';

$(document).ready( function() {
	$(sb).keyup(function() {
        $(res).load('goatsearch.php?q='+encodeURIComponent($(sb).val()));
    });
});
