@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Permission to {{$role->name}}</div>
                    <div class="panel-body">
                        <form action="{{url('/admin/add-role-permission/'.$role->id)}}" method="POST" class="form-horizontal">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="permission" class="col-md-4 control-label">Permission</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="permission" id="permission">
                                        @foreach($permissions as $p)
                                            @if(!$role->hasPermission($p->name))
                                                <option value="{{$p->id}}">
                                                    {{ $p->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="{{url('/admin/manage-role-permissions/'.$role->id)}}" class="btn btn-default">Cancel</a>
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
