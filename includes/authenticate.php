<?php
    $user_name = $_POST["username"];
    $pass_word = $_POST["password"];
    include 'connect.php';
    $valQuery = "SELECT * FROM credentials WHERE username='$user_name' AND password='$pass_word'";
    $valResult = mysqli_query($connected, $valQuery);
    $row = mysqli_fetch_array($valResult);

    if(!$row)
    {
        echo "<script>
            window.confirm('Invalid username or password!');
            document.location.href='../index.php';
            </script>";
    }
    else
    {
        $cookie_name = "username";
        $cookie_value = $user_name;
        setcookie($cookie_name, $cookie_value, time() + 60*60*24);
        header("Location: ../../codingPortal2016/problems.php");
    }
    echo $user_name;
    echo $pass_word;
?>
