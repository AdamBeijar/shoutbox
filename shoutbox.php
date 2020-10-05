<?php
    include('db_connect.php');
    if(isset($_POST) && !empty($_POST)) {
        $sql = "INSERT INTO shoutbox (username, comment) 
                VALUES(:username, :comment)";
        $result = $conn->prepare($sql);
        $res = $result->execute(
            array(
                ':username' => $_POST['user'],
                ':comment' => $_POST['comment']
            )
        );
        $q_select = "SELECT * FROM shoutbox ORDER BY time DESC";
        $stmt = $conn->query($q_select);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoutbox</title>
</head>
<body>
    <form action="shoutbox.php" method="post">
        <p>
            <label for="user">First name:</label><br>
            <input type="text" id="user" name="user" placeholder="Skriv ditt namn">
        </p>
        <p>
            <label for="comment">First name:</label><br>
            <textarea name="comment" placeholder="Skriv din kommentar här" style="width: 400px; height: 200px;"></textarea>
        </p>
        <input type="submit" name="submit">
    </form>
<?php 
    echo "<ul>";
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>" . "Username: ".$row['username'] . '<br>'
        . "Time: " . $row['time'] . '<br>'
        . "Comment: " . $row['comment'] . '<br><br><br></li>';
    };
    echo "</ul>";
?>
</body>
</html>