$(document).ready(function(){ 
$('#email_form').submit(function() { 
    $.ajax({ 
        data: $(this).serialize(), 
        type: $(this).attr('method'), 
        url: $(this).attr('action'), 
        success: function(response) { 
            $('#contact').html(response); 
        }
    });
    return false; 
});

});
