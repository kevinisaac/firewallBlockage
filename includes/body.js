$(function(){
    
    //setting the global variables
    mandatoryFieldNames = ["registernumber","siteblocked"];
    
    //on clicking the submit button
    $("#submit-form").click(function() {
        $("#load-image").show();
        width  = $("#left-div").css("width");
        height = $("#left-div").css("height");
        text = "Thanks for your feedback! We will shortly process it.";

        //checking if mandatory fields are filled
        if(checkMandatoryFields()){
            //calling the ajax request function
            sendAjaxRequest();
        }

    });

    //check if the mandatory fields are all filled
    function checkMandatoryFields(){
        var callAjaxFunction = true;
        for(var i=0; i<mandatoryFieldNames.length; i++){
            $('input[name='+mandatoryFieldNames[i]+']').css('border', '1px solid');
            if(!$('input[name='+mandatoryFieldNames[i]+']').val()){
                $('input[name='+mandatoryFieldNames[i]+']').css('border-color','red');
                callAjaxFunction = false;
                $("#load-image").hide();
            }
        }
        return callAjaxFunction;
    }
    
    //sending the ajax request to the server
    function sendAjaxRequest(){
        $.ajax({
            url: '/formsubmit.php',
            method: 'GET',
            data: $('#feedback-form').serialize()
        }).done(function(response){
            $("#load-image").hide();
            //print welcome message
            $("#left-div").width(width).height(height);
            $("#left-div-inner").fadeOut(200, function(){
                $("#left-div").animate({height:100, marginTop: 100}, 500, function(){
                    $(this).html(text)
                           .css('line-height', '100px')
                           .css('text-align', 'center');
                });
            });
        }).fail(function(){
            $("#load-image").hide();
            alert("Failure");
        });
    }

});
