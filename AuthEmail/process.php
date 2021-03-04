<?php
session_start();
$first = $_SESSION['First'];
$email = $_SESSION['Email'];
echo "$first, welcome to Google <br>";
echo "$email@gmail.com <br>";

if (isset($_POST['next'])) {
    $_SESSION['Phone'] = $_POST['Phone'];
    $_SESSION['REmail'] = $_POST['REmail'];
    $_SESSION['Date'] = $_POST['Date'];
    $_SESSION['Gender'] = $_POST['Gender'];
    header('Location: /outcome.php');
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
    <form action="outcome.php" name="myForm" method="POST">
        <fieldset class=" fieldset">
            <legend class="legend">Google</legend>
            <div class="Form">
                <input size="25" type="text" class="label" name="Phone" id="ph" placeholder="Phone Number" required>
                <br>
                <input size="25" type="text" class="label" name="REmail" id="re" placeholder="Recovery Email Address" required>
                <br>
                <label>Date of Birth:</label>
                <br>
                <input size="25" class="label" name="Date" id="date" type="date" required>
                <br>
                <label>Gender:</label>
                <br>
                <select id="Gender">
                    <option selected value="F">Female</option>
                    <option value="M">Male</option>
                    <option value="R">Rather Not Say</option>
                </select>
                <button type="submit" value="Submit" name="Submit" id="nxt" class="btn">Submit</button>
            </div>
        </fieldset>
    </form>
</body>

</html>