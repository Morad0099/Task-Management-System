<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Your Task Management System</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Add Font Awesome for the sidebar icon -->
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .wrapper {
            display: flex;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            height: 100vh;
            background: #333;
            color: #fff;
            transition: all 0.3s;
            overflow-x: hidden;
        }

        #sidebar ul li a:hover {
            background-color: #1E90FF;
            /* Hover color */
        }

        #sidebar.active {
            width: 55px;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            text-align: center;
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul p {
            padding: 10px;
            font-size: 1.1em;
            display: block;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
            color: #fff;
        }

        #sidebar ul li.active>a,
        #sidebar a[aria-expanded="true"] {
            color: #fff;
            background: #1E90FF;
            /* Example color for the active link */
        }
    </style>