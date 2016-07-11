<h2><?php echo $title?> </h2>

<?php
$allowed = FALSE;
foreach($authenticate as $type){
 if(get_cookie('type') === $type){
     $allowed = TRUE;
 }
}
if(!$allowed){
    redirect(base_url().'index.php/home');

}
?>


<?php echo validation_errors();?>
<?php echo form_open($action);?>

<?php

?>

<?php
foreach($fields as $div) {
    ?>

    <div class='form-group'>
        <label for '<?php echo $div ?>'>   <?php echo $div ?>    </label>
        <input class="form-control" type='<?php if($div === 'password'){echo $div;} else {echo 'input';} ?>' name='<?php echo $div ?>' value = "<?php if($values != NUll) echo $values[$div] ?>">
    </div>

    <?php
}
?>


<div class = 'form-group'>
    <input class="btn btn-default" type = 'submit' name = 'submit' value =' <?php echo $title ?> '>
</div>
</form>