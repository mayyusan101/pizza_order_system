@extends('user.layouts.master')

@section('title','My History')

@section('content')

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5" style="height:400px;">
                <table  class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order_Code</th>
                            <th>Total_Price</th>
                            <th>status</th>
                          
                        </tr>
                    </thead>
                    <tbody class="align-middle tbody">
                
                        @foreach ($orders as $item)
                            <tr class="text-dark">
                                <td>{{ $item->created_at->format('F-j-Y') }}</td>
                                <td>{{ $item->order_code }}</td>
                                <td>{{ $item->total_price }} kyats</td>
                                <td>
                                    @if ($item->status == 0)
                                        <span class="text-warning"><i class="fa-regular fa-clock me-1"></i>pending...</span>
                                    @elseif($item->status == 1)
                                        <span class="text-success"><i class="fa-solid fa-check-double me-1"></i>success...</span>
                                    @else
                                        <span class="text-danger"><i class="fa-solid fa-circle-exclamation me-1"></i>reject...</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="mt-4">{{ $orders->links() }}</p>
            </div>
        </div>
    </div>
    <!-- Cart End -->   
@endsection

@section('scriptContent')
<script>

</script>
@endsection