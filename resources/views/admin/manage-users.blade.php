@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>

                    <div class="panel-body">
                        <div>
                            <table class="table table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>
                                            @ability('root','add-users')
                                            <div class="btn-group">
                                                <a href="{{url('admin/add-user')}}" class="btn btn-primary btn-sm" aria-expanded="false">Add +</a>
                                            </div>
                                            @endability
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $u)
                                        <tr>
                                            <td> {{ $u->name }} </td>
                                            <td> {{ $u->email }} </td>
                                            <td>
                                                @foreach($u->roles()->orderBy('name')->get() as $r)
                                                    {{ $r->display_name }} <br/>
                                                @endforeach
                                            </td>
                                            <td>
                                                @ability('root','edit-users,delete-users,manage-user-roles')
                                                    <div class="btn-group">
                                                        <a href="#" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Edit <span class="caret"></span></a>
                                                        <ul class="dropdown-menu">
                                                            @ability('root','edit-users')
                                                                <li><a href="{{ url('admin/edit-user/'.$u->id) }}">Details</a></li>
                                                            @endability
                                                            @ability('root','manage-user-roles')
                                                                <li><a href="{{ url('admin/manage-user-roles/'.$u->id) }}">Roles</a></li>
                                                            @endability
                                                        </ul>
                                                    </div>
                                                    @ability('root','delete-users')
                                                        <div class="btn-group">
                                                            <a href="{{ url('admin/delete-user/'.$u->id) }}" class="btn btn-danger btn-sm" aria-expanded="false">Delete</a>
                                                        </div>
                                                    @endability
                                                @endability
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
