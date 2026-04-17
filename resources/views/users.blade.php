<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Herb Atlas</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --teal: #66bfbf;
            --light-teal: #eaf6f6;
            --white: #fcfefe;
            --coral: #f76b8a;
            --dark: #2d3748;
            --gray: #6b7280;
            --shadow: 0 10px 30px rgba(102, 191, 191, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--light-teal);
            color: var(--dark);
            line-height: 1.6;
        }

        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 60px 60px;
        }

        .page-hero {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.92), rgba(234, 246, 246, 0.92));
            border: 1px solid rgba(102, 191, 191, 0.18);
            border-radius: 28px;
            padding: 30px 34px;
            box-shadow: 0 8px 25px rgba(102, 191, 191, 0.08);
            margin-bottom: 28px;
        }

        .page-kicker {
            text-transform: uppercase;
            letter-spacing: 0.18em;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--teal);
            margin-bottom: 10px;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 3vw, 3.2rem);
            color: var(--dark);
            margin-bottom: 10px;
        }

        .page-description {
            color: var(--gray);
            font-size: 1rem;
            max-width: 760px;
        }

        .users-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .user-card {
            background: white;
            border-radius: 26px;
            border: 1px solid rgba(102, 191, 191, 0.18);
            box-shadow: 0 8px 25px rgba(102, 191, 191, 0.08);
            padding: 24px 26px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            transition: all 0.3s ease;
        }

        .user-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow);
            border-color: rgba(102, 191, 191, 0.36);
        }

        .user-card-main {
            display: flex;
            align-items: center;
            gap: 18px;
            min-width: 0;
            flex: 1;
        }

        .user-avatar {
            width: 64px;
            height: 64px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--teal), #8fd3d3);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 10px 25px rgba(102, 191, 191, 0.2);
            font-size: 1.3rem;
            font-weight: 800;
            letter-spacing: 0.02em;
        }

        .user-info {
            min-width: 0;
        }

        .user-name-row {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 8px;
        }

        .user-name {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.2;
            word-break: break-word;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            white-space: nowrap;
        }

        .status-badge.is-banned {
            background: #fff1f4;
            color: var(--coral);
            border: 1px solid rgba(247, 107, 138, 0.22);
        }

        .status-badge.is-active {
            background: #eefbf8;
            color: var(--teal);
            border: 1px solid rgba(102, 191, 191, 0.22);
        }

        .user-email {
            color: var(--gray);
            font-size: 0.98rem;
            margin-bottom: 14px;
            word-break: break-word;
        }

        .user-meta {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 14px;
            background: #f9ffff;
            border: 1px solid rgba(102, 191, 191, 0.14);
            color: var(--dark);
            font-size: 0.93rem;
            font-weight: 600;
        }

        .meta-pill i {
            color: var(--teal);
        }

        .user-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex-shrink: 0;
        }

        .status-action-form {
            margin: 0;
        }

        .status-action-btn {
            border: none;
            border-radius: 16px;
            padding: 14px 20px;
            cursor: pointer;
            font-weight: 700;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            min-width: 150px;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        .status-action-btn.is-ban {
            background: linear-gradient(135deg, var(--coral), #ff8aa0);
            color: white;
        }

        .status-action-btn.is-ban:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(247, 107, 138, 0.24);
        }

        .status-action-btn.is-unban {
            background: linear-gradient(135deg, var(--teal), #8fd3d3);
            color: white;
        }

        .status-action-btn.is-unban:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(102, 191, 191, 0.24);
        }

        .empty-state {
            background: white;
            border-radius: 28px;
            padding: 60px 30px;
            text-align: center;
            border: 1px dashed rgba(102, 191, 191, 0.28);
            box-shadow: 0 8px 25px rgba(102, 191, 191, 0.08);
        }

        .empty-state i {
            font-size: 3.8rem;
            color: var(--teal);
            opacity: 0.55;
            margin-bottom: 18px;
        }

        .empty-state h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.9rem;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .empty-state p {
            color: var(--gray);
            font-size: 1.05rem;
            max-width: 580px;
            margin: 0 auto;
        }

        @media (max-width: 900px) {
            .main-content {
                padding: 24px 20px 40px;
            }

            .page-hero {
                padding: 24px 22px;
            }

            .user-card {
                padding: 20px;
                align-items: flex-start;
                flex-direction: column;
            }

            .user-card-main {
                width: 100%;
            }

            .user-actions {
                width: 100%;
                justify-content: stretch;
            }

            .status-action-form,
            .status-action-btn {
                width: 100%;
            }
        }

        @media (max-width: 600px) {
            .user-card-main {
                align-items: flex-start;
            }

            .user-avatar {
                width: 56px;
                height: 56px;
                border-radius: 18px;
            }

            .user-name {
                font-size: 1.15rem;
            }

            .user-meta {
                gap: 10px;
            }

            .meta-pill {
                width: 100%;
                justify-content: flex-start;
            }
        }
    </style>
</head>

<body>
    <x-header />

    <main class="main-content">
        <section class="page-hero">
            <div class="page-kicker">Administration</div>
            <h1 class="page-title">User Management</h1>
            <p class="page-description">
                Review registered users, track order activity, and quickly ban or unban accounts using the controls below.
            </p>
        </section>

        @if(session('success'))
            <div class="empty-state" style="padding: 20px 24px; margin-bottom: 22px; text-align: left; border-style: solid;">
                <p style="color: var(--teal); font-weight: 600; margin: 0;">
                    <i class="fas fa-check-circle" style="margin-right: 8px;"></i>{{ session('success') }}
                </p>
            </div>
        @endif

        @if(session('error'))
            <div class="empty-state" style="padding: 20px 24px; margin-bottom: 22px; text-align: left; border-style: solid;">
                <p style="color: var(--coral); font-weight: 600; margin: 0;">
                    <i class="fas fa-circle-exclamation" style="margin-right: 8px;"></i>{{ session('error') }}
                </p>
            </div>
        @endif

        <section class="users-grid">
            @forelse($users as $user)
                <article class="user-card">
                    <div class="user-card-main">
                        <div class="user-avatar" aria-hidden="true">
                            {{ strtoupper(mb_substr(trim(($user->firstName ?? '') . ' ' . ($user->lastName ?? '')), 0, 1)) }}
                        </div>

                        <div class="user-info">
                            <div class="user-name-row">
                                <h2 class="user-name">
                                    {{ trim(($user->firstName ?? '') . ' ' . ($user->lastName ?? '')) ?: 'Unnamed User' }}
                                </h2>

                                <span class="status-badge {{ $user->is_banned ? 'is-banned' : 'is-active' }}">
                                    <i class="fas {{ $user->is_banned ? 'fa-user-slash' : 'fa-user-check' }}"></i>
                                    {{ $user->is_banned ? 'Banned' : 'Active' }}
                                </span>
                            </div>

                            <div class="user-email">{{ $user->email }}</div>

                            <div class="user-meta">
                                <div class="meta-pill">
                                    <i class="fas fa-receipt"></i>
                                    <span>{{ $user->order_count ?? 0 }} {{ ($user->order_count ?? 0) === 1 ? 'order' : 'orders' }}</span>
                                </div>

                                <div class="meta-pill">
                                    <i class="fas fa-basket-shopping"></i>
                                    <span>{{ $user->total_items_bought ?? 0 }} items bought</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="user-actions">
                        <form action="{{ route('users.toggle-ban', $user->id) }}" method="POST" class="status-action-form">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="status-action-btn {{ $user->is_banned ? 'is-unban' : 'is-ban' }}">
                                <i class="fas {{ $user->is_banned ? 'fa-user-check' : 'fa-user-slash' }}"></i>
                                {{ $user->is_banned ? 'Unban User' : 'Ban User' }}
                            </button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <i class="fas fa-users"></i>
                    <h3>No users found</h3>
                    <p>Once users register in Herb Atlas, their profiles, order counts, and moderation controls will appear here.</p>
                </div>
            @endforelse
        </section>

        @if($users->hasPages())
            <div style="margin-top: 40px; display: flex; justify-content: center;">
                {{ $users->links() }}
            </div>
        @endif
    </main>
</body>

</html>