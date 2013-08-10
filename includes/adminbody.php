<?php require_once $_SERVER['DOCUMENT_ROOT'].'/classes/loggingmodule.php'; ?>

<div id="options">
    <div id="left">
        <a href="">All</a>
        <a href="">Unblock requests</a>
    </div>
    
    <div id="right">
        <a href="/logout.php">Logout</a>
    </div>
</div>


<table cellspacing="0">
    <th style="width: 20%">
        From
    </th>
    <th style="width: 20%">
        Blocked site
    </th>
    <th style="width: 10%">
        Unblock request
    </th>
    <th style="width: 20%">
        Suggested Reason
    </th>
    <th style="width: 20%">
        Feedback
    </th>
    <th style="width: 5%">
        
    </th>
    
    
    <?php
        $link = mysqli_connect("localhost", "root", "bennette", "firewall");
        $query = "SELECT * FROM `feedback` WHERE new=(1)";
        $result = mysqli_query($link, $query);
        
        while($row = mysqli_fetch_assoc($result)){
            echo '
            <tr id='.$row['id'].'>
                <td> '.$row['email'].' </td>
                <td> '.$row['siteblocked'].'<br/>('.$row['reasonspecified'].') </td>
                <td> ';
                    if($row['unblock'] == 1)
                        echo 'Yes';
                    else 
                        echo 'No';
                    echo ' </td>
                <td>';
                if($row['unblock'] == 0)
                    echo $row['reasonsuggested'];
                echo '</td><td> '.$row['feedback'].' </td>
                <td><img src="/images/closeiconred1.jpg" width="20"/></td>
            </tr>';
        }
    ?>
    
    
    
</table>





<head>
    <style>
        #options{
            width: 100%;
            background-color: greenyellow;
        }
        #left{
            display: inline-block;
            width: 50%;
            float: left;
            padding: 10px 0;
            background-color: greenyellow;
        }
        #right{
            display: inline-block;
            width: 50%;
            float: right;
            padding: 10px 0;
            text-align: right;
            background-color: greenyellow;
        }
        table{
            border:0;
            padding: 5px 20px;
            table-layout: fixed;
            width: calc(100% - 0px);
            width: -webkit-calc(100% - 0px);
            width: -moz-calc(100% - 0px);
            width: -o-calc(100% - 0px);
            width: -ms-calc(100% - 0px);
        }
        th{
            background-color: violet;
            overflow: hidden;
        }
        th:nth-child(odd){
            
        }
        th:nth-child(even){
            opacity: 0.9;
        }
        tr{
            overflow: hidden;
            cursor: pointer;
            background-color: #dddddd;
        }
        td{
            padding: 5px 10px;
            overflow: hidden;
            text-align: center;
            white-space: nowrap;
        }
        td:nth-last-child(2){
            text-align: left;
        }
        /*tr:nth-child(odd){
            background-color: #eeeeee;
        }
        tr:nth-child(even){
            background-color: #dddddd;
        }*/
        article{
            background-color: greenyellow;
            width: 90%;
            margin: auto;
            min-height: 740px;
        }
        #content-wrapper{
            width: 100%;
            min-height: 740px; /*t*/
            background-color: antiquewhite;
            margin: auto;
        }
        #content{
            background-color: blueviolet;
            padding: 20px;
            min-height: 700px; /*t*/
        }
    </style>
</head>

<script>
    $(document).ready(function(){
        $('td:last-child').click(function(){
            
            //first, hide the row
            $(this).closest('tr').hide(0);
            //then, send an ajax request to update the table
            sendAjaxRequest($(this).closest('tr').attr('id'));
        });
        $('tr').each(function(){
            $(this).data("expanded",false);
            
        });
        $('tr').click(function(){
            
            if(!$(this).data("expanded")){
                $(this).find('td').each(function(){
                    $(this).css('overflow','visible').css('white-space','normal')
                            .css('word-wrap','break-word').css('background-color','#eeeeee');
                });
                $(this).data("expanded", true);
            }
            else{
                $(this).find('td').each(function(){
                    $(this).css('overflow','hidden').css('white-space','nowrap')
                            .css('word-wrap','normal').css('background-color','#dddddd');
                });
                $(this).data("expanded", false);
            }
        });
    });
    
    function sendAjaxRequest(id){
        $.ajax({
            url: '/thirdman/updatenew.php?id='+id,
            method: 'GET'
        }).done(function(response){
            
        });
    }
</script>