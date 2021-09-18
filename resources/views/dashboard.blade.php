<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="wrapper">
        <div class="sidebar">
            <h2>Sidebar</h2>
            <ul>
                <li><a href="{{ route('types.list') }}"><i class="fas fa-home"></i>Detail User</a></li>
                <li><a href=""><i class="fas fa-user"></i>List Event</a></li>
            </ul>
            <div class="social_media">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <div class="main_content">
            @yield('main_content')
        </div>

    </div>
</x-app-layout>