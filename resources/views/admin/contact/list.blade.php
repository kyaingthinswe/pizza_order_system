
@extends('admin.layout.master')
@section('title','message list')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 ">
                            <thead>
                            <tr >
                                <th>ID</th>
                                <th> Name</th>
                                <th> Email</th>
                                <th> Message</th>
                                <th> Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($contacts as $c)
                                <tr class="tr-shadow">
                                    <td>{{$c->id}}</td>
                                    <td>{{strtoupper($c->name)}}</td>
                                    <td>{{$c->email}}</td>
                                    <td>{{\Illuminate\Support\Str::words($c->message,5)}}</td>
                                    <td>{{$c->created_at->format('D, F d, Y')}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="4">There is no Message</td>
                                </tr>
                            @endforelse

                            </tbody>

                        </table>
                    </div>
                    <div class="mt-2">
                        {{$contacts->appends(request()->query())->links()}}
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@stop
