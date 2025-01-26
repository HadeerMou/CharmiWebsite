<?php
//Database connection
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "checkout_system"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables and error messages
$fullname = $email = $address = $city = $state = $zip = $cardname = $cardnumber = $expmonth = $expyear = $cvv = "";
$errors = [
    'fullname' => '',
    'email' => '',
    'address' => '',
    'city' => '',
    'state' => '',
    'zip' => '',
    'cardname' => '',
    'cardnumber' => '',
    'expmonth' => '',
    'expyear' => '',
    'cvv' => ''
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $fullname = htmlspecialchars(trim($_POST['firstname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $address = htmlspecialchars(trim($_POST['address']));
    $city = htmlspecialchars(trim($_POST['city']));
    $state = htmlspecialchars(trim($_POST['state']));
    $zip = htmlspecialchars(trim($_POST['zip']));
    $cardname = htmlspecialchars(trim($_POST['cardname']));
    $cardnumber = htmlspecialchars(trim($_POST['cardnumber']));
    $expmonth = htmlspecialchars(trim($_POST['expmonth']));
    $expyear = htmlspecialchars(trim($_POST['expyear']));
    $cvv = htmlspecialchars(trim($_POST['cvv']));

    // Validate inputs
    if (empty($fullname)) {
        $errors['fullname'] = "Full name is required.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fullname)) {
        $errors['fullname'] = "Only letters and spaces are allowed.";
    }

    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    if (empty($address)) {
        $errors['address'] = "Address is required.";
    }

    if (empty($city)) {
        $errors['city'] = "City is required.";
    }

    if (empty($state)) {
        $errors['state'] = "State is required.";
    }

    if (empty($zip)) {
        $errors['zip'] = "Zip code is required.";
    } elseif (!preg_match("/^\d{5,6}$/", $zip)) {
        $errors['zip'] = "Zip code must be 5 or 6 digits.";
    }

    if (empty($cardname)) {
        $errors['cardname'] = "Name on card is required.";
    }

    if (empty($cardnumber)) {
        $errors['cardnumber'] = "Credit card number is required.";
    } elseif (!preg_match("/^\d{16}$/", $cardnumber)) {
        $errors['cardnumber'] = "Credit card number must be 16 digits.";
    }

    if (empty($expmonth)) {
        $errors['expmonth'] = "Expiration month is required.";
    }

    if (empty($expyear)) {
        $errors['expyear'] = "Expiration year is required.";
    } elseif (!preg_match("/^\d{4}$/", $expyear)) {
        $errors['expyear'] = "Expiration year must be 4 digits.";
    }

    if (empty($cvv)) {
        $errors['cvv'] = "CVV is required.";
    } elseif (!preg_match("/^\d{3,4}$/", $cvv)) {
        $errors['cvv'] = "CVV must be 3 or 4 digits.";
    }

    // If no errors, insert into the database
    if (!array_filter($errors)) {
        $sql = "INSERT INTO checkout (fullname, email, address, city, state, zip, cardname, cardnumber, expmonth, expyear, cvv)
                VALUES ('$fullname', '$email', '$address', '$city', '$state', '$zip', '$cardname', '$cardnumber', '$expmonth', '$expyear', '$cvv')";

        if ($conn->query($sql) === TRUE) {
            echo "<h3>Checkout successful! Thank you for your purchase.</h3>";
            // Clear the form inputs
            $fullname = $email = $address = $city = $state = $zip = $cardname = $cardnumber = $expmonth = $expyear = $cvv = "";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
