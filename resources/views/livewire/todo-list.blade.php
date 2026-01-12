<div>

    <header class="main-header">
        <h1>TODO</h1>
        <div class="theme-toggle" data-theme="light">
            <img src="{{ asset('img/icon-moon.svg') }}" alt="Moon icon" class="icon-moon">
            <img src="{{ asset('img/icon-sun.svg') }}" alt="Sun icon" class="icon-sun">
        </div>
    </header>

    @include('includes.create-todo-list')
    <div>
        <ul wire:sortable="updateTodoOrder" class="todo-list">
            @foreach ($todos as $todo)
                @include('includes.todo-card', ['todo' => $todo])
            @endforeach
        </ul>
        <footer class="todo-list__footer">
            <div class="todo-list__count">
                {{ $todos->count() }} items left
            </div>
            <div class="todo-list__filters">
                <button wire:click="setFilter('all')" class="{{ $filter === 'all' ? 'active' : '' }}">All</button>
                <button wire:click="setFilter('active')"
                    class="{{ $filter === 'active' ? 'active' : '' }}">Active</button>
                <button wire:click="setFilter('completed')"
                    class="{{ $filter === 'completed' ? 'active' : '' }}">Completed</button>
            </div>
            @if ($todos->where('completed', true)->count() > 0)
                <div class="todo-list__clear" wire:click="deleteAllCompleted">
                    Clear all completed
                </div>
            @endif
        </footer>
        <div class="todo-list__reorder">
            Drag and drop to reorder list
        </div>
    </div>
</div>
