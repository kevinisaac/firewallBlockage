<?php
    include_once $_SERVER["DOCUMENT_ROOT"].'/includes/categories.php';
?>

<head>
    <link rel="stylesheet" href="/includes/body.css">
    <script src="/includes/body.js"></script>
</head>



                    
<div id="left-div">
    <div id="left-div-inner">
        <form id="feedback-form">
        <h1>Feedback</h1>

        <div class="text-input">
            <label for="registernumber"><span class="asterisk">*</span> Register number</label><br/>
            &nbsp;<input type="text" name="registernumber" id="registernumber">
        </div><br/>

        <div class="text-input">
            <label for="siteblocked"><span class="asterisk">*</span> Site blocked</label><br/>
            &nbsp;<input type="text" name="siteblocked" id="siteblocked">
        </div><br/>

        <div class="dropdown-input">
            <label for="reasonspecified"><span class="asterisk">*</span> Reason specified</label><br/>
            &nbsp;<select name="reasonspecified" id="reasonspecified">
                <?php
                    foreach($categories as $category){
                        echo "<option value=".strtolower(str_replace(' ' , '', $category)).">$category</option>";
                    }
                ?>

            </select>
        </div><br/>

        <div class="dropdown-input" id="reason-suggested">
            <label for="reasonsuggested"><span class="asterisk">*</span> Reason suggested</label><br/>
            &nbsp;<select name="reasonsuggested" id="reasonsuggested">
                <?php
                    foreach($categories as $category){
                        echo "<option value=".strtolower(str_replace(' ' , '', $category)).">$category</option>";
                    }
                ?>
            </select>
        </div><br/>

        <div class="comment-input">
            <label for="comment">Comment</label><br/>
            &nbsp;<textarea name="comment" id="comment"></textarea>
        </div><br/>

        <div>
            &nbsp;<input type="button" id="submit-form" name="submit" value="Submit">
            <span id="load-image" style="display:none"><img src="/images/ajax-loader.gif"/></span>
        </div><br/>

        </form>
    </div>
</div>