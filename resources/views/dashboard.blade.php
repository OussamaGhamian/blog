<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="panel" style="
    font-size:30px;
    display: flex;
    margin-top:30px;
    height: 70vh;
    justify-content: space-around;
    align-items: flex-start;">
        <p><a href="/articles">News feed</a></p>
        <p><a href="myarticles">My Articles</a></p>
        <p><a href="articles/create">New Article</a></p>
    </div>
</x-app-layout>
