@extends('../layouts.app')

@section('content')

    @if(session('success'))
    <div class="row bg-success">
        <div class="col-md-5 col-md-offset-5">
            <h4>
                {{session('success')}}
            </h4>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Tasks</h1>
            <table class="table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Task</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th>{{$user->id}}</th>
                            <th>{{$user->name}}</th>
                            <th>{{$user->email}}</th>
                            <th>

                                <div class="row">
                                    <form class="form" method="post" action="admin.change_role">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                                        <div class="col-md-6">
                                            <select  name="role" class="form-control">
                                                @if($user->role == 3)
                                                    <option value="3" label="Administrator" disabled selected></option>
                                                @else
                                                    <option value="1" label="Student"
                                                            @if($user->role == 1)
                                                            selected
                                                            @endif
                                                    >Student</option>
                                                    <option value="2" label="Teacher"
                                                            @if($user->role == 2)
                                                            selected
                                                            @endif
                                                    >Teacher</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="submit" class="btn btn-success btn-sm" value="Change"
                                                   @if($user->role == 3)
                                                       disabled
                                                    @endif
                                            >
                                        </div>

                                    </form>
                                </div>

                            </th>
                            <th>{{$user->accepted_id}}</th>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div> <!-- End of row -->




@endsection



































