<html>
    <head>
     <title>Personalized Greeting Form</title>
    </head>

    <body>
        <?php
            $bookId = 0;
            $authorId = 0;
            $title = "";
            $ISBN = "";
            $pub_year = 1999;
            $avaiable = 1;

            if (!empty($_POST['bookid'])){
                $bookId = $_POST['bookid'];
            }

            if (!empty($_POST['authorid'])){
                $authorId = $_POST['authorid'];
            }

            if (!empty($_POST['title'])){
                $title = $_POST['title'];
            }

            if (!empty($_POST['ISBN'])){
                $ISBN = $_POST['ISBN'];
            }

            if (!empty($_POST['pub_year'])){
                $pub_year = $_POST['pub_year'];
            }

            if (!empty($_POST['available'])){
                $avaiable = $_POST['available'];
            }

        ?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        Book id : <input type="text" name="bookid"/>
        Author id : <input type="text" name="authorid"/>
        Title : <input type="text" name="title"/>
        ISBN : <input type="text" name="ISBN"/>
        Public Year : <input type="text" name="pub_year"/>
        Avaiable: <input type="text" name="available"/>
        <input type="submit" value="Add Book"/>
    </form>

    <?php
    $tDB = new mysqli('localhost','root','','testphp');
    if ($tDB->connect_error){
        die('Connect Error (' . $tDB->connect_errno . ')' . $tDB->connect_error);
    }

    if ($title != '' && $ISBN !=''){
        $insert = "INSERT INTO books(bookid, authorid, title, ISBN, pub_year, available) VALUES
        ($bookId, $authorId, '$title', '$ISBN', $pub_year, $avaiable)";
        echo $insert;
        $tDB->query($insert);
        echo "New record created successfully";
    }

        if ($title !=''){
            $sql = "SELECT * FROM books 
            WHERE available = 1 AND title LIKE '%{$title}'
            ORDER BY title";
        }else{
            $sql = "SELECT * FROM books 
            WHERE available = 1 ORDER BY title";
        }
        $result = $tDB->query($sql);

    ?>

        <table cellspacing="2" cellpadding="6" align="center" border="1">

            <tr>
                <td colspan="4">
                    <h3 align="center">These Books are currently available</h3>
                </td>
            </tr>

            <tr>
                <td align="center">Title</td>
                <td align="center">Year Published</td>
                <td align="center">ISBN</td>
<!--                <td align="center">Action</td>-->
            </tr>
            <?php
            while ($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>";
                echo $row['title'];
                echo"</td><td align='center'>";
                echo $row['pub_year'];
                echo "</td><td>";
                echo $row['ISBN'];
                echo "</td>";
//                echo "<td>";
//                echo '<input type="submit" value="Delete"/>';
//                echo "</td>";
                echo "</tr>";
            }
            ?>

        </table>
    </body>
</html>


