<?php
    if(isset($_POST['username']) == true) {
        $yourname = $_POST['username'];
    } else {
        $yourname = "わからない名前です！";
    }
?>
<html>

<body>

    <?php
print $yourname . "　さん，こんにちは<br>";
?>

</body>

</html>
