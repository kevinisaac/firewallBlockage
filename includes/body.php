<?php
    include_once $_SERVER["DOCUMENT_ROOT"].'/includes/categories.php';
?>

<head>
    <style>
        #left-div{
            width: 70%;
            float: left;
            display: inline-block;
        }
        #left-div-inner{
            width: 100%;
            float: left;
            padding: 10px;
            border: 2px solid black;
            display: inline-block;
        }
        #right-div{
            width: 30%;
            display: inline-block;
        }
        #login{
            float: right;
        }
        #login-head{
            width: 100%;
            text-align: right;
        }
        #login-body{
            width: 100%;
            float: right;
            padding: 10px;
            border: 1px solid #eeeeee;
            display: none;
        }
        #login-body-inner{
            
        }
        input[type="text"]{
            margin: 0px;
            padding: 4px;
            border: 1px solid coral;
            width: 300px;
        }
        #login input[type="text"], input[type="password"]{
            margin: 0;
            padding: 3px;
            width: 180px;
            border: 1px solid #999999;
        }
        #unblock-checkbox{
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -o-user-select: none;
            -ms-user-select: none;
        }
        textarea{
            width: 500px;
            height: 100px;
            resize: none;
        }
        input[type="button"]{
            margin: 0;
            padding: 3px;
        }
        article{
            width: 90%;
            margin: auto;
            min-height: 740px;
            position: relative;
        }
        #content-wrapper{
            width: 100%;
            height: 740px; /*t*/
            margin: auto;
            position: absolute;
        }
        #content{
            padding: 20px;
            height: 700px; /*t*/
        }
    </style>
</head>


<form id="feedback-form">
                    
    <div><div id="left-div">
        <div id="left-div-inner">
            <h1>Feedback</h1>

            <div class="text-input">
                <span class="label">Name</span></span><br/>
                &nbsp;<input type="text" name="name">
            </div><br/>

            <div class="text-input">
                <span class="label">Register number</span><br/>
                &nbsp;<input type="text" name="registernumber">
            </div><br/>

            <div class="text-input">
                <span class="asterisk">*</span> <span class="label">Email id</span><br/>
                &nbsp;<input type="text" name="email">
            </div><br/>

            <div class="text-input">
                <span class="asterisk">*</span> <span class="label">Site blocked</span><br/>
                &nbsp;<input type="text" name="siteblocked">
            </div><br/>
            
            <div class="dropdown-input">
                <span class="asterisk">*</span> <span class="label">Reason specified</span><br/>
                &nbsp;<select name="reasonspecified">
                    <?php
                        foreach($categories as $category){
                            echo "<option value=".strtolower(str_replace(' ' , '', $category)).">$category</option>";
                        }
                    ?>
                    
                </select>
            </div><br/>
            
            <div id="unblock-checkbox">
                <label for="unblockcheckbox"><span class="label">Unblock site :</span></label> <input type="checkbox" id="unblockcheckbox" name="unblockcheckbox">
            </div><br/>
            
            <div class="dropdown-input" id="reason-suggested">
                <span class="asterisk">*</span> <span class="label">Reason suggested</span><br/>
                &nbsp;<select name="reasonsuggested">
                    <?php
                        foreach($categories as $category){
                            echo "<option value=".strtolower(str_replace(' ' , '', $category)).">$category</option>";
                        }
                    ?>
                </select>
            </div><br/>

            <div class="comment-input">
                <span class="label">Comment</span><br/>
                &nbsp;<textarea name="comment"></textarea>
            </div><br/>

            <div class="submit-input">
                &nbsp;<input type="button" id="submit-form" name="submit" value="Submit">
                <span id="load-image" style="display:none"><img src="/images/ajax-loader.gif"/></span>
            </div><br/>

        </div>
        </div></div>
    
    <style>
        input[type=button], input[type=submit]{
            margin: 0;
            border: 0;
            padding: 8px;
            outline: 0;
            cursor: pointer;
        }
        .label{
            font-family: serif;
        }
        .asterisk{
            font-weight: bold;
        }
    </style>
</form>
                  
<div id="right-div">
    <div id="login">
        <div id="login-head">
            <input id="show-login" class="button-input" type="button" name="show-login" value="Admin login">
        </div>
        <div id="login-body">
                <form action="/redirects/logincheck.php" method="POST">
                    <div class="text-input">
                        Username:<br/>
                        &nbsp;<input type="text" name="username">
                    </div>
                    <div class="text-input">
                        Password:<br/>
                        &nbsp;<input type="password" name="password"><br/><br/>
                    </div>
                    <div>
                        <input type="submit" name="admin-login" value="Sign in">
                    </div>
                </form>

        </div>
    </div>
</div>

<script>
    
    $(document).ready(function(){
        $("#unblock-checkbox").change(function(){
            $("#reason-suggested").slideToggle(200);
        });
    });
            
    $("#show-login").click(function(){
        $("#login-body").slideToggle(500);
    });
    
    $(document).ready(function(){
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
    });
    
    function checkMandatoryFields(){
        var mandatoryFieldNames = ["email","siteblocked"];
        var callAjaxFunction = true;
        for(var i=0; i<mandatoryFieldNames.length; i++){
            $('input[name='+mandatoryFieldNames[i]+']').css('border', '1px solid coral');
            if(!$('input[name='+mandatoryFieldNames[i]+']').val()){
                $('input[name='+mandatoryFieldNames[i]+']').css('border-color','red');
                callAjaxFunction = false;
                $("#load-image").hide();
            }
        }
        return callAjaxFunction;
    }
    
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
                $("#left-div").animate({height:100, marginTop:100},500, function(){
                    
                    $(this).html(text);
                });
            });
        }).fail(function(){
            $("#load-image").hide();
            alert("Failure");
        });
    }
    
</script>