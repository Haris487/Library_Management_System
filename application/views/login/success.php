<h1>Sucess</h1>
<script>
    <?php
        if(!($_COOKIE['type'] === NULL)){
            echo 'window.location = "/lms/index.php/home";';
        }
        else {
            echo 'window.location = "/lms/index.php/again";';
        }
    ?>

</script>