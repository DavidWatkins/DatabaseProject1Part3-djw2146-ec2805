var link_count=-1;
$(document).ready(function () {
    $('#addPublicityLink').on('click', function (e) {

        link_count++;
        var form = "<div id=publicity_link" + link_count + ">\
<h5>New Publicity Link</h5>\
<p>\
<input type=\"text\" name='PLName" + link_count + "' id='PLName" + link_count + "' placeholder='Website Name' />\
</p>\
<p>\
<input type=\"text\" name='PLURL" + link_count + "' id='PLName" + link_count + "'  placeholder='Website URL' />\
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

function okayToSubmit(form) {
    $("#output").empty();
    var okay = true;
    okay = lengthTest("Project name", okay, "#ProjectName", 120, -1);


    okay = lengthTest("Email", okay, "#email", 40, -1);

    okay = lengthTest("Project Description", okay, "#ProjectDescription", 1400, -1);


    var HSRDL = $("#HSRDescription").val();
    var HSRRL = $("#HSRRole").val();
    if(HSRDL === 0 ^ HSRRL === 0) {
        $("#output").append("Help Support Request must be fully filled out before submission<br />");
        okay = false;
    } else if(HSRDL > 700) {

    } else if(HSRRL > 40) {

    }

    var FSRDL = $("#FSRDescription").val();
    var FSRIL = $("#FSRItem").val();
    var FSRQ = $("FSRQuantity");
    if(!((FSRDL === 0) ^ (FSRIL === 0) ^ (FSRQ === 0))) {
    } else if(FSRDL > 700) {
    } else if(FSRIL > 40) {
    } else if(!FSRQ.isNaN() || FSRQ <= 0) {
    }


    var MSRDL = $("#MSRDescription").val();
    var MSRA = $("#MSRAmount").val();
    var MSRall_or_nothing = $("#all_or_nothing").val();
    if(!((MSRDL === 0) ^ (MSRA === 0) ^ (MSRall_or_nothing === 0))) {
    } else if(MSRDL > 700) {
    } else if(!MSRA.isNaN() || MSRA <= 0) {
    } else if(!MSRall_or_nothing.isNaN() || (MSRall_or_nothing != 3 && MSRall_or_nothing != 2)) {
    }

    var OSRDL = $("#OSRDescription").val();
    if(OSRDL > 700) {
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
        id: 'link_count',
        name: 'link_count',
        value: link_count.toString()
    }).appendTo('form');

    $('<input>').attr({
        type: 'hidden',
        id: 'user_email',
        name: 'user_email',
        value: user_email
    }).appendTo('form');
}
