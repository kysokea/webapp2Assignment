<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminLTE 3 | Dashboard</title>



    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;500;600;700&family=Lexend:wght@300;400;500;600;700&display=swap');

        /* ==============================
   Sidebar Menu Transition
================================ */
        .khmer-text {
            font-family: 'Kantumruy Pro', sans-serif;
            color: gray;
        }

        .english-text {
            font-family: 'Lexend', sans-serif;
            color: gray;
        }

        .english-text2 {
            font-family: 'san', sans-serif;
            color: gray;
        }

        .main-sidebar .nav-link {
            transition:
                background-color 0.25s ease,
                color 0.25s ease,
                padding-left 0.25s ease,
                transform 0.2s ease;
        }

        /* Hover effect */
        .main-sidebar .nav-link:hover {
            background-color: rgba(78, 87, 224, 0.08);
            color: #fff;
            padding-left: 18px;
        }

        /* Active menu */
        .main-sidebar .nav-link.active {
            background-color: #4686e7 !important;
            color: #fff !important;
            transition: all 0.3s ease;
        }

        /* Active icon */
        .main-sidebar .nav-link.active i {
            color: #fff !important;
            transition: color 0.3s ease;
        }

        /* Icon transition */
        .main-sidebar .nav-link i {
            transition:
                transform 0.3s ease,
                color 0.3s ease;
        }

        /* Move icon slightly when hovering */
        .main-sidebar .nav-link:hover i {
            transform: translateX(3px);
        }


        /* ==============================
   Tree Menu Animation
================================ */

        .nav-treeview {
            transition:
                max-height 0.35s ease,
                opacity 0.3s ease;
        }


        /* ==============================
   Management arrow transition
================================ */

        .nav-item>.nav-link .right {
            transition: transform 0.3s ease;
        }

        /* Rotate arrow when menu is open */
        .nav-item.menu-open>.nav-link .right {
            transform: rotate(-90deg);
        }

        .checkout-btn {
            position: relative !important;
            width: 100% !important;
            min-height: 45px !important;

            display: flex !important;
            align-items: center !important;
            justify-content: center !important;

            text-align: center !important;
        }

        .sale-button-content {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        #sale-button-text {
            display: block;
            width: auto;
            text-align: center;
        }

        #sale-button-spinner {
            margin-left: 1px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed khmer-text">
    <div class="wrapper">
        @include('partials.navbar')

        @include('partials.sidebar')

        <div class="content-wrapper">

            <section class="content pt-3">

                @yield('content')

            </section>

        </div>

        @include('partials.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function confirmLogout() {
            Swal.fire({
                toast: true,
                position: 'top-end',

                icon: 'warning',
                title: 'Logout?',
                text: 'Are you sure you want to logout?',

                showCancelButton: true,
                confirmButtonText: 'Logout',
                cancelButtonText: 'Cancel',

                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',

                // showCloseButton: true,

                timer: undefined,
                timerProgressBar: false
            }).then((result) => {

                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }

            });
        }
    </script>
</body>

</html>
