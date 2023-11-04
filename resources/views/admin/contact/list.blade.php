@extends('admin.layouts.master')

@section('title','Contact List')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool" style="margin-top:-10px">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Contact List</h2>
                        </div>   
                    </div>
                    <a href="{{ route('admin#contactPage') }}"><button class="btn btn-sm btn-secondary text-white"><span class="mx-3"> All </span></button></a>  
                </div>
                <div class="">
                    <div class="d-flex justify-content-between mb-4 align-items-center">   
                        <h4 class="text-secondary">Total - <span class="text-success">{{ $contacts->total() }}</span></h4>
                        <h5 class="text-secondary">Search Key : <span class="text-primary">{{ request('searchKey') }}</span></h5>
                        <div >
                            <form action="{{ route('admin#contactPage') }}" method="get" class="d-flex">
                                <input type="text" name="searchKey" id="" class="form-control" value="{{ request('searchKey') }}" placeholder="search...">
                                <button type="submit" class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                        </div>
                    </div>
                </div>

                @if ($contacts->total()!= 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center ">
                        <thead >
                            <tr>
                                <th>Id</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($contacts as $c)
                        <tr class="tr-shadow ">
                            <td class="d-flex align-items-center" style="margin-top:15%;">
                                <div>{{ $c->id }}</div>
                            </td>
                            <td>
                                <span class="block-email">{{ $c->name }}</span>
                            </td>
                            <td>
                                {{ implode(explode('@gmail.com', $c->email)) }}
                                <p>@gmail.com</p>    
                            </td>
                            <td><a href="{{ route('admin#contactDetailPage',$c->id) }}">
                                {{ Str::words($c['message'], 6, '...') }}</a>
                            </td>
                            <td>{{ $c->created_at->format('j-F-Y') }}</td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="{{ route('admin#contactDetailPage',$c->id) }}" class="me-2">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                    </a>
                                    <a  href="{{ route('Admin@deleteContact',$c->id) }}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>    
                        <tr class="spacer"></tr>            
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
                @else
                    <div class="d-flex justify-content-center mt-5">
                        <h2 class="text-secondary mt-3">There is no contact </h2>
                    </div>
                @endif
                <div class="mt-2">
                    {{ $contacts->appends(request()->query())->links() }}
                </div>
            </div>     
        </div>  
    </div>
</div>
@endsection
