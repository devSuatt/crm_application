@extends('layouts.layout')

@section("page_title")
    Orders
@endsection

@section("head_title")
    Orders
@endsection

@section("content")

    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif


    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>

                <th>{{ trans("products.id") }}</th>
                <th>{{ trans("products.name") }}</th>
                <th>{{ trans("products.unit") }}</th>
                <th>{{ trans("products.unit_price") }}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @foreach($productTable as $oneRow)
                <tr>

                    <td>{{ $oneRow->id }} </td>
                    <td>{{ $oneRow->name }}</td>
                    <td>{{ $oneRow->unit }}</td>
                    <td>{{ $oneRow->unit_price}}</td>
                    <td>

                        <button type="button_detail" onclick="detailProduct({{$oneRow->id}})"
                                data-toggle="modal" data-target="#detailModal" data-whatever="@getbootstrap"
                                style="font-size: smaller" class="btn btn-success">
                            <span data-feather="shopping-cart"></span> ORDER</button>

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <!-- Product Details Modal Box -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div style="background-color: #00CC66; font-size: larger " class="modal-header">
                    Order has been taken
                </div>
                <div class="modal-body">
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label"> Amount :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="amount"
                               id="amount" placeholder="Item Count" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn_order_buy" type="button" class="btn btn-outline-success"
                            onclick="" >BUY</button>
                    <button type="button" class="btn btn-outline-secondary"
                            data-dismiss="modal">CANCEL</button>
                </div>
            </div>
        </div>
    </div>

@endsection


<script>

    function BuyProduct(id) {

        //product id
        //amount

        amount = $("#amount").val();

        $.ajax({
            method:"post",
            url:"/order/buy",
            data:"id="+id+"&amount="+amount,
            success:function(return_text){

                if(return_text == "success"){
                    alert("Satışınız onaylanmıştır.");
                    $("#detailModal").modal("hide");
                    $("#amount").val("");
                }

            }
        });

    }

    function detailProduct(id){

        $.ajax({

            method:"post",
            url:"/order/detail",
            data:"id="+id,
            async:false,
            success:function(return_text){

                if(return_text != "ERROR"){

                    $("#btn_order_buy").attr("onclick","BuyProduct("+id+");");

                    $("#detailModal").find('.modal-body').html(return_text);
                    $("#detailModal").modal('show');
                }
                else
                    alert("bişeyler hatalı oldu!");
            }
        });

    }



</script>