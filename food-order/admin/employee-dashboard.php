<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
        }
        .names {
            margin-bottom: 20px;
        }
        .box {
            display: inline-block;
            padding: 20px;
            border: 2px solid #000;
            border-radius: 10px;
        }
        .box a {
            display: block;
            margin: 10px auto;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            color: #000;
            border: 1px solid #000;
            border-radius: 5px;
            background-color: #f0f0f0;
            text-align: center;
        }
        .box a:hover {
            background-color: #ddd;
        }
        .text {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="names">
            <p>Employee Task</p>
        </div>
        <div class="text">
            <p></p>
        </div>
        <div class="box">
            <a href="page1.php">Food List</a>
            <a href="page2.php">Order List</a>
            <a href="login.php">Admin Login</a>
        </div>
    </div>
</body>
</html>
