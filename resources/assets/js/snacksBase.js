/**
 * Error handler - loads error messages into the Error Modal at the bottom of the page
 */
var msgBox = $('#errorModal');
var msgPane = $('#errorMsg');

function buildErrorMsg(msg){
    var message = msg.message;
    var errors = msg.errors;
    
    var title = '<h2><span class="text-danger">' + message + '</span></h2><br />';
    var errorList = '<span class="text-danger">';
    $.each(errors, function(idx, elem){
        errorList += elem + '<br />';
    });
    errorList += '</span>';
    var fullMsg = title + errorList;
    return fullMsg;
}


function showErrors(msg){
    var errMsg = buildErrorMsg(msg);
    $(msgPane).html(errMsg);
    $(msgBox).modal('show');
}