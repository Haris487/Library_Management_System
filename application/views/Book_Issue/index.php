<h1><?= $title?></h1>


<div class="btn-group btn-group-lg">

    <a class="btn btn-primary" href = '<?=base_url() ?>index.php/Book_Issue/issue' >Book Issue</a>

</div>
<div class="btn-group btn-group-lg">

    <a class="btn btn-primary" href = '<?php echo base_url()  ?>index.php/Books_Issue/return' >Book Return</a>

</div>



<table class ='table'>
    <thead>
    <tr>
        <th>Student Name</th>
        <th>Student ID</th>
        <th>Book Name</th>
        <th>Book ID</th>
        <th>Issue Date</th>
        <th>Return Date</th>
    </tr>

    </thead>
    <tbody>

 <?php

    foreach($records as $record){
        ?>
        <tr>
            <td> <?=$record['student_name'] ?> </td>
            <td> <?=$record['student_id'] ?> </td>
            <td> <?=$record['name'] ?> </td>
            <td> <?=$record['book_id'] ?> </td>
            <td> <?=$record['issue_date'] ?> </td>
            <td> <?=$record['return_date'] ?> </td>
            <td><a href="Book_issue/delete/<?=$record['BI_id']?>">D</a></td>
            <?php if($title === 'Book_Issue'){ ?>
            <td><div class="btn-group btn-group-sm">


                    <a class="btn btn-primary" href = '<?=base_url() ?>index.php/Book_issue/book_return/<?=$record['BI_id']?>' >Book Return</a>

                </div></td>
            <?php } ?>
        </tr>
        <?php
    }
 ?>



    </tbody>

</table>