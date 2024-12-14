<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title><?= htmlspecialchars($title) ?></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            height: 100vh;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding-top: 20px;
        }

        .sidebar h5 {
            color: white;
            font-weight: bold;
        }

        .sidebar .nav-link {
            color: #e9ecef;
            font-weight: 500;
            margin: 5px 0;
            transition: all 0.3s;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #0056b3;
            color: white;
        }

        .content {
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        footer {
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }

        footer p {
            margin: 0;
            color: #6c757d;
        }

        .nav-link:hover {
            transform: scale(1.05);
        }
         .navbar-brand:hover {
        color: #ffc107; /* Gold hover effect */
        transform: scale(1.1);
    }

    /* Hover Effect for Logout Button */
    .nav-link:hover {
        background-color: #495057; /* Slightly lighter gray */
        color: #ffc107; /* Gold text */
        transform: scale(1.05);
    }

    /* Navbar Shadow Enhancement */
    .navbar {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }

    /* Smooth Transition for All */
    .navbar a {
        transition: color 0.3s ease, transform 0.3s ease, background-color 0.3s ease;
    }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <a class="navbar-brand mx-4 text-white font-weight-bold" href="#" style="font-size: 1.5rem; transition: all 0.3s;">
            Management Inventory
        </a>
        <ul class="navbar-nav flex-row">
            <li class="nav-item">
                <a class="nav-link text-white px-4 py-2 rounded" href="../auth/logout.php" 
                   style="background-color: #343a40; transition: all 0.3s; font-size: 1rem; font-weight: 500;">
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>