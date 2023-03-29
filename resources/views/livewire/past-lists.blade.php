<div>
    @if($error)
        <span class="error">ERROR: {{ $error }}</span><br>
    @endif
    <label>
        Match: <input type="text" required placeholder="Q23" wire:model="matchID" />
    </label><br><br>
    <label>
        Event: <input type="text" required placeholder="2023mabos" wire:model="eventID"/>
    </label><br><br>
    <button wire:click="submit()" class="primary">Check</button>
</div>
