<h1><?=$title ?></h1>

<?php
if(get_cookie('type') === 'admin' || get_cookie('type') === 'librarian') {?>

    <div class="btn-group btn-group-lg">

        <a class="btn btn-primary" href = '<?php echo base_url()  ?>index.php/Student/create' >Regester Student</a>

    </div>

<?php } ?>

<?php
$tr_class = array(
'success',
'danger',
'info'

);
?>

<table class ='table'>
    <tbody>

<?php
$i=0;
foreach($student as $columns){
    ?>  <tr class="<?php echo $tr_class[$i % 3] ?>">
        <td><?=$columns['name']?></td>
        <?php if(get_cookie('type') === 'admin' || get_cookie('type') === 'librarian'){?>
            <td><a href = "/lms/index.php/student/delete_student/<?php echo $columns['id'] ?>">D<span class="glyphicons glyphicons-remove-circle"></span></a></td>
            <td><a href = '<?=base_url(); ?>index.php/student/update/<?=$columns['id'];?>' >U</a></td>
        <?php } ?>
    </tr> <?php
    $i++;
}
?>
    </tbody>
</table>

