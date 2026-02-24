<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Awesome App</title>
    <style>
        * {}

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow-x: hidden;
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

        .register-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 460px;
            /* padding: 20/px; */
        }

        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 50px;
            backdrop-filter: blur(10px);
        }

        .register-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .register-icon {
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

        .register-title {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .register-subtitle {
            font-size: 14px;
            color: #999;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-row .form-group {
            margin-bottom: 0;
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
        input[type="text"],
        input[type="tel"] {
            width: 80%;
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus,
        input[type="tel"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .password-strength {
            margin-top: 8px;
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #ff6b6b, #ffd93d, #6bcf7f);
            transition: width 0.3s ease;
        }

        .password-strength-text {
            font-size: 12px;
            margin-top: 4px;
            color: #999;
        }

        .terms-agreement {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 25px;
            font-size: 13px;
            color: #666;
            line-height: 1.5;
        }

        input[type="checkbox"] {
            cursor: pointer;
            width: 18px;
            height: 18px;
            accent-color: #667eea;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .terms-agreement a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .terms-agreement a:hover {
            text-decoration: underline;
        }

        .register-btn {
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
            margin-bottom: 20px;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
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

        .social-register {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
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

        .login-link {
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #764ba2;
        }

        .error-message {
            color: #ff6b6b;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .form-group.error input {
            border-color: #ff6b6b;
        }

        .form-group.error .error-message {
            display: block;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <div class="register-icon">✨</div>
                <h1 class="register-title">Join Us</h1>
                <p class="register-subtitle">Create your account today</p>
            </div>

            <form method="POST" action="{{ route('registeruser') }}">
                @csrf

                @if (isset($error))



                    <p class="register-subtitle" style="
                                                                                                        margin-bottom: 20px;
                                                                                        color: red;
                                                                                        background: #ffebee;
                                                                                        padding: 12px;
                                                                                        border-radius: 5px;
                                                                                        text-align: justify;
                                                                                        width: 97%;
                                                                                        border: 1px solid;">


                        {{ $error }}

                    </p>
                @endif
                <div class="form-row">

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="John" required
                            value="{{ old('first_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Doe" required
                            value="{{ old('last_name') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required
                        value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="+1 (555) 000-0000"
                        value="{{ old('phone') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required minlength="8"
                        onkeyup="checkPasswordStrength(this.value)">
                    <div class="password-strength">
                        <div class="password-strength-bar" id="strengthBar"></div>
                    </div>
                    <div class="password-strength-text" id="strengthText"></div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="••••••••" required>
                </div>

                <div class="terms-agreement">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms" style="margin-bottom: 0; font-weight: 500;">
                        I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                    </label>
                </div>

                <button type="submit" class="register-btn">Create Account</button>
            </form>

            <div class="divider"><span>OR</span></div>

            <div class="social-register">
                <button type="button" class="social-btn">🔵</button>
                <button type="button" class="social-btn">🐦</button>
                <button type="button" class="social-btn">📧</button>
            </div>

            <p class="login-link">
                Already have an account? <a href="{{ route('login') }}">Sign in</a>
            </p>
        </div>
    </div>

    <script>
        function checkPasswordStrength(password) {
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            let strength = 0;

            if (password.length >= 8) strength += 25;
            if (password.length >= 12) strength += 25;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 25;
            if (/[0-9]/.test(password)) strength += 15;
            if (/[^a-zA-Z0-9]/.test(password)) strength += 10;

            strengthBar.style.width = strength + '%';

            if (strength < 25) {
                strengthText.textContent = 'Very Weak';
                strengthText.style.color = '#ff6b6b';
            } else if (strength < 50) {
                strengthText.textContent = 'Weak';
                strengthText.style.color = '#ffa500';
            } else if (strength < 75) {
                strengthText.textContent = 'Good';
                strengthText.style.color = '#ffd93d';
            } else {
                strengthText.textContent = 'Strong';
                strengthText.style.color = '#6bcf7f';
            }
        }
    </script>
</body>

</html>