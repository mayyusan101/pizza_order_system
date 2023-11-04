@extends('admin.layouts.master')

@section('title','Users List')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool" style="margin-top:-10px">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">User List</h2>
                        </div>
                    </div>
                    <div class="float-end">
                        <h3 class="text-info">Total - <span>{{ $users->total() }}</span></h3>
                    </div>
                    <div class="table-data__tool-right">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>  
                    </div>         
                </div>
                @if(session('deleteSuccess'))
                    <div class="alert alert-warning alert-dismissible fade show float-end" role="alert">
                        <strong>  {{ session('deleteSuccess') }}</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> 
                @endif
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center ">
                        <thead >
                            <tr>
                                <th>image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th >Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="tr-shadow">
                                    <input type="hidden" id="userId" value="{{ $user->id }}">
                                    <td>
                                        @if ($user->image != null)
                                            <img src="{{ asset('storage/'.$user->image) }}" alt="" class="img-thumbnail shadow-sm">
                                        @elseif($user->gender == 'male')
                                            <img src="{{ asset('images/user.jpg') }}" alt="" class="img-thumbnail shadow-sm"  >
                                        @elseif($user->gender == 'female')
                                            <img src="{{ asset('images/user-female.png') }}" alt=""  class="img-thumbnail shadow-sm">
                                        @else
                                            <img src="{{ asset('images/user-other.png') }}" alt=""  class="img-thumbnail shadow-sm">
                                        @endif 
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        {{ implode(explode('@gmail.com', $user->email)) }}
                                        <p>@gmail.com</p>
                                    </td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td class=" px-1 ">
                                        <div class="table-data-feature mb-3">
                                            <a onclick='return confirm("Are you sure you want to delete ?")' href="{{ route('Admin@deleteUser',$user->id) }}" class="mt-0 mb-1">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa-solid fa-circle-xmark text-danger"></i>
                                                </button>
                                            </a>                      
                                        </div>
                                        <select class="form-control changeStatus mb-5">
                                            <option value="user" selected>User</option>
                                            <option value="admin">Admin</option>
                                        </select>                    
                                    </td>                              
                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach                     
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
        
                <div class="mt-2">
                    {{ $users->links() }}
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

            $.ajax({
                type : 'get',
                url  : '/user/change/role',
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
