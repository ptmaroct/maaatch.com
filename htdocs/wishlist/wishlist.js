var removal = new Array();
var smbtn = '#submit';

$(document).ready( function() {
    setrm();
    setundo();
    $(smbtn).click(function() {
        $.post("wishlist.php", { rem: removal.join('|') });
        location.reload();
    });
});

function setrm() {
    $('.removebutton').unbind('click');
	$('.removebutton').click(function() {
        removal.push($(this).parent().parent().attr('data-goatid'));
        
        $(this).parent().parent().addClass('danger');
        $(this).removeClass('removebutton btn-danger');
        $(this).addClass('undobutton btn-info');
        $(this).html("Undo");
 
        smtoggle();       
        setundo();
    });
}

function setundo() {
    $('.undobutton').unbind('click');
    $('.undobutton').click(function() {
        removal.splice(removal.indexOf($(this).parent().parent().attr('data-goatid')), 1);

        $(this).parent().parent().removeClass('danger');
        $(this).removeClass('undobutton btn-info');
        $(this).addClass('removebutton btn-danger');
        $(this).html('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>');
        
        smtoggle();
        setrm();
    });
}

function smtoggle() {
    if(removal.length && $(smbtn).hasClass('hidden')) {
        $(smbtn).removeClass('hidden');
    } else if(!removal.length && !$(smbtn).hasClass('hidden')) {
        $(smbtn).addClass('hidden');
    }
}
