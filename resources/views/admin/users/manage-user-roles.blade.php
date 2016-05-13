@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{url('/admin/manage-users')}}" class="btn btn-default btn-sm">Back</a>
                         {{$user->name}}'s roles
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
                                            @ability('root','add-user-roles')
                                            <div class="btn-group">
                                                <a href="{{url('admin/add-user-role/'.$user->id)}}" class="btn btn-primary btn-sm" aria-expanded="false">Add +</a>
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
                                                @ability('root','delete-user-roles')
                                                <div class="btn-group">
                                                    <a href="{{ url('admin/delete-user-role/'.$user->id.'/'.$r->id) }}" class="btn btn-danger btn-sm" aria-expanded="false">Delete</a>
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
