@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Role to {{$user->name}}</div>
                    <div class="panel-body">
                        <form action="{{url('/admin/add-user-role/'.$user->id)}}" method="POST" class="form-horizontal">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="role" class="col-md-4 control-label">Role</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="role" id="role">
                                        @foreach($roles as $r)
                                            @if(!$user->hasRole($r->name))
                                                <option value="{{$r->id}}">
                                                    {{ $r->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="{{url('/admin/manage-user-roles/'.$user->id)}}" class="btn btn-default">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
