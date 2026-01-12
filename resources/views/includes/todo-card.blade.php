<li wire:key="{{ $todo->id }}" wire:sortable.item="{{ $todo->id }}" class="todo-list__item">
    {{-- Checkbox --}}
    <div>
        <input wire:click="toggle({{ $todo->id }})" type="checkbox" id="todo-{{ $todo->id }}"
            @checked($todo->completed) class="">
        <label for="todo-{{ $todo->id }}" class="{{ $todo->completed ? 'line-through' : '' }}">
            {{ $todo->name }}
        </label>
    </div>

    {{-- Delete --}}
    <button wire:click="delete({{ $todo->id }})" class="todo-list__delete">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M17.6777 0.707107L16.9706 0L8.83883 8.13173L0.707107 0L0 0.707107L8.13173 8.83883L0 16.9706L0.707106 17.6777L8.83883 9.54594L16.9706 17.6777L17.6777 16.9706L9.54594 8.83883L17.6777 0.707107Z"
                fill="#494C6B" />
        </svg>
    </button>

    <button wire:sortable.handle class="todo-list__drag">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 18 18">
            <rect x="4" y="5" width="10" height="1" rx="1" fill="#494C6B" />
            <rect x="4" y="8" width="10" height="1" rx="1" fill="#494C6B" />
            <rect x="4" y="11" width="10" height="1" rx="1" fill="#494C6B" />
        </svg>
    </button>

</li>
