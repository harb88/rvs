@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Roles</div>
                    <div class="panel-body">
                        <div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Display Name</th>
                                        <th>Description</th>
                                        <th>Permissions</th>
                                        <th>
                                            @ability('root','add-roles')
                                                <div class="btn-group">
                                                    <a href="{{url('admin/add-role')}}" class="btn btn-primary btn-sm" aria-expanded="false">Add +</a>
                                                </div>
                                            @endability
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $r)
                                    <tr>
                                        <td> {{ $r->name }} </td>
                                        <td> {{ $r->display_name }} </td>
                                        <td> {{ $r->description }} </td>
                                        <td>
                                            @foreach($r->perms()->orderBy('name')->get() as $p)
                                                    {{ $p->name }} <br/>
                                            @endforeach
                                        </td>
                                        <td>
                                            @ability('root','edit-roles, delete-roles,manage-role-permissions')
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Edit <span class="caret"></span></a>
                                                    <ul class="dropdown-menu">
                                                        @ability('root','edit-roles')
                                                            <li><a href="{{ url('admin/edit-role/'.$r->id) }}">Details</a></li>
                                                        @endability
                                                        @ability('root','manage-role-permissions')
                                                            <li><a href="{{ url('admin/manage-role-permissions/'.$r->id) }}">Permissions</a></li>
                                                        @endability
                                                    </ul>
                                                </div>
                                                @ability('root','delete-roles')
                                                    <div class="btn-group">
                                                        <a href="{{ url('admin/delete-role/'.$r->id) }}" class="btn btn-danger btn-sm" aria-expanded="false">Delete</a>
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
                <div class="panel panel-default">
                    <div class="panel-heading">Permissions</div>
                    <div class="panel-body">
                        <div>
                            <table class="table table-hover table-responsive">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Display Name</th>
                                    <th>Description</th>
                                    <th>
                                        @ability('root','add-permissions')
                                        <div class="btn-group">
                                            <a href="{{ url('admin/add-permission/') }}" class="btn btn-primary btn-sm">Add +</a>
                                        </div>
                                        @endability
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $p)
                                    <tr>
                                        <td> {{ $p->name }} </td>
                                        <td> {{ $p->display_name }} </td>
                                        <td> {{ $p->description }} </td>
                                        <td>
                                            @ability('root','edit-permissions')
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Edit <span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ url('admin/edit-permission/'.$p->id) }}">Details</a></li>
                                                </ul>
                                            </div>
                                            @endability
                                            @ability('root','delete-permissions')
                                            <div class="btn-group">
                                                <a href="{{ url('admin/delete-permission/'.$p->id) }}" class="btn btn-danger btn-sm" aria-expanded="false">Delete</a>
                                            </div>
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
