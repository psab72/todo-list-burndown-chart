@extends('layouts.app')

@section('content')
<div id="app" class="container">
    <figure class="highlight">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <form @submit.prevent="createNewTask">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control input-lg" placeholder="Task Name" v-model="newtask" required>
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-default btn-lg">+ New Task</button>
                    </span>
                    </div>
                </form>
            </div>
        </div>
    </figure>
    
    <div class="row">
        <div class="col-md-12">
            <line-chart :chart-data="datacollection" :options="options" :width="1200":height="500"></line-chart>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-6">
            <h3 class="text-center">Pending Tasks <span class="label label-warning">@{{ pendingTasks.length }}</span></h3>
            <div class="list-group">
                <a class="list-group-item" v-for="todo in pendingTasks" @click="toggleTaskStatus(todo)">@{{ todo.task }} 
                    <span>
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
        
        <div class="col-md-6">
            <h3 class="text-center">Completed Tasks <span class="label label-success">@{{ completedTasks.length }}</span></h3>
            <div class="list-group">
                <a class="list-group-item" v-for="todo in completedTasks" @click="toggleTaskStatus(todo)">@{{ todo.task }} 
                    <span>
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
