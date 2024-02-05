<?php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include_once('conexao.php');

    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];

          // Prepare and execute the SQL statement to insert the reservation data into the database
        $stmt = $conn->prepare("INSERT INTO reservations (name, email, date, time) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $date, $time);
        $stmt->execute();

        // Close the statement and connection
        $stmt->close();
        $conn->close();

        // Redirect to a success page
        header('Location: success.php');
        exit;
    }

    // If the form is not submitted, redirect to the reservation page
    header('Location: ../templates/reserva.php');
    exit;
    ?>
