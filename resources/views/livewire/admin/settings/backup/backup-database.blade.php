<div>
    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div>{{ session('error') }}</div>
    @endif

    <button wire:click="backup">Backup Now</button>

    {{-- @if (session()->has('success'))
        <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif --}}
</div>