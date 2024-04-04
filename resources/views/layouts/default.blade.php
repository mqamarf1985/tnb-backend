<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<div class="container p-4 m-4 mt-12 w-full">
    <header class="row">
        @include('includes.header')
    </header>
    <div id="main" class="row pt-8">
        {{ $slot }}

    </div>
    <footer class="row">
        @include('includes.footer')
    </footer>
</div>
@livewireScripts
</body>
</html>
