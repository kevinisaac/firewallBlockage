<?php
    
    $link = mysqli_connect('localhost', 'root', 'bennette', 'firewall') or header('HTTP/1.1 404 Page Not Found');
    
    $query = "UPDATE feedback SET new=0 WHERE id = ".$_GET['id'];
    mysqli_query($link, $query) or header('HTTP/1.1 404 Page Not Found');

?>
