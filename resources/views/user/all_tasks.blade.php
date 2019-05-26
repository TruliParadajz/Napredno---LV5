@extends('../layouts.app')

@section('content')

    @if(session('success'))
    <div class="row bg-success">
        <div class="col-md-8 col-md-offset-2">
            <h4>
                {{session('success')}}
            </h4>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-9 col-md-offset-1">
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
                        <th>Priority/Apply</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <th>{{$task->id}}</th>
                            <th>{{$task->name}}</th>
                            <th>{{$task->name_english}}</th>
                            <th>{{$task->description}}</th>
                            <th>{{$task->type}}</th>
                            <th>{{$task->creator->name}}</th>
                            <th>
                                <form class="form" method="post" action="user.apply">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                    <input type="number" max="5" min="1" name="priority" required placeholder="Priority">
                                    <input type="submit" class="btn-sm btn-success" value="Apply">
                                </form>
                            </th>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div> <!-- End of row -->




@endsection



































