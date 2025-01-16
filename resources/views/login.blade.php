<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            background: linear-gradient(135deg, #1a1a1a, #333);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
            position: relative;
        }
        .login-container {
            background-color: #2c2c2c;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 1;
        }
        .login-container h1 {
            margin-bottom: 25px;
            font-weight: 600;
            color: #fff;
        }
        .form-control {
            background-color: #444;
            border: 1px solid #555;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #fff;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #6b46c1;
            background-color: #555;
        }
        .form-control::placeholder {
            color: #fff;
        }
        .btn-primary {
            background: linear-gradient(135deg, #5a67d8, #764ba2);
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-size: 16px;
            transition: all 0.4s ease;
            width: 100%;
            color: white;
            font-weight: 600;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #4a55a1, #5d3e91);
            transform: scale(1.05);
        }
        .login-container .form-label {
            text-align: left;
            display: block;
            font-weight: 500;
            font-size: 14px;
            color: #ccc;
        }
        .login-container a {
            color: #6b46c1;
            text-decoration: none;
            font-size: 14px;
        }
        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h1>Login</h1>
    <form action="/auth" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
        </div>
        <input type="submit" class="btn btn-primary" value="Login">
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
