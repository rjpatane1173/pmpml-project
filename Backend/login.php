<?php
include 'db.php'; // Only used if DB authentication is needed
session_start();

// Set JSON response header
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // === Static users array ===
    $static_users = [
        [
            'email' => 'admin@example.com',
            'password' => 'admin123', // Plaintext (just for demo)
            'id' => 0,
            'name' => 'Static Admin'
        ],
        [
            'email' => 'rj@example.com',
            'password' => 'rjpass',
            'id' => -1,
            'name' => 'Static Rj'
        ]
    ];

    // Check static users first
    foreach ($static_users as $user) {
        if ($email === $user['email'] && $password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            echo json_encode([
                'success' => true,
                'redirect' => '../backend/dashboard.php',
                'source' => 'static'
            ]);
            exit();
        }
    }

    // If not found in static users, check DB
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $name, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;

            echo json_encode([
                'success' => true,
                'redirect' => '../backend/dashboard.php',
                'source' => 'database'
            ]);
            exit();
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid credentials (DB match failed)'
            ]);
            exit();
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'User not found in static list or database'
        ]);
        exit();
    }
}

// If method is not POST
echo json_encode([
    'success' => false,
    'message' => 'Invalid request method'
]);
