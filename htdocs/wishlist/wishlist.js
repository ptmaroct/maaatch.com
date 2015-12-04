var removal = new Array();

$(document).ready( function() {
    setrm();
    setundo();
});

function setrm() {
    $('.removebutton').unbind('click');
	$('.removebutton').click(function() {
        removal.push($(this).parent().parent().attr('data-goatid'));
        console.log(removal);
        
        $(this).parent().parent().addClass('danger');
        $(this).removeClass('removebutton btn-danger');
        $(this).addClass('undobutton btn-info');
        $(this).html("Undo");
        
        setundo();
    });
}

function setundo() {
    $('.undobutton').unbind('click');
    $('.undobutton').click(function() {
        removal.splice(removal.indexOf($(this).parent().parent().attr('data-goatid')), 1);
        console.log(removal);

        $(this).parent().parent().removeClass('danger');
        $(this).removeClass('undobutton btn-info');
        $(this).addClass('removebutton btn-danger');
        $(this).html('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>');
        
        setrm();
    });
}
