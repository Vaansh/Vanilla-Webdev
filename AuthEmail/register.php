<?php
session_start();

if (isset($_POST['next'])) {
    $error = legalForm();
    if ($error == -1) {
        echo 'All fields must be filled! <br>';
    } elseif ($error == -2) {
        echo 'The username does not follow php conventions: Make sure it does not begin with a number and only contains either letters, numbers and underscores.<br>';
    } elseif ($error == -3) {
        echo 'Not a legal password. The password must contain at least two uppercase characters, 1 lowercase character, 1 special character from !, @, #, $, %, ^, &, 1 digit and a minimum length of 8 characters.<br>';
    } else {
        $_SESSION['First'] = $_POST['First'];
        $_SESSION['Last'] = $_POST['Last'];
        $_SESSION['Email'] = $_POST['Email'];
        $_SESSION['Password'] = $_POST['Password'];
        header('Location: /process.php');
        exit();
    }
}

function legalForm()
{
    if (empty($_POST['First']) || empty($_POST['Last']) || empty($_POST['Email']) || empty($_POST['Password'])) {
        return -1;
    }

    if (legalUsername() != 0) {
        return legalUsername();
    }

    if (legalPassword() != 0) {
        return legalPassword();
    }

    return 0;
}

function legalUsername()
{
    $user = $_POST['Email'];
    $beginRegex = "/^[A-Za-z]/";
    $criteriaRegex = "/[^A-Za-z0-9_]/";

    if (!((preg_match($beginRegex, $user) || $user[0] == "_") && !preg_match($criteriaRegex, $user))) {
        return -2;
    }

    return 0;
}

function legalPassword()
{
    $pass = $_POST['Password'];
    $capRegex = "/[A-Z].*[A-Z]/";
    $lowRegex = "/[a-z]/";
    $splRegex = "/[!@#$%^&]/";
    $numRegex = "/[0-9]/";

    if (!(preg_match($capRegex, $pass) && preg_match($lowRegex, $pass) && preg_match($splRegex, $pass)
        && preg_match($numRegex, $pass) && strlen($pass) >= 8)) {
        return -3;
    }

    return 0;
}

$first = $_POST['First'];
$last = $_POST['Last'];
$username = $_POST['Email'];
$password = $_POST['Password'];

$_SESSION['First'] = $_POST['First'];
$_SESSION['Last'] = $_POST['Last'];
$_SESSION['Email'] = $_POST['Email'];
$_SESSION['Password'] = $_POST['Password'];

if (isset($_POST['checkid'])) {
    if (file_exists("users.txt")) {
        $username = $_POST['Email'];
        $filename = file("users.txt");
        if (validUserID($filename, $username)) {
            $firsterr = $_SESSION['First'];
            $lasterr = $_SESSION['Last'];
            $emailerr = $_SESSION['Email'];
            $pwderr = $_SESSION['Password'];
            echo 'This userID is available';
        } else {
            $firsterr = $_SESSION['First'];
            $lasterr = $_SESSION['Last'];
            $auto = "autofocus";
            $pwderr = $_SESSION['Password'];
            echo 'This userID is NOT available';
        }
    } else {
        echo 'Users.txt does not exist; Create at least one account. <br>';
    }
}

function validUserID($txt, $usr)
{
    foreach ($txt as $line) {
        if (trim($line) != '') {
            if ($usr == explode(" ", $line)[0]) {
                return false;
            }
        }
    }
    return true;
}

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Q2</title>
    <style>
        body {
            font-size: medium;
        }

        #notStrong {
            color: red;
            font-weight: 700;
        }

        .legend {
            color: #0074D9;
            font-weight: 700;
        }

        .fieldset {
            color: #0074D9;
            margin: 3px;
            border: 3px solid;
            border-radius: 10;
            padding: 3px;
            font-weight: 500;
        }

        .btn {
            color: white;
            background-color: #0074D9;
            font-size: medium;
            font-weight: 500;
        }

        .Form {
            color: black;
            font-weight: 700;
        }

        .Form ::placeholder {
            color: black;
            font-size: small;
        }

        .label {
            background-color: lightblue;

        }
    </style>
</head>

<body>
    <form name="myForm" method="POST">
        <fieldset class=" fieldset">
            <legend class="legend">Create Your Google Account</legend>
            <table class="Form">
                <tr>
                    <td>First Name:</td>
                    <td>Last Name:</td>
                </tr>
                <tr>
                    <td><input value="<?php echo htmlspecialchars($firsterr); ?>" type="text" class="label" name="First" id="fn" placeholder="First Name"></td>
                    <td><input value="<?php echo htmlspecialchars($lasterr); ?>" type="text" class="label" name="Last" id="ln" placeholder="Last Name"></td>
            </table>
            <div class="Form">
                Email: &nbsp; &nbsp; &nbsp; &nbsp;
                <input value="<?php echo htmlspecialchars($emailerr); ?>" size="17" type="text" class="label" name="Email" id="em" placeholder="Username" <?php echo htmlspecialchars($auto); ?>> @gmail.com
                <br>
                Password: &nbsp;
                <input value="<?php echo htmlspecialchars($pwderr); ?>" size="17" type="text" class="label" name="Password" id="pw" placeholder="Password">
                <button type="submit" value="Validate" name="checkid" id="checkid" class="btn">Check ID</button>
                <br>
                <a href="" class="">Refresh Page</a>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <button type="submit" value="Next" name="next" id="nxt" class="btn">Next</button>
            </div>
        </fieldset>
    </form>

</body>

</html>