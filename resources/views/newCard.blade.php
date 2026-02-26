<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Card</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        form {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
            text-align: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
            background-color: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        button {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        a {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e0e0e0;
            color: #333;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        a:hover {
            background: #d0d0d0;
            transform: translateY(-2px);
        }

        .checkbox-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-item input[type="checkbox"] {
            width: auto;
            padding: 0;
            border: none;
            cursor: pointer;
            width: 18px;
            height: 18px;
            accent-color: #667eea;
        }

        .checkbox-item label {
            margin-bottom: 0;
            text-transform: none;
            letter-spacing: normal;
            font-size: 15px;
        }

        @error('error') 
        span {
            display: block;
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
            font-weight: 500;
        }
        @enderror

        @media (max-width: 600px) {
            form {
                padding: 25px;
            }

            h1 {
                font-size: 22px;
            }

            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<form  method="POST" action="{{ route('addnewcardmange') }}">
    @csrf
    <h1>Add New Card With Details</h1>

    <div class="form-group">
        <label for="name">Card Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        @error('name') <span style="color:red;">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
        @error('description') <span style="color:red;">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label>Access Level</label>
        @php
            $selectedRoles = ['user'];
            
        @endphp
        <div class="checkbox-group">
            <div class="checkbox-item">
                <input type="checkbox" id="admin" name="AccessLevel[]" value="admin" 
                    {{ in_array('admin', $selectedRoles) ? 'checked' : '' }}>
                <label for="admin">Admin</label>
            </div>
            <div class="checkbox-item">
                <input type="checkbox" id="premium" name="AccessLevel[]" value="premium" 
                    {{ in_array('premium', $selectedRoles) ? 'checked' : '' }}>
                <label for="premium">Premium</label>
            </div>
            <div class="checkbox-item">
                <input type="checkbox" id="user" name="AccessLevel[]" value="user" 
                    {{ in_array('user', $selectedRoles) ? 'checked' : '' }}>
                <label for="user">User</label>
            </div>
        </div>
        @error('AccessLevel') <span style="color:red;">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="route">Route</label>
        <input type="text" id="route" name="route" placeholder="e.g., /dashboard" value="{{ old('route') }}">
        @error('route') <span style="color:red;">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="order">Display Order</label>
        <input type="number" id="order" name="order" value="{{ old('order', 1) }}" required>
        @error('order') <span style="color:red;">{{ $message }}</span> @enderror
    </div>

    <div class="button-group">
        <button type="submit">Create Card</button>
        <a href="{{ route('home') }}">Cancel</a>
    </div>
</form>
    
</body>
</html>