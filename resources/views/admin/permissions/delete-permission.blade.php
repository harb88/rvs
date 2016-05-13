@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Delete Permission</div>
                    <div class="panel-body">
                        <form action="{{url('/admin/delete-permission/'.$permission->id)}}" method="POST" class="form-horizontal">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <h4>Please confirm you wish to delete the following role:</h4>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{$permission->name}}" disabled="">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
                                <label for="displayName" class="col-md-4 control-label">Display Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="display_name" id="displayName" placeholder="Display Name" value="{{$permission->display_name}}" disabled="">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="{{$permission->description}}" disabled="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="{{url('/admin/manage-roles')}}" class="btn btn-default">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
