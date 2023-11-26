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
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h2>Welcome</h2>
            </div>

            <ul class="list-unstyled components">
                <li class="">
                    <a href="#home">Home</a>
                </li>
                <li>
                    <a href="#tasks">Tasks</a>
                </li>
                <li>
                    <a href="#projects">Projects</a>
                </li>
                <!-- Add more menu items as needed -->
            </ul>
        </nav>

        <!-- Page Content -->
        <div class="container mt-5">
            <h2>Create a New Task</h2>
            <form>
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="pending"><----></option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="due_date">Due Date:</label>
                    <input type="date" class="form-control" id="due_date" name="due_date" required>
                </div>
                <div class="form-group">
                    <label for="rate">Rate:</label>
                    <input type="number" class="form-control" id="rate" name="rate" step="0.01" required>
                </div>
                <input type="hidden" id="user_id" name="user_id" value=""> 
                <button type="button" class="btn btn-primary"onclick="submitForm()">Submit</button>
            </form>
        </div>

        {{-- Bootstrap JS and Popper.js (for Bootstrap) --}}
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </div>
</body>

</html>
