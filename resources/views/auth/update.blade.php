<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo List') }}
        </h2>
    </x-slot>
    <br><br>
    <form class="flex flex-col items-center text-center gap-5" action="{{ route('todos.store') }}" method="POST">
        @csrf
        <input  class="relative top-5 rounded-md font-sans shadow-sm bg-white p-1 h-12 w-72 transition duration-100" type="text" name="todo_name" id="todo_name" placeholder="Modifier la tâche" value="{{ $todo-> todo_name }}" required> <br><br>
        <button class="save" type="submit">Enregistrer</button>
    </form>
</x-app-layout>