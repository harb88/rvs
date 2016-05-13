@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>Village Name</th>
                                <th>Village Address</th>
                                <th>No. of Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($villages as $v)
                                <tr>
                                    <td>{{$v->v_name}}</td>
                                    <td>{{$v->v_address}}</td>
                                    <td>{{$v->Unit->count()}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
