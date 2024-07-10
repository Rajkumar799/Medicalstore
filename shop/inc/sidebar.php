<!DOCTYPE html>
<html>
<head>
    <?php require "inc/head.php"; ?>
    <title>Dashboard</title>
    <!-- Add FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<!-- Sidebar Toggle Button -->
<div class="sidebar-toggle">
    <a href="#" class="sidebar-link waves-effect waves-dark sidebar-link" id="sidebarToggle">
        <i class="fas fa-bars"></i>
        <span class="hide-menu">Toggle Sidebar</span>
    </a>
</div>

<!-- Left Sidebar -->
<aside class="left-sidebar" data-sidebarbg="skin5" style="background:#1f262d!important">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php">
                        <i class="fa-solid fa-gauge fa-shake"></i><span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php">
                        <i class="fa-regular fa-user"></i><span class="hide-menu">Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="add_product.php">
                        <i class="fa-solid fa-cart-plus"></i><span class="hide-menu">Add Products</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="products.php">
                        <i class="fa-solid fa-sitemap"></i><span class="hide-menu">Products</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="disable.php">
                        <i class="fa-solid fa-sitemap"></i><span class="hide-menu">Disabled Products</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="del_ord.php">
                        <i class="fa-solid fa-truck-ramp-box"></i><span class="hide-menu">Delivered Orders</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pen_ord.php">
                        <i class="fa-solid fa-truck"></i><span class="hide-menu">Pending Orders</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="reviews.php">
                        <i class="fa-solid fa-flag-checkered"></i><span class="hide-menu">Reviews</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pay.php">
                        <i class="fa-solid fa-money-check-dollar"></i><span class="hide-menu">Payments</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="out.php">
                        <i class="fa-solid fa-right-from-bracket"></i><span class="hide-menu">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<!-- Your main content -->
<main>
    <!-- Content goes here -->
</main>

<!-- JavaScript to toggle sidebar -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Toggle sidebar function
        document.getElementById('sidebarToggle').addEventListener('click', function (event) {
            event.preventDefault();
            document.querySelector('aside.left-sidebar').classList.toggle('open');
        });
    });
</script>

<style>
    /* Style for the collapsible sidebar */
    .left-sidebar {
        position: fixed;
        top: 0;
        left: -260px; /* Hide the sidebar to the left */
        width: 260px;
        height: 100%;
        background-color: #1f262d;
        overflow-y: auto;
        transition: left 0.3s ease;
        z-index: 1000; /* Ensure it's above other content */
    }

    .left-sidebar.open {
        left: 0; /* Slide in from the left */
    }

    .scroll-sidebar {
        height: 100%; /* Full height of sidebar */
        overflow-y: auto;
        padding-top: 60px; /* Space for the toggle button */
    }

    .sidebar-toggle {
        position: fixed;
        top: 10px;
        left: 10px;
        z-index: 1001; /* Ensure the button is above the sidebar */
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        color: #bfc9d4;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .sidebar-link:hover {
        background-color: #2b3945;
    }

    .sidebar-link i {
        margin-right: 10px;
    }

    .hide-menu {
        margin-left: 10px;
    }

    main {
        margin-left: 260px; /* Adjust content area when sidebar is open */
        transition: margin-left 0.3s ease;
    }

    main.open {
        margin-left: 0; /* Shift content back when sidebar is closed */
    }
</style>

</body>
</html>
