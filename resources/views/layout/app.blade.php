<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Corporate Hub</title>

    @vite('resources/css/app.css')

    <!--CSS-->

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

</head>

<body>
    <!-- Navbar -->
    @include('components.navbar')

    {{-- Content --}}
    <div class="relative">
        <!-- Content (Moved to front using z-index) -->
        <div class="relative top-30 z-10 p-10 ">
            <div class="bg-white shadow-lg rounded-2xl p-6">
                @yield('content')
            </div>
        </div>

        <!-- Background Design (Moved to back using absolute positioning and negative z-index) -->
        <div class="absolute top-0 left-0 w-full h-[30vh] bg-amber-600 -z-10"></div>
    </div>

    <!-- Footer -->
    @include('components.footer')


</body>

</html>