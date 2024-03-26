<div>
    <button wire:click="backup" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Backup Database
    </button>

    @if (session()->has('success'))
        <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
</div>