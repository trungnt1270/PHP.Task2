<html>
<head>
    <title>Personalized Greeting Form</title>
</head>

<body>
<?php
$authorId = 0;
$name = "";

if (!empty($_POST['authorid'])){
    $authorId = $_POST['authorid'];
}

if (!empty($_POST['name'])){
    $name = $_POST['name'];
}


?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    Author id : <input type="text" name="authorid"/>
    Name : <input type="text" name="name"/>
    <input type="submit" value="Add Author"/>
</form>

<?php
$tDB = new mysqli('localhost','root','','testphp');
if ($tDB->connect_error){
    die('Connect Error (' . $tDB->connect_errno . ')' . $tDB->connect_error);
}

if ($authorId != '' && $name !=''){
    $insert = "INSERT INTO authors(authorid, name) VALUES
        ($authorId, '$name')";
    echo $insert;
    $tDB->query($insert);
    echo "New record created successfully";
}

if ($name !=''){
    $sql = "SELECT * FROM authors 
            WHERE name LIKE '%{$name}'
            ORDER BY authorid";
}else{
    $sql = "SELECT * FROM authors ORDER BY authorid";
}
$result = $tDB->query($sql);

?>

<table cellspacing="2" cellpadding="6" align="center" border="1">

    <tr>
        <td colspan="4">
            <h3 align="center">These Authors are currently available</h3>
        </td>
    </tr>

    <tr>
        <td align="center">Authorid</td>
        <td align="center">Name</td>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>";
        echo $row['authorid'];
        echo"</td><td align='center'>";
        echo $row['name'];
        echo "</td>";
//        echo $row['ISBN'];
//        echo "</td>";
//        echo "<td>";
//        echo '<input type="submit" value="Delete"/>';
//        echo "</td>";
        echo "</tr>";
    }
    ?>

</table>
</body>
</html>


