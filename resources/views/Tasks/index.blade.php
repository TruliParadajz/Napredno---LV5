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
        <div class="col-md-8">
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
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div> <!-- End of .col-md-7 -->

        <div class="col-md-3">
            <div class="well">

                <a class="btn btn-primary btn-xs" href="index.change_language">En</a>
                <a class="btn btn-primary btn-xs" href="/change/{{App::getLocale()}}">Hr</a>

                <form class="form" method="post" action="tasks.store">

                    <div class="h3">@lang('create.title'):</div>

                    <div class="form-group">
                        <label for="name">@lang('create.name'):</label>
                        <input type="text" class="form-control" name="name" title="name" required maxlength="50">
                    </div>

                    <div class="form-group">
                        <label for="name_english">@lang('create.name_english'):</label>
                        <input type="text" class="form-control" name="name_english" title="name_english" required maxlength="50">
                    </div>

                    <div class="form-group">
                        <label for="description">@lang('create.description'):</label>
                        <textarea class="form-control" name="description" rows="3" required maxlength="190"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="type">@lang('create.type'):</label>
                        <select class="form-control" name="type" required>
                            <option>@lang('create.option1')</option>
                            <option>@lang('create.option2')</option>
                            <option>@lang('create.option3')</option>
                        </select>
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="creator_id" value="{{ Auth::user()->id }}">

                    <div class="row">
                        <button type="submit" class="btn btn-default col-md-5 col-md-offset-4">@lang('create.submit')</button>
                    </div>

                </form>
            </div>
        </div>

    </div> <!-- End of row -->




@endsection



































