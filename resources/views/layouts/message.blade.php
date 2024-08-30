@if (session('message'))
    <div class="rounded-lg bg-green-100 px-4 py-4 shadow-sm sm:rounded-lg">
        <div class="text-sm">{{ session('message') }}</div>
    </div>
@endif
