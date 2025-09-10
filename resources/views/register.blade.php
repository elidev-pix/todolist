@extends('base')

@section('title', 'Liste ToDo')

@section('header','Todo List')

@section('account')
    <a href="{{ route('dashboard') }}"><ion-icon id="account" name="person-circle-outline"></ion-icon></a>
@endsection

@section('second','Ajouer une nouvelle tâche')

@section('content')

<form action="{{ route('todos.store') }}" method="POST">
    @csrf
    <input type="text" name="name" id="name" required> <br><br>
    <button class="save" type="submit">Enregistrer</button>
</form>

@endsection

@section('list')
<div class='list'>
    @if(isset($todos) && count($todos) > 0)
        @foreach($todos as $todo)
            <div class="todo-item">
                <div class="top">
                    <ion-icon class="color {{ $todo->end_time ? 'done' : '' }} {{ $todo->start_time ? 'while' : '' }} {{ $todo->reset ? 'reloaded' : '' }}" name="ellipse-outline"></ion-icon>
                    <span class="todo {{ $todo->end_time ? 'ended' : '' }}">{{ $todo->name }}</span>
                    <form action="{{ route('todos.destroy',$todo->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="delete" type="submit" >
                            <ion-icon name="trash-bin-outline" class="deleteIcon {{ $todo->start_time ? 'started' : '' }} {{ $todo->reset ?  'reseted' : '' }} {{ $todo->end_time ? 'ended' : '' }}"></ion-icon>
                        </button>
                    </form>

                    <a href="{{route('todos.edit', $todo->id)}}">
                        <button>
                            <ion-icon name="pencil-outline" class="pencilIcon {{ $todo->start_time ? 'started' : '' }} {{ $todo->reset ? 'reseted' : '' }}"></ion-icon>
                        </button>
                    </a>

                    <form action="{{ route('todoTiming',$todo->id ) }}" method="POST" style="margin: 0;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="name" value="{{ $todo->name }}">
                        <button type="submit">
                            <ion-icon  name="add-circle-outline" class="startIcon {{ $todo->start_time ? 'started' : '' }} {{ $todo->reset ? 'reseted' : '' }}"></ion-icon>
                        </button>
                    </form>

                    <form action="{{ route('todoEndTiming',$todo->id ) }}" method="POST" style="margin: 0;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="name" value="{{ $todo->name }}">
                        <button type="submit">
                            <ion-icon class="endIcon {{ $todo->start_time ? 'started' : '' }} {{ $todo->end_time ? 'ended' : '' }}" name="checkmark-done-circle-outline"></ion-icon>
                        </button>
                    </form>

                    <form action="{{ route('todos.reset',$todo->id ) }}" method="POST" style="margin: 0;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="name" value="{{ $todo->name }}">
                        <button type="submit">
                            <ion-icon class="resetIcon {{ $todo->end_time ? 'ended' : '' }} {{ $todo->reset ? 'reseted' : '' }}" name="refresh-circle-outline"></ion-icon>
                        </button>
                    </form> 
            </div>
            <div class="bottom">

                <div class="start"> 
                    <p>Date de début</p>
                    <small class="date {{ $todo->start_time ? 'checked': '' }} ">{{ \Carbon\Carbon::parse($todo->start_date)->format('d/m/Y') }}  à  {{ $todo->start_time }}</small>
                    <div class="line {{ $todo->start_time ? 'checked': '' }}">---</div>
                </div> 
                

                <div>
                    <p>Durée</p>  
                    <small class="time {{ $todo->duration ? 'checked': '' }} ">{{ $todo->duration }}</small>
                    <div class="line {{ $todo->duration ? 'checked': '' }}">---</div>
                </div> 
                    
                <div class="end">
                    <p>Date de fin</p>
                    <small class="date {{ $todo->end_time ? 'checked': '' }} ">{{ \Carbon\Carbon::parse($todo->end_date)->format('d/m/Y') }}  à  {{ $todo->end_time }}</small>
                    <div class="line {{ $todo->end_time ? 'checked': '' }}">---</div>
                </div>

            </div>
            </div>
        @endforeach
    @else 
    <small style="position:relative; top:50px;">Aucun todo pour le moment</small>
    @endif
    

</div>

@endsection
