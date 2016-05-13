@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{url('/admin/manage-roles')}}">Manage Roles and Permissions</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{url('/admin/manage-users')}}">Manage Users</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
