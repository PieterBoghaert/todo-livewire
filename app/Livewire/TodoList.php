<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Log;

class TodoList extends Component
{

    public $filter = 'all';
    public $completed = false;

    #[Rule('required|min:3|max:50')]
    public $name;

    public function create()
    {
        $this->validateOnly('name');
        $maxOrder = Todo::max('order') ?? 0;

        Todo::create([
            'name' => $this->name,
            'completed' => $this->completed,
            'order' => $maxOrder + 1,
        ]);

        $this->reset('name', 'completed');
        //session()->flash('success', 'Todo created successfully.');
    }

    public function updateTodoOrder($todos)
    {
        foreach ($todos as $todo) {
            Todo::whereId($todo['value'])->update(['order' => $todo['order']]);
        }
    }

    public function delete($id)
    {
        try {
            Todo::findOrFail($id)->delete();
        } catch (\Throwable $th) {
            session()->flash('error', 'Failed to delete todo. Please try again.');
            Log::error($th->getMessage(), []);
            return;
        }
    }

    public function deleteAllCompleted()
    {
        try {
            Todo::where('completed', true)->delete();
        } catch (\Throwable $th) {
            session()->flash('error', 'Failed to delete todos. Please try again.');
            Log::error($th->getMessage(), []);
            return;
        }
    }

    function toggle($id)
    {
        $todo = Todo::find($id);
        $todo->completed = !$todo->completed;
        $todo->save();
    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => $this->filteredTodos, // Use the computed property for filtered todos
        ]);
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function getFilteredTodosProperty()
    {
        return match ($this->filter) {
            'active' => Todo::where('completed', false)->orderBy('order')->get(),
            'completed' => Todo::where('completed', true)->orderBy('order')->get(),
            default => Todo::orderBy('order')->get(),
        };
    }
}
