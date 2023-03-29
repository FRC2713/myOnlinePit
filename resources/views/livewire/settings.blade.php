<div>
    <h1>Settings</h1>
    <form wire:submit.prevent="save">
        <label>
            Team: <input type="number" wire:model="settings.team"/>
            @error('settings.team') <span class="error">{{ $message }}</span> @enderror
        </label><br><br>
        <label>
            Event: <input type="text" wire:model="settings.event"/>
            @error('settings.event') <span class="error">{{ $message }}</span> @enderror
        </label><br><br>
        <a href="/">
            <button type="button">Cancel</button>
        </a>
        <button type="submit" class="primary">Update</button>
    </form>
</div>
