@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{url('/admin/manage-roles')}}" class="btn btn-default btn-sm">Back</a>
                         {{$role->display_name}} permissions
                    </div>

                    <div class="panel-body">
                        <div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Display Name</th>
                                        <th>Description</th>
                                        <th>
                                            @ability('root','add-role-permissions')
                                            <div class="btn-group">
                                                <a href="{{url('admin/add-role-permission/'.$role->id)}}" class="btn btn-primary btn-sm" aria-expanded="false">Add +</a>
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
                                                @ability('root','delete-role-permissions')
                                                <div class="btn-group">
                                                    <a href="{{ url('admin/delete-role-permission/'.$role->id.'/'.$p->id) }}" class="btn btn-danger btn-sm" aria-expanded="false">Delete</a>
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
