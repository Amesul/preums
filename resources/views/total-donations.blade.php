<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen font-cabin-sketch text-3xl flex align-middle justify-center">
<div wire:poll.keep-alive>
    {{ $total }}
</div>
</body>
</html>
