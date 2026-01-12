<div class="l-create-todo">
    <form wire:submit.prevent="create">
        <div class="form-group">
            <input type="checkbox" id="chk-create-todo" wire:model="completed">

            <label for="newtodo" class="sr-only">
                Create new todo
            </label>

            <input wire:model="name" type="text" id="newtodo" placeholder="Create new todo...">
        </div>
    </form>
</div>
