<!DOCTYPE html>
<html>
<head>
    <?php require "inc/head.php"; ?>
    <title>Page with Top Sidebar</title>
    <!-- Add FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include the latest jQuery version -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
</head>
<body>
<aside class="top-sidebar fixed-top" data-sidebarbg="skin5">
    <div class="sidebar-toggle">
        <a href="#" class="sidebar-link waves-effect waves-dark sidebar-link" id="sidebarToggle">
            <i class="fa-solid fa-bars"></i>
            <span class="hide-menu">Toggle Sidebar</span>
        </a>
    </div>
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false">
                        <i class="fa-solid fa-gauge fa-shake"></i><span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="add_cat.php" aria-expanded="false">
                        <i class="fa-solid fa-gauge fa-shake"></i><span class="hide-menu">Edit Category</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="add_banner.php" aria-expanded="false">
                        <i class="fa-solid fa-gauge fa-shake"></i><span class="hide-menu">Edit Banner</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="products.php" aria-expanded="false">
                        <i class="fa-solid fa-sitemap"></i><span class="hide-menu">Active Products</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="disable.php" aria-expanded="false">
                        <i class="fa-solid fa-sitemap"></i><span class="hide-menu">Disabled Products</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="del_ord.php" aria-expanded="false">
                        <i class="fa-solid fa-truck-ramp-box"></i><span class="hide-menu">Delivered Orders</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pen_ord.php" aria-expanded="false">
                        <i class="fa-solid fa-truck"></i><span class="hide-menu">Pending Orders</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="coup.php" aria-expanded="false">
                        <i class="fa-solid fa-truck"></i><span class="hide-menu">Manage Coupons</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="reviews.php" aria-expanded="false">
                        <i class="fa-solid fa-flag-checkered"></i><span class="hide-menu">Reported Reviews</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="cust.php" aria-expanded="false">
                        <i class="fa-solid fa-users"></i><span class="hide-menu">Customers</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="ban_user.php" aria-expanded="false">
                        <i class="fa-solid fa-users-slash"></i><span class="hide-menu">Banned Users</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="shop.php" aria-expanded="false">
                        <i class="fa-solid fa-shop"></i><span class="hide-menu">Shops</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="ban_shop.php" aria-expanded="false">
                        <i class="fa-solid fa-shop-slash"></i><span class="hide-menu">Banned Shops</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="request.php" aria-expanded="false">
                        <i class="fa-solid fa-code-pull-request"></i><span class="hide-menu">Join Requests</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="out.php" aria-expanded="false">
                        <i class="fa-solid fa-right-from-bracket"></i><span class="hide-menu">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<!-- JavaScript to toggle sidebar -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Toggle sidebar function
        document.getElementById('sidebarToggle').addEventListener('click', function (event) {
            event.preventDefault();
            document.querySelector('aside.top-sidebar').classList.toggle('open');
        });

        // Debugging: Log any JavaScript errors to the console
        window.onerror = function(message, source, lineno, colno, error) {
            console.error("Error: " + message + " at " + source + ":" + lineno + ":" + colno);
            console.error(error);
        };
    });
</script>

<style>
    /* Style for the collapsible sidebar */
    .top-sidebar {
        position: fixed;
        top: -100%; /* Hide the sidebar above the viewport */
        left: 0;
        height: auto;
        width: 100%;
        background-color: #1f262d;
        overflow-x: hidden;
        transition: top 0.5s;
        z-index: 1000; /* Ensure it's above other content */
    }

    .top-sidebar.open {
        top: 0; /* Slide down to reveal the sidebar */
    }

    .scroll-sidebar {
        height: calc(100vh - 60px); /* Full height minus the toggle button height */
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
</style>
</body>
</html>
