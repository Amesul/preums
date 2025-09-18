<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen flex align-middle justify-center">
<livewire:donations-widget/>
</body>
</html>
