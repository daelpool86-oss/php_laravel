<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Awesome App</title>
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Sora:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="page-wrapper">
        <!-- Navigation Bar -->
        <nav class="navbar">
            <div class="nav-container">
                <div class="logo">Awesome App</div>
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-badge {{ Auth::user()->role === 'admin' ? 'admin-badge' : 'user-badge' }}">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                @if(Auth::user()->role === 'admin')
                    <h1 class="hero-title">Welcome back, <span class="gradient-text">{{ Auth::user()->name }}</span>! 👋</h1>
                    <p class="hero-subtitle">You have administrative privileges. Manage your application with ease.</p>
                    <div class="hero-actions">
                        <a href="{{ route('AddNewCard') }}" class="btn btn-primary">
                            <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Add New Card
                        </a>
                    </div>
                @else
                    <h1 class="hero-title">Welcome, <span class="gradient-text">{{ Auth::user()->name }}</span>! ✨</h1>
                    <p class="hero-subtitle">You're all set. Explore everything you have access to below.</p>
                @endif
            </div>
            <div class="hero-decoration"></div>
        </section>

        <!-- Main Content -->
        <main class="main-content">
            @php
                use App\Models\CardControl;
                $cards = CardControl::orderBy('order')->get();
                $cards = $cards->toArray();
            @endphp

            <!-- Cards Grid -->
            <section class="cards-section">
                <div class="section-header">
                    <h2 class="section-title">Your Features</h2>
                    <p class="section-subtitle">Access all your tools and features in one place</p>
                </div>

                <div class="cards-list">
                    @forelse($cards as $index => $card)
                        @php
                            $rawAccess = json_decode($card['AccessLevel']) ?? '';
                            $userRole = Auth::user()->role ?? 'guest';
                            $show = in_array($userRole, $rawAccess);
                        @endphp

                        @if($show)
                            <div class="card" style="--card-index: {{ $index }}; --card-color: {{ ['#667eea', '#764ba2', '#f093fb', '#4facfe', '#00f2fe', '#43e97b'][($index % 6)] }}">
                                <div class="card-header">
                                    <div class="card-icon">{{ substr($card['name'], 0, 1) }}</div>
                                </div>
                                <h3 class="card-title">{{ $card['name'] }}</h3>
                                <p class="card-description">{{ $card['description'] }}</p>
                                @if(!empty($card['route']))
                                    <a href="{{ $card['route'] }}" class="card-link">
                                        <span>Explore</span>
                                        <svg class="link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                @endif
                                <div class="card-gradient"></div>
                            </div>
                        @endif
                    @empty
                        <div class="empty-state">
                            <div class="empty-icon">📭</div>
                            <h3>No Features Available</h3>
                            <p>It looks like there are no features available for your account yet.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- Footer Section -->
            <footer class="app-footer">
                <p>&copy; 2026 Awesome App. All rights reserved.</p>
            </footer>
        </main>
    </div>
</body>

</html>