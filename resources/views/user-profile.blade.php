<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profiles</title>
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
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-title {
            color: white;
            text-align: center;
            margin-bottom: 50px;
            font-size: 36px;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .users-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
        }

        .user-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            border-left: 5px solid #667eea;
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
        }

        .user-card h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-card h1::before {
            content: '';
            width: 8px;
            height: 8px;
            background: #667eea;
            border-radius: 50%;
        }

        .info-group {
            margin-bottom: 18px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-group:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .info-label {
            color: #999;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .info-value {
            color: #333;
            font-size: 16px;
            word-break: break-word;
        }

        .role-badge {
            display: inline-block;
            padding: 6px 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .role-badge.admin {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .role-badge.premium {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .delete-profile-btn {
            margin-left: 20px;
            padding: 6px 14px;
            background: linear-gradient(135deg, #a2303c 0%, #f7002d 100%);
            color: #f4f4f4;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .users-grid {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 28px;
            }

            .user-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="page-title">User Profiles</h2>
        
        <div class="users-grid">
            @foreach($users as $user)
                <div class="user-card">
                    <h1>{{ $user->name }}</h1>
                    
                    <div class="info-group">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $user->email }}</div>
                    </div>

                    <div class="info-group">
                        <div class="info-label">Phone</div>
                        <div class="info-value">{{ $user->phone ?? 'Not provided' }}</div>
                    </div>

                    <div class="info-group">
                        <div class="info-label">Location</div>
                        <div class="info-value">{{ $user->location ?? 'Not provided' }}</div>
                    </div>

                    <div class="info-group">
                        <div class="info-label">Role</div>
                        <div class="info-value">
                            <span class="role-badge {{ strtolower($user->role) }}">
                                {{ ucfirst($user->role) }}
                            </span>
                            <form action="{{ route('user-delete') }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                            <button class="delete-profile-btn" name="delete_id" value="{{ $user->id }}">Delete Profile</button>
                            </form>

                            <form action="{{ route('user-update') }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                            <button class="update-profile-btn" name="update_id" value="{{ $user->id }}">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>