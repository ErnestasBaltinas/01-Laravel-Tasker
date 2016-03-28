@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseNewTask">
                            {{trans('messages.NewTask')}}
                        </a>
                    </h4>
                </div>
                <div id="collapseNewTask" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <!-- Display Validation Errors -->
                        @include('common.errors')

                        <!-- New Task Form -->
                        <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}

                            <!-- Task Name -->
                            <div class="form-group">
                                <label for="task-name" class="col-sm-3 control-label">{{trans('messages.Task')}}</label>

                                <div class="col-sm-6">
                                    <input type="text" name="Task_name" id="task-name" class="form-control" value="{{ old('task') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="task-name" class="col-sm-3 control-label">{{trans('messages.Description')}}</label>

                                <div class="col-sm-6">
                                    <input type="text" name="description" id="task-description" class="form-control" value="{{ old('description') }}">
                                </div>
                            </div>
                            <!-- Add Task Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-btn fa-plus"></i>{{trans('messages.AddTask')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseCurrentTasks">
                                {{trans('messages.CurrentTasks')}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapseCurrentTasks" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table class="table table-striped task-table">
                                <thead>
                                <th class="col-md-3">{{trans('messages.Task')}}</th>
                                <th class="col-md-5">{{trans('messages.Description')}}</th>
                                <th class="col-md-4">{{trans('messages.Controls')}}</th>
                                </thead>
                                <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text col-md-3"><div>{{ $task->Task_name }}</div></td>
                                        <td class="table-text col-md-5"><div>{{ $task->description }}</div></td>

                                        <!-- Controls-->
                                        <td class="col-md-4">
                                            <form action="{{ url('task/'.$task->id) }}" method="POST">
                                                {!! csrf_field() !!}
                                                {!! method_field('DELETE') !!}
                                                <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#editModal" data-task-id="{{ $task->id }}"
                                                        data-task-name="{{ $task->Task_name }}" data-task-description="{{ $task->description }}">
                                                    <i class="fa fa-edit"></i> {{trans('messages.Edit')}}
                                                </button>

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i> {{trans('messages.Delete')}}
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    {!! method_field('PUT') !!}

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{trans('messages.Edit')}}</h4>
                    </div>
                    <div class="modal-body">

                            <!-- Task Name -->
                            <div class="form-group">
                                <label for="task-name" class="col-sm-3 control-label">{{trans('messages.Task')}}</label>

                                <div class="col-sm-6">
                                    <input type="text" name="Task_name" id="task-name" class="form-control" value="{{ old('task') }}">
                                </div>
                            </div>
                            <!-- Task Description -->
                            <div class="form-group">
                                <label for="task-name" class="col-sm-3 control-label">{{trans('messages.Description')}}</label>

                                <div class="col-sm-6">
                                    <input type="text" name="description" id="task-description" class="form-control" value="{{ old('description') }}">
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{trans('messages.Update')}}</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('messages.Close')}}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
