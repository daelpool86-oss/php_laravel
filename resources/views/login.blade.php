<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Awesome App</title>
    <style>
        body {
            /* margin-top: 20px; */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            /* min-height: 100vh; */
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            left: -100px;
            animation: float 6s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            bottom: -50px;
            right: -50px;
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(30px);
            }
        }

        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 9px;
            backdrop-filter: blur(10px);
        }

        .login-header {
            text-align: center;
            /* margin-bottom: 40px; */
        }

        .login-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 35px;
            color: white;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .login-title {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .login-subtitle {
            font-size: 14px;
            color: #999;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-size: 14px;
            color: #333;
            margin-bottom: 8px;
            font-weight: 600;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 90%;
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        input[type="checkbox"] {
            cursor: pointer;
            width: 18px;
            height: 18px;
            accent-color: #667eea;
        }

        .remember-me label {
            margin-bottom: 0;
            cursor: pointer;
            color: #666;
            font-weight: 500;
        }

        .forgot-password {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #764ba2;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            margin-bottom: 15px;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            color: #ccc;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e0e0e0;
        }

        .divider span {
            margin: 0 10px;
            font-size: 13px;
            color: #999;
        }

        .social-login {
            display: flex;
            gap: 12px;
            margin-bottom: 15px;
        }

        .social-btn {
            flex: 1;
            padding: 12px;
            border: 2px solid #e0e0e0;
            background: white;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .social-btn:hover {
            border-color: #667eea;
            background: #f5f5f5;
        }

        .signup-link {
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        .signup-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: #764ba2;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-icon">👤</div>
                <h1 class="login-title">Welcome Back</h1>
                <p class="login-subtitle">Sign in to your account</p>
            </div>

            <form method="POST" action="{{ route('loginuser') }}">
                @csrf
                @if (isset($error))
                    <p style="color: red; border: 1px solid #f44336; border-radius: 7px; text-align: center; margin-bottom: 15px; padding: 10px; background-color: #ffebee; width: fit-content; justify-self: center;">
                        {{ $error }}
                    </p>
                    @endif
                
              
                    @if (isset($success))
                      <p>
                    <p style="color: green; border: 1px solid #4CAF50; border-radius: 7px; text-align: center; margin-bottom: 15px; padding: 10px; background-color: #e8f5e8; width: fit-content; justify-self: center;">
                        {{ $success }}
               </p>
                    @endif
                </p>
                <div class="form-group">
                 
                    <label for="username">User Name</label>
                    <input type="text" id="username" name="username" placeholder="Ale hamada .... " required
                        value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required
                        value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>

                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
                <p class="signup-link">Don't have an account? <a href="/register">Sign Up</a></p>

                <button type="submit" class="login-btn">Sign In</button>
            </form>

            <div class="divider"><span>OR</span></div>

            <div class="social-login">
                <button class="social-btn">🔵</button>
                <button class="social-btn">🐦</button>
                <button class="social-btn">📧</button>
            </div>


        </div>
    </div>
</body>

</html>