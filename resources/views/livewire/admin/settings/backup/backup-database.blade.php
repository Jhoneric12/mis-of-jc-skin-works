<div>
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <button wire:click="backup">Backup Database</button>
</div>
