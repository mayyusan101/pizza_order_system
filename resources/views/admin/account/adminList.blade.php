@extends('admin.layouts.master')

@section('title','Admin List')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool" style="margin-top:-10px">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Admin List</h2>

                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="d-flex justify-content-between mb-4 align-items-center">
                        <h4 class="text-info">Total - <span class="text-info">{{ $admins->total() }}</span></h4>
                        <h5 class="text-secondary">Search Key : <span class="text-primary">{{ request('searchKey') }}</span></h5>
                        <div >
                            <form action="#" method="get" class="d-flex">
                                <input type="text" name="searchKey" id="" class="form-control" value="{{ request('searchKey') }}" placeholder="search...">
                                <button type="submit" class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @if(session('deleteSuccess'))
                    <div class="alert alert-warning alert-dismissible fade show float-end" role="alert">
                        <strong>  {{ session('deleteSuccess') }}</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> 
                @endif

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead >
                            <tr>
                                <th class="col-2">Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $a)
                                <tr class="tr-shadow">
                                    <input type="hidden" id="userId" value="{{ $a->id }}">
                                    <td class="col-2">
                                        @if($a->image != null)
                                            <img src="{{ asset('storage/'.$a->image) }}"class="img-thumbnail shadow-sm" >
                                        @elseif($a->gender == 'male')
                                            <img src="{{ asset('images/admin.png') }}" class="img-thumbnail shadow-sm" >
                                        @elseif($a->gender == 'female') 
                                            <img src="{{ asset('images/admin-female.png') }}" class="img-thumbnail shadow-sm">
                                        @else
                                            <img src="{{ asset('images/other.jpg') }}" class="img-thumbnail shadow-sm ">
                                        @endif
                                    </td>
                                    <td> 
                                        <span class="block-email">{{ $a->name }}</span>
                                    </td>
                                    <td>
                                        {{ implode(explode('@gmail.com', $a->email)) }}
                                        <p>@gmail.com</p>
                                    </td>
                                    <td>{{ $a->gender }}</td>
                                    <td>{{ $a->phone }}</td>
                                    
                                    <td>
                                        <div class="table-data-feature">
                                            @if(Auth::user()->id == $a->id)

                                            @else
                                                <select class="form-control changeStatus me-1">                                         
                                                    <option value="admin" selected>Admin</option>
                                                    <option value="user">User</option>
                                                </select>
                                                <a href="{{ route('Admin@delete',$a->id) }}" onclick="return confirm('Are you sure you want to delete ?')">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete "></i>
                                                    </button>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>    
                                <tr class="spacer"></tr>
                            @endforeach          
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
                
                <div class="mt-2">
                    {{ $admins->links() }}
                </div>
            </div>     
        </div> 
    </div>
</div>
@endsection

@section('scriptContent')
<script>
    $(document).ready(function(){

        $('.changeStatus').change(function(){

            $parentNode = $(this).parents("tr");
            $userId = $parentNode.find('#userId').val();
            $role = $parentNode.find('.changeStatus').val();

            console.log('changing');
            $.ajax({
                type : 'get',
                url  : '/admin/change/role',
                data : {
                    'id'     : $userId,
                    'role'  : $role
                },
                dataType : 'json',
                success  : function(response){
                   
                }
            })
            location.reload();
        })

    })
</script>
@endsection
