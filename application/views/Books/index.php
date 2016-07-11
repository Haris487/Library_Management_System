<!-- Localhost:81/Books/Index.php -->

<h2><?php echo $title; ?></h2>

<div class="container-fluid">
    <div class="text-center">
        <h2>Book List</h2>
        <h4>List Of All Books</h4>
    </div>
</div>
<?php
if(get_cookie('type') === 'admin' || get_cookie('type') === 'librarian') {?>

<div class="btn-group btn-group-lg">

    <a class="btn btn-primary" href = '<?php echo base_url()  ?>index.php/Books/create' >Create New Book</a>

</div>

<?php } ?>

<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Book Name</th>
        <th>Book ID</th>
        <th>Author</th>
        <th>Price</th>
        <th>PKR /Hour</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $tr_class = array(
            'success',
            'danger',
            'info'

        );
    $i = 0;
    ?>

<?php
if($books != null)
foreach($books as $book_item){ ?>

    <tr class="<?php echo $tr_class[$i % 3] ?>">
        <td><?php echo $i ?></td>
        <td><?php echo $book_item->name ?></td>
        <td><?php echo $book_item->id ?></td>
        <td><?php echo $book_item->author ?></td>
        <td><?php echo $book_item->price ?></td>
        <td><?php echo $book_item->rent ?></td>
        <td><?php echo $book_item->amount ?></td>

        <?php if(get_cookie('type') === 'admin' || get_cookie('type') === 'librarian'){?>
        <td><a href = "/lms/index.php/books/delete_books/<?php echo $book_item->id ?>">D<span class="glyphicons glyphicons-remove-circle"></span></a></td>
            <td><a href = '<?=base_url(); ?>index.php/books/update/<?=$book_item->id;?>' >U</a></td>
        <?php } ?>
    </tr>


    <?php $i++; ?>



<?php } ?>


</table>

<?php if(get_cookie('type') === 'admin' || get_cookie('type') === 'librarian'){?>


<?php } ?>
</tbody>
<ul class = 'pagination'>

<li><?php echo $links ?></li>


</ul>
