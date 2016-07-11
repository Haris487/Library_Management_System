<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">

            </button>
            <a class="navbar-brand" href="#"><h1>BOOKS</h1></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <?php $li = array(
                    'All-Books',
                    'Science',
                    'Mathematics'


                );
                for($i  = 0 ; $i < count($li) ; $i++){
                    ?>
                    <li <?php if($title_inner === $li[$i]) echo "class = 'active'";?>>
                        <a href="<?=base_url()?>index.php/Books/<?php if($li[$i] === 'All Books') {} else echo "$li[$i]/" ?><?=$page ?>">
                            <?php echo $li[$i] ?>
                        </a>
                    </li>

                <?php } ?>
            </ul>
        </div>
    </div>
</nav>