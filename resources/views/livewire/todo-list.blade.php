<div>

    <header class="main-header">
        <h1>TODO</h1>
        <div class="theme-toggle" data-theme="light">
            <img src="{{ public_path('img/icon-moon.svg') }}" alt="Moon icon" class="icon-moon">
            <img src="{{ public_path('img/icon-sun.svg') }}" alt="Sun icon" class="icon-sun">
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
                <span wire:click="setFilter('all')" class="{{ $filter === 'all' ? 'active' : '' }}">All</span>
                <span wire:click="setFilter('active')" class="{{ $filter === 'active' ? 'active' : '' }}">Active</span>
                <span wire:click="setFilter('completed')"
                    class="{{ $filter === 'completed' ? 'active' : '' }}">Completed</span>
            </div>
            @if ($todos->where('completed', true)->count() > 0)
                <div class="todo-list__clear" wire:click="deleteAllCompleted">
                    Clear all completed
                </div>
            @endif
        </footer>

    </div>
</div>
