/**
 * Error handler - loads error messages into the Error Modal at the bottom of the page
 */
var msgBox = $('#errorModal');
var msgPane = $('#errorMsg');

window.buildErrorMsg = function(msg){
    var message = msg.message;
    var errors = msg.errors;
    
    var title = '<h2><span class="text-danger">' + message + '</span></h2><br />';
    var errorList = '<span class="text-danger">';
    $.each(errors, function(idx, elem){
        errorList += elem.name + '<br />';
    });
    errorList += '</span>';
    var fullMsg = title + errorList;
    return fullMsg;
};


window.showErrors = function(msg){
    var errMsg = buildErrorMsg(msg);
    $(msgPane).html(errMsg);
    $(msgBox).modal('show');
};

//{"message":"The given data was invalid.","errors":{"name":["The name has already been taken."]}}