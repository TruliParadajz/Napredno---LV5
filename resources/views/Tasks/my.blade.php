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
                        <th>Students</th>
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
                            <th>
                                <table class="table">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Priority</th>
                                        <th>Accept</th>
                                    </tr>
                                    @if($task->taken == 1)
                                        <tr>
                                            <th>{{$task->students->id}}</th>
                                            <th>{{$task->students->name}}</th>
                                            <th>-</th>
                                            <th>Accepted</th>
                                        </tr>
                                    @else
                                        @foreach($task->students as $student)
                                            <tr>
                                                <th>{{$student->id}}</th>
                                                <th>{{$student->name}}</th>
                                                <th>{{$student->priority}}</th>
                                                <th>
                                                    @if($student->priority == 1)
                                                    <form action="tasks.accept" method="post">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                        <input type="hidden" name="task_id" value="{{ $task->id }}">

                                                        <input type="submit" class="btn-sm btn-success" name="Accept" value="Accept"/>
                                                    </form>
                                                    @endif
                                                </th>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>
                            </th>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div> <!-- End of .col-md-7 -->

    </div> <!-- End of row -->




@endsection



































