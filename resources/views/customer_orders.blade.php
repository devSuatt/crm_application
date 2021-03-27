@extends('layouts.layout')

@section("page_title")
    Customer Orders
@endsection

@section("head_title")
    Customer Orders
@endsection

@section("content")


    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>

                <th>Id</th>
                <th>Product</th>
                <th>Customer</th>
                <th>Amount</th>
                <th>Created At</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @foreach($orderTable as $oneRow)
                <tr>

                    <td>{{ $oneRow->id }} </td>
                    <td>{{ $oneRow->product_name }}</td>
                    <td>{{ $oneRow->customer_name  }}</td>
                    <td>{{ $oneRow->amount }}</td>
                    <td>{{ date("d.m.Y H:i:s",strtotime($oneRow->created_at)) }}</td>
                    <td>
                        <button type="button_detail" onclick="calculate({{$oneRow->id}})"
                                data-toggle="modal" data-target="#orderModal" data-whatever="@getbootstrap"
                                style="font-size: smaller" class="btn btn-success">
                            <span data-feather=""></span> TOTAL PRICE </button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div style="background-color: #00CC66; font-size: larger " class="modal-header">
                    TOTAL AMOUNT
                </div>
                <div class="modal-body">
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary"
                            data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>



@endsection

<script>

    function calculate(id){

        $.ajax({
            method:"post",
            url:"/customer_orders/calculate",
            data:"id="+id,
            success:function(return_text){

                if(return_text != "ERROR"){

                    $("#orderModal").find('.modal-body').html(return_text);
                    $("#orderModal").modal('show');
                }
                else
                    alert("bişeyler hatalı oldu!");
            }
        });

    }

</script>