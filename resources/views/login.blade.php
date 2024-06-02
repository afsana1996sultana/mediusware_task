<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
        .login-container input {
            width: 93%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .login-container button:hover {
            background-color: #0056b3;
        }
        .login-container .register-link {
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            display: block;
        }
        .login-container .register-link:hover {
            text-decoration: underline;
        }
        .login-container .error-message {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <div id="login-error" class="error-message" style="display:none;"></div>
        <form id="login-form">
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="/register" class="register-link" onclick="toggleForms('register')">Don't have an account? Register here</a>

    </div>

    <script>
        function toggleForms(form) {
            if (form === 'register') {
                window.location.href = '/register'; // Redirect to the registration page
            }
        }

        document.getElementById('login-form').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            fetch('/login', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    response.json().then(data => {
                        document.getElementById('login-error').innerText = data.message;
                        document.getElementById('login-error').style.display = 'block';
                    });
                } else {
                    window.location.href = '/home'; // Redirect to home page after successful login
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
