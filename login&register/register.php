<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKEMA - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rammetto+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="register.css">       

</head>
<body>


    <div class="container">
        <div class="left-section">
            <div class="logo">
                SKE<span class="m">MA</span>
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