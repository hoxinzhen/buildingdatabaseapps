<!DOCTYPE html>
<html>
<head>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<title>Ho Xin Zhen - Login Page</title>
</head>
<body>
    <div class="container">
        <h1>Please Log In</h1>
        <?php
            require_once "pdo.php";
            $nein = '@';
            $passwordge = 'php123';
            $check = password_hash($passwordge, PASSWORD_DEFAULT); 
            
            if ( isset($_POST['who']) && isset($_POST['pass'])  ) {
                $e = $_POST['who'];
                $p = $_POST['pass'];
            
                if (!strpos($e, $nein)){
                    echo("<p>Email must have an at-sign (@)</p>");
                }else{

                    if ($p != $passwordge){
                        echo "<p>Incorrect password</p>\n";
                        error_log("Login fail ".$e." $check");
                    } else{
                        header("Location: autos.php?name=".urlencode($e));
                        error_log("Login success ".$e);
                    }
                }
            }
        ?>
        <form method="POST">
        <label for="emai">Email</label>
        <input type="text" name="who" id="emai"><br/>
        <label for="id_1723">Password</label>
        <input type="text" name="pass" id="id_1723"><br/>
        <input type="submit" value="Log In">
        <input type="submit" name="cancel" value="Cancel">
        </form>
        
    </div>
</body>