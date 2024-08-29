@props(['route'])

<form method="POST" action="{{ $route }}">
    @csrf
    @method('delete')
    <x-dropdown-link href="{{ $route }}"
                     onclick="event.preventDefault();
                     this.closest('form').submit();">
        {{ $slot ?? 'Delete' }}
    </x-dropdown-link>
</form>
