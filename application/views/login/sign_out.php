<?php

    if($_COOKIE['type'] === 'no_type'){
        echo 'Cookies are un setted';
        echo '<script>window.location("/lms");</script>';
    }
    else
    {
        echo "Error Sign_out";
    }
?>