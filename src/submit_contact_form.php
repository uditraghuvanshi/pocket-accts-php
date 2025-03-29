<?php
session_start();

try {
    // Database connection
    $servername = "localhost"; // Change if needed
    $username = "root"; // Change if needed
    $password = ""; // Change if needed
    $dbname = "contact_db"; // Change if needed

    $conn = @new mysqli($servername, $username, $password, $dbname);

    // If connection fails, throw an exception
    if ($conn->connect_errno) {
        throw new Exception("Unable to submit. Please try again after a few minutes.");
    }

    // Check if required form fields are filled
    if (!empty($_POST['name']) && !empty($_POST['country_code']) && !empty($_POST['phone']) && 
        !empty($_POST['email']) && !empty($_POST['business_name'])) {

        // Sanitize user input
        $name = htmlspecialchars($_POST['name']);
        $country_code = htmlspecialchars($_POST['country_code']);
        $phone = htmlspecialchars($_POST['phone']);
        $email = htmlspecialchars($_POST['email']);
        $business_name = htmlspecialchars($_POST['business_name']);
        $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : "";

        // Insert data into MySQL database
        $stmt = $conn->prepare("INSERT INTO contact_requests (name, country_code, phone, email, business_name, description) VALUES (?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            throw new Exception("Unable to submit. Please try again after a few minutes.");
        }

        $stmt->bind_param("ssssss", $name, $country_code, $phone, $email, $business_name, $description);

        if ($stmt->execute()) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Your message has been successfully submitted!";
        } else {
            throw new Exception("Unable to submit. Please try again after a few minutes.");
        }

        $stmt->close();
    } else {
        throw new Exception("All fields are required except the description.");
    }

    $conn->close();
} catch (Exception $e) {
    $_SESSION['status'] = "error";
    $_SESSION['message'] = $e->getMessage();
}

// Redirect back to contact page
header("Location: contact-us.php");
exit();
?>
