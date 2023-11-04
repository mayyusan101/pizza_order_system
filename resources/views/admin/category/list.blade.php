@extends('admin.layouts.master')

@section('title','Category List')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool" style="margin-top:-10px">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('category#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add category
                            </button>  
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>  
                    </div>
                </div>
                <div class="">
                    <div class="d-flex justify-content-between mb-4 align-items-center">   
                        <h4 class="text-secondary">Total - <span class="text-success">{{ $categories->total() }}</span></h4>
                        <h5 class="text-secondary">Search Key : <span class="text-primary">{{ request('searchKey') }}</span></h5>
                        <div >
                            <form action="{{ route('category#listPage') }}" method="get" class="d-flex">
                                <input type="text" name="searchKey" id="" class="form-control" value="{{ request('searchKey') }}" placeholder="search...">
                                <button type="submit" class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @if(session('delete_message'))
                    <div class="alert alert-warning alert-dismissible fade show float-end" role="alert">
                        <strong>  {{ session('name') }} {{ session('delete_message') }}</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> 
                @endif

                @if (count($categories) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center ">
                        <thead >
                            <tr>
                                <th>Id</th>
                                <th class="col-4 offset-6">Category Name</th>
                                <th>Crated Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                        <tr class="tr-shadow ">
                            <td>{{ $category->id }}</td>
                            <td>
                                <span class="block-email">{{ $category->name }}</span>
                            </td>
                            <td>{{ $category->created_at->format('j-F-Y') }}</td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="{{ route('category#updatePage', $category->id) }}" class="me-2">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('Category@delete',$category->id) }}" class="me-2">
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
                        <h2 class="text-secondary mt-3">There is no caretory </h2>
                    </div>
                @endif
                <div class="mt-2">
                    {{ $categories->appends(request()->query())->links() }}
                </div>
            </div>
            
        </div>
       
    </div>
</div>
@endsection
