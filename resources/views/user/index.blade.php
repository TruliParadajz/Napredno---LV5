@extends('../layouts.app')

@section('content')


    @if(session('success'))
    <div class="row bg-success">
        <div class="col-md-5 col-md-offset-3">
            <h4>
                {{session('success')}}
            </h4>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>Tasks</h1>
            <table class="table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Name(English)</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Creator</th>
                        <th>Status</th>
                        <th>Priority</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($tasks as $task)
                        @if($tasks->format == 1)
                        <tr>
                            <th>{{$task->id}}</th>
                            <th>{{$task->name}}</th>
                            <th>{{$task->name_english}}</th>
                            <th>{{$task->description}}</th>
                            <th>{{$task->type}}</th>
                            <th>{{$task->creator->name}}</th>
                            <th>
                                @if($task->taken == 1)
                                Accepted
                                @else
                                    Not Accepted
                                @endif
                            </th>
                            <th>{{$task->priority->priority}}</th>
                        </tr>
                        @elseif($tasks->format == 2)
                            <tr>
                                <th>{{$task->info->id}}</th>
                                <th>{{$task->info->name}}</th>
                                <th>{{$task->info->name_english}}</th>
                                <th>{{$task->info->description}}</th>
                                <th>{{$task->info->type}}</th>
                                <th>{{$task->info->creator->name}}</th>
                                <th>
                                    @if($task->info->taken == 1)
                                        Accepted
                                    @else
                                        Not Accepted
                                    @endif
                                </th>
                                <th>
                                    <form class="form" method="post" action="user.change_priority">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                                        <input type="number" max="5" min="1" name="priority" required placeholder="Priority"
                                               value="{{$task->priority}}">
                                        <input type="submit" class="btn-sm btn-success" value="Change">
                                    </form>
                                </th>
                            </tr>
                        @endif
                    @endforeach
                </tbody>

            </table>
        </div>

    </div> <!-- End of row -->




@endsection



































