<x-app-layout title="Dashboard">

    <p>Selamat datang {{ auth()->user()->name }}!</p>

    <p>Anda adalah seorang {{ auth()->user()->role }}</p>

</x-app-layout>
