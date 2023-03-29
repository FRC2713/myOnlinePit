<div>
    <div>
        <h1>Pit Checklist</h1>
        <h2>Match: {{ $match }}</h2>
        @if(!$error)
            @foreach($checks as $check)

                @if($check["type"] === 'boolean')
                    <label>
                        {{ $check["name"] }}:
                        <input type="checkbox"
                               @disabled($hasSubmitted) @checked($check["value"]) wire:model="checks.{{ $loop->index }}.value"
                               wire:click="submitForm()">
                    </label>
                @elseif($check["type"] === 'string')
                    <label>
                        {{ $check["name"] }}:
                        <input type="text" @disabled($hasSubmitted) wire:model.lazy="checks.{{ $loop->index }}.value"
                               wire:keydown="submitForm()">
                    </label>
                @elseif($check['type'] === 'header')
                    <h1>{{ $check['name'] }}</h1>
                @elseif($check['type'] === 'header2')
                    <h2>{{ $check['name'] }}</h2>
                @endif

                <br>
            @endforeach
            @if($hasSubmitted)
                <label>Signed: <input type="text" value="{{$signed}}" disabled></label>
            @endif
        @else
            <span class="error">ERROR: {{ $error }}</span>
        @endif
    </div>
    @if($showModal && !$error)
        <div class="fixed top-0 left-0 z-10 w-full h-screen bg-[rgba(0,0,0,0.5)]"></div>
        <div class="fixed m-auto right-0 left-0 bottom-0 top-0 w-96 h-48 z-20 bg-white p-6 shadow-md">
            <h1>Pit check complete</h1><br>
            <label class="mb-2">Signed: <input wire:model="signed" type="text" required placeholder="Name"/></label><br>
            <button wire:click="$set('showModal', false)" class="mt-2">Cancel</button>
            <button wire:click="submit()" class="mb-2 primary">OK</button>
        </div>
    @endif
    @if(!$hasSubmitted)
        <button class="mt-2 primary" wire:click="$set('showModal', true)">Submit</button>
    @endif
</div>
