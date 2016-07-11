<h1><?=$title ?></h1>

<?php
if(get_cookie('type') === 'admin' || get_cookie('type') === 'hr') {?>

    <div class="btn-group btn-group-lg">

        <a class="btn btn-primary" href = '<?php echo base_url()  ?>index.php/Staff/create' >Regester Staff</a>

    </div>

<?php } ?>

<?php
    foreach($staff as $class) {
        ?><h2><?=ucfirst($class['title']) ?></h2> <?php ?>
        <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th></th>

        </tr>
        </thead>
        <tbody>

        <?php
        foreach($class['staff_record'] as $columns){
            ?>  <tr>
                <td><?=$columns['name']?></td>
                <?php if(get_cookie('type') === 'admin' || get_cookie('type') === 'hr'){?>
                    <td><a href = "/lms/index.php/staff/delete_staff/<?php echo $columns['id'] ?>">Delete<span class="glyphicons glyphicons-remove-circle"></span></a></td>
                    <td><a href = '<?=base_url(); ?>index.php/staff/update/<?=$columns['id'];?>' >Update</a></td>
                <?php } ?>
            </tr> <?php

        }

        ?> </tbody>
        </table>

        <?php

    }

?>