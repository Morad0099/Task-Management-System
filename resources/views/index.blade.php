<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Management System</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh; /* 100% of the viewport height */
            margin: 0;
        }

        div {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f8f8f8;
        }

        h1 {
            color: #333;
        }

        button {
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4caf50; /* Green */
            color: white;
            border: none;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049; /* Darker green on hover */
        }
    </style>
</head>
<body>

    <div>
        <h1>Welcome To Task Management System</h1>
        <a href="{{route('login')}}"><button>Login</button></a> <a href="{{route('register')}}"><button>Register</button></a>
    </div>

</body>
</body>
</html>