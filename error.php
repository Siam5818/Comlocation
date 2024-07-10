<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-color: #050a0d;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-size: 1.5rem;
            font-weight: 400;
            color: #fff;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .error-content {
            margin-top: 20px;
        }

        h1 {
            font-size: 10rem;
            margin-bottom: 0;
            color: #d9534f;
        }

        h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #f0ad4e;
        }

        p {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        button {
            width: 200px;
            height: 50px;
            color: white;
            background-color: #5bc0de;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #31b0d5;
        }

        a {
            text-decoration: none;
            color: white;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="text-center">
        <h1>404</h1>
        <div class="error-content">
            <h2>PAGE NOT FOUND</h2>
            <p>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
            <button><a href="Page/connexion.php">Back to Login</a></button>
        </div>
    </div>
</body>

</html>
