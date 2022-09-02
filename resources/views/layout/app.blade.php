<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>takumi | @yield('title')</title>
    @include('includes.style')
    @stack('style')
</head>
<body>
    <header>
        @include('includes.nav')
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        @include('includes.footer')
    </footer>
    @include('includes.script')
    @stack('script')
</body>
</html>
