<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKEMA - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 50%, #16213e 100%);
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(255, 120, 80, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 60, 120, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 119, 198, 0.3) 0%, transparent 50%);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .container {
            background: rgba(30, 30, 30, 0.85);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(0, 162, 255, 0.8);
            border-radius: 20px;
            padding: 60px;
            width: 900px;
            height: 500px;
            display: flex;
            position: relative;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
        }

        .container::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #00a2ff, #0078d4, #005a9e);
            border-radius: 20px;
            z-index: -1;
            opacity: 0.7;
        }

        .left-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-right: 40px;
        }

        .logo {
            font-size: 48px;
            font-weight: 700;
            color: white;
            margin-bottom: 60px;
            letter-spacing: 8px;
        }

        .logo .m {
            color: #ff6b6b;
        }

        .welcome-text {
            font-size: 48px;
            font-weight: 600;
            color: white;
            line-height: 1.2;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 48px;
            font-weight: 600;
            color: white;
            line-height: 1.2;
        }

        .right-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-left: 40px;
        }

        .form-title {
            font-size: 36px;
            font-weight: 600;
            color: white;
            margin-bottom: 40px;
            text-align: right;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: white;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 15px 0;
            background: transparent;
            border: none;
            border-bottom: 2px solid rgba(255, 255, 255, 0.6);
            color: white;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            border-bottom-color: #00a2ff;
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            accent-color: #ff6b6b;
        }

        .checkbox-group label {
            color: white;
            font-size: 14px;
            margin-bottom: 0;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #ff6b6b, #ff5252);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 18px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.6);
        }

        .error-message {
            color: #ff6b6b;
            font-size: 14px;
            margin-top: 10px;
            text-align: center;
        }

        .success-message {
            color: #4caf50;
            font-size: 14px;
            margin-top: 10px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 90%;
                height: auto;
                padding: 40px;
            }
            
            .left-section, .right-section {
                padding: 0;
            }
            
            .left-section {
                text-align: center;
                margin-bottom: 30px;
            }
            
            .logo {
                font-size: 36px;
                margin-bottom: 20px;
            }
            
            .welcome-text, .subtitle {
                font-size: 28px;
            }
            
            .form-title {
                text-align: center;
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
 

    <div class="container">
        <div class="left-section">
            <div class="logo">
                SKE<span class="m">M</span>A
            </div>
            <div class="welcome-text">Welcome !</div>
            <div class="subtitle">To Our Website</div>
        </div>
        
        <div class="right-section">
            <h2 class="form-title">Sign Up</h2>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="checkbox-group">
                    <input type="checkbox" id="remember_me" name="remember_me">
                    <label for="remember_me">Remember Me</label>
                </div>
                
                <button type="submit" class="login-btn">Log In</button>
                
            </form>
        </div>
    </div>


</body>
</html>