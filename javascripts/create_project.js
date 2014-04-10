
var support_count=-1;
$(document).ready(function () {
    $('#addSupportRequest').on('click', function (e) {

        support_count++;
        var form = "<div id=support_request" + support_count + ">\
<h5>New Support Request</h5>\
<p>\
<label for='supportRequestName" + support_count.toString() + "'>Support Request Name</label>\
<input type=\"text\" name='supportRequestName'" + support_count.toString() + "' placeholder='Request Name' />\
<p>\
<textarea name=\"submit\" placeholder=\"Enter a description for the Support Request\" rows=\"5\" cols=\"50\"></textarea>\
</p><p>\
<select id=\"support_request_select" + support_count + "\" name=\"support_request_select" + support_count + "\" >\
<option value=\"default\">--select--</option>\
<option value=\"help\">Help</option>\
<option value=\"food\">Food</option>\
<option value=\"money\">Money</option>\
<option value=\"other\">Other</option>\
</select></p>\
<div id=SRFields" + support_count.toString() + "></div>\
</div>";

        $(this).parent().before(form);
        addSelectListenerForSR(support_count);
        e.preventDefault();
    });
});

var addSelectListenerForSR = function(count) {
    $('#support_request_select' + count).change(function() {
        if ($(this).find(':selected').val() == 'help') {
            $("#SRFields" + count).html("\
<label for='supportRequestRole" + count.toString() + "'>Role</label>\
<input type=\"text\" name='supportRequestRole'" + count.toString() + "' placeholder='Role' />");
        } else if( $(this).find(':selected').val() == 'food' ){
            $("#SRFields" + count).html("\
<input type=\"text\" name='supportRequestItem'" + count.toString() + "' placeholder='Food Item' />\
<input type=\"text\" name='supportRequestQuantity'" + count.toString() + "' placeholder='Food Quantity' />");
        } else if( $(this).find(':selected').val() == 'money' ){
            $("#SRFields" + count).html("<input type=\"text\" name='supportRequestAmount'" + count.toString() + "' placeholder='Amount of Money' />\
<p> Is this request all or nothing, or is do you want to receive all money that is donated </p> \
<input type=\"radio\" name=\"all_or_nothing" + support_count + "\" id=\"all_or_nothing" + support_count + "\" value=\"yes\">yes</input><br>\
<input type=\"radio\" name=\"all_or_nothing" + support_count + "\" id=\"all_or_nothing" + support_count + "\" value=\"no\">no</input>");
        } else if( $(this).find(':selected').val() == 'other' ){
            $("#SRFields" + count).html("<p>Please add additional description to the support request</p>");
        }
    });
}

$(document).ready(function () {
    $('#removeSupportRequest').on('click', function (e) {
        if(support_count >= 0) {
            $("#support_request" + support_count.toString()).empty();
            $("#support_request"+support_count).remove();
            support_count--;
        }
    });
});

var link_count=-1;
$(document).ready(function () {
    $('#addPublicityLink').on('click', function (e) {

        link_count++;
        var form = "<div id=publicity_link" + link_count + ">\
<h5>New Publicity Link</h5>\
<p>\
<input type=\"text\" name='PLName'" + link_count.toString() + "' placeholder='Website Name' />\
</p>\
<p>\
<input type=\"text\" name='PLURL'" + link_count.toString() + "' placeholder='Website URL' />\
</p>\
</div>";
        $(this).parent().before(form);
        e.preventDefault();

    });
});

$(document).ready(function () {
    $('#removePublicityLink').on('click', function (e) {
        if(link_count >= 0) {
            $("#publicity_link" + link_count.toString()).empty();
            $("#publicity_link"+link_count).remove();
            link_count--;
        }
    });
});


function lengthTest(type, okay, id, max_length, index) {
    length = 0;
    if(index >= 0) {
        length = $(id + index).val().length;
    } else {
        length = $(id).val().length;
    }

    if((length > max_length) || (length <= 0)) {
        $("#output").append(type + " length cannot exceed " + length + " characters<br />");
        return false;
    } 
    return okay && true;
}

function okayToSubmit() {
    $("#output").empty();
    var okay = true;
    okay = lengthTest("Project name", okay, "#ProjectName", 120, -1);


    okay = lengthTest("Email", okay, "#email", 40, -1);

    okay = lengthTest("Project Description", okay, "#ProjectDescription", 1400, -1);



    for(var i = 0; i <= support_count; i++) {
        category = $("#support_request_select" + i).val();
        if(category == "help") {
            okay = lengthTest("Support Request Role", okay, "#supportRequestRole", 40, i);
        } else if(category == "food") {
            okay = lengthTest("Support Request Item", okay, "#supportRequestItem", 40, i);

            quantity = $("#supportRequestQuantity" + i).val();
            if(quantity.isNaN() || quantity <= 0) {
                $("#output").append("Support Request Quantity must be a number greater than 0<br />");
                okay = false;
            }
        } else if(category == "money") {
            quantity = $("#supportRequestAmount" + i).val();
            if(quantity.isNaN() || quantity <= 0) {
                $("#output").append("Support Request Amount must be a number greater than 0<br />");
                okay = false;
            }

            all_or_nothing = $("#all_or_nothing" + i).val();
            if(all_or_nothing != "yes" && all_or_nothing != "no") {
                $("#output").append("Must select all or nothing for support request<br />");
                okay = false;
            }
        } else if(category != "other") {
            $("#output").append("Must select a category for support request<br />");
            okay = false;
        }
    }

    for(var i = 0; i < link_count; i++) {
        okay = lengthTest("Publicity Link Name", okay, "#PLName", 80, i);

        okay = lengthTest("Publicity Link URL", okay, "#PLURL", 140, i);
    }

    if(okay) {
        appendToForm();
        form.submit();
        return true;
    }
    else
        return false;       
}

function appendToForm() {

    $('<input>').attr({
        type: 'hidden',
        id: 'support_count',
        name: 'support_count',
        value: support_count.toString()
    }).appendTo('form');

    $('<input>').attr({
        type: 'hidden',
        id: 'link_count',
        name: 'link_count',
        value: link_count.toString()
    }).appendTo('form');
    
    $('<input>').attr({
        type: 'hidden',
        id: 'user_email',
        name: 'user_email',
        value: link_count.toString()
    }).appendTo('form');
}