<div class="static w-full px-10 py-4 text-xl border-2 border-black bg-adobe">
    <nav class="flex justify-between">
        <div class="flex flex-col justify-center text-3xl">
            <a href="{{ url('home') }}">ALQA</a>
        </div>
        <button id="menuButton" class="w-10 h-10 rounded-full md:hidden bg-alqa-charcoal">
        </button>
        <div id="mobileMenu" class="hidden md:grid md:grid-cols-1 divide-y-2 divide-black">
            <a class="mb-4 text-right" href="#">
                {{ Auth::user()->name }}
            </a>
            <ul class="flex flex-row pt-4 space-x-16">
                <li><a href="{{ url('artwork') }}">Artworks</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </div>
    </nav>
</div>
