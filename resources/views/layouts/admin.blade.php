@extends('layouts.app')


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kanvas Admin - @yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Judson:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --admin-bg: #1a1a2e; /* Dark Blue/Purple */
            --sidebar-bg: #161625;
            --card-bg: #2a2a3e;
            --accent-start: #FFEC77;
            --accent-end: #F8B803;
            --text-light: #e0e0e0;
            --text-muted: #8a8a9e;
            --border-color: rgba(255, 255, 255, 0.1);
        }
        body {
            font-family: 'Judson', serif;
            background-color: var(--admin-bg);
            color: var(--text-light);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden; /* Prevent horizontal scroll */
        }
        #admin-sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            min-height: 100vh;
            position: fixed; /* Fixed Sidebar */
            top: 0;
            left: 0;
            bottom: 0;
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            border-right: 1px solid var(--border-color);
            z-index: 100;
        }
        #main-content {
            margin-left: 260px; /* Offset content */
            padding: 2rem;
            flex-grow: 1;
            width: calc(100% - 260px); /* Ensure content takes remaining width */
        }
        .sidebar-brand {
            color: var(--text-light);
            font-weight: bold;
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 2rem;
            text-decoration: none;
        }
        .sidebar-brand span {
             background: linear-gradient(135deg, var(--accent-start) 0%, var(--accent-end) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .sidebar-nav .nav-link {
            color: var(--text-muted);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
            transition: all 0.2s ease-in-out;
        }
        .sidebar-nav .nav-link i {
            margin-right: 0.75rem;
            width: 20px; /* Align icons */
            text-align: center;
        }
        .sidebar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--text-light);
        }
        .sidebar-nav .nav-link.active {
            background: linear-gradient(90deg, var(--accent-start) 0%, var(--accent-end) 100%);
            color: var(--sidebar-bg);
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(255, 236, 119, 0.3);
        }
        .sidebar-footer {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }
        .sidebar-footer .btn {
            width: 100%;
            text-align: left;
            color: var(--text-muted);
        }
         .sidebar-footer .btn:hover {
            color: #dc3545; /* Danger color for logout */
            background-color: rgba(220, 53, 69, 0.1);
         }

         /* Card styles */
        .admin-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            padding: 1.5rem;
        }
         .stat-card {
             text-align: center;
             padding: 1.5rem;
         }
        .stat-card h3 {
            font-size: 2.5rem;
            color: var(--accent-start);
            margin-bottom: 0.25rem;
        }
         .stat-card p {
             color: var(--text-muted);
             margin-bottom: 0;
         }
        .stat-card .icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: var(--accent-end);
        }

        /* Table Styles */
        .table-admin {
            background-color: var(--card-bg);
            color: var(--text-light);
            border: 1px solid var(--border-color);
        }
        .table-admin th, .table-admin td {
            border-color: var(--border-color);
            vertical-align: middle;
        }
        .table-admin thead th {
            border-bottom-width: 2px;
            color: var(--text-muted);
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }
        .table-admin tbody tr:hover {
             background-color: rgba(255, 255, 255, 0.03);
        }

        /* Responsive */
        @media (max-width: 768px) {
             #admin-sidebar {
                width: 100%;
                height: auto;
                position: static;
                min-height: auto;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
             }
             #main-content {
                 margin-left: 0;
                 width: 100%;
                 padding: 1rem;
             }
            body {
                flex-direction: column;
            }
            .sidebar-brand { margin-bottom: 1rem; }
            .sidebar-nav { display: flex; flex-direction: row; overflow-x: auto; padding-bottom: 0.5rem;}
            .sidebar-nav .nav-link { margin-bottom: 0; margin-right: 0.5rem; white-space: nowrap;}
            .sidebar-footer { display: none; /* Hide logout in sidebar on mobile, maybe put in header? */}
        }
    </style>
    @stack('styles')
</head>
<body>
    <div id="admin-sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            KANVAS <span>ADMIN</span>
        </a>

        <ul class="nav flex-column sidebar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.artworks.*') || request()->routeIs('admin.documentation.*') ? 'active' : '' }}" href="{{ route('admin.artworks.index') }}">
                   <i class="bi bi-palette-fill"></i> Art & Docs
                </a>
                 {{-- Can add sub-menu later if needed --}}
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}" href="{{ route('admin.events.index') }}">
                    <i class="bi bi-calendar-event-fill"></i> Events
                </a>
            </li>
            {{-- Add Content Management Link later --}}
            {{-- <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-file-text-fill"></i> Content Management
                </a>
            </li> --}}
        </ul>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn-link nav-link">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <main id="main-content">
         @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
         @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>