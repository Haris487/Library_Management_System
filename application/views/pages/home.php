<h1><?=$title?></h1>

<p>
    Assalam O Alikum<br>
    Library Management System (TEST VERSION)<br>

    For testing purpose I mention some usernames and passwords all have Different Rights and Access to the system.<br>
   1) Admin access every thing can see , create , modify and delete every record except view password of users<br>
    2)Hr can Only Access Staff Entity <br>
    3)Librarian can access Student, Book_Issue , Book_return Entities<br>
    4) Student can only view student names not modify them<br>

</p>

<h2> Registered Username and Password</h2>
<table class = 'table'>
<thead>
<tr>
    <th>Username</th>
    <th>Password</th>
</tr>
</thead>
    <tbody>
        <tr>
            <td>admin</td>
            <td>admin</td>
        </tr>
        <tr>
            <td>librarian</td>
            <td>librarian</td>
        </tr>
        <tr>
            <td>staff</td>
            <td>staff</td>
        </tr>
        <tr>
            <td>student</td>
            <td>student</td>
        </tr>
    </tbody>
</table>

<?= $date?>