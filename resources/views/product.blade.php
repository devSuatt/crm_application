@extends('layouts.layout')

@section("add_btn")
    <div style="margin-left: 1020px; margin-bottom: -44px" >
        <button type="button" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"
                class="btn btn-success">Add
            <span data-feather="plus-circle"></span></button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="product/add" id="formAddPost">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Id:</label>
                                <input required min="100" type="text" data-parsley-type="digits" class="form-control" name="id" placeholder="ID of the product">

                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" name="name" required minlength="2" maxlength="20">
                                <label for="recipient-name" class="col-form-label">Unit:</label>
                                <input type="text" class="form-control" name="unit">
                                <label for="recipient-name" class="col-form-label">Unit Price:</label>
                                <input type="text" class="form-control" name="unit_price">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button onclick="SaveButtonClicked();" type="button"
                                class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("page_title")
    Products
@endsection

@section("head_title")
    Products
@endsection

@section("add_button")
    Add
@endsection

@section("add_title")
    Add Product
@endsection

@section("save_modal")



    <div class="form-group">
        <label for="recipient-name" class="col-form-label">Id:</label>
        <input required min="100" type="text" data-parsley-type="digits" class="form-control" name="id" placeholder="ID of the product">

        <label for="recipient-name" class="col-form-label">Name:</label>
        <input type="text" class="form-control" name="name" required minlength="2" maxlength="20">
        <label for="recipient-name" class="col-form-label">Unit:</label>
        <input type="text" class="form-control" name="unit">
        <label for="recipient-name" class="col-form-label">Unit Price:</label>
        <input type="text" class="form-control" name="unit_price">
    </div>

@endsection


@section("content")

    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th></th>
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
                <td><input type="radio" name="transmission" id="transmission-standard">
                    <label for="transmission-standard"></label> </td>
                <td>
                    {{ $oneRow->id }} </td>
                <td>{{ $oneRow->name }}</td>
                <td>{{ $oneRow->unit }}</td>
                <td>{{ $oneRow->unit_price}}</td>
                <td>
                    <button type="button_update" onclick="fetchData({{$oneRow->id}})"
                            style="font-size: smaller" class="btn btn-warning">
                        <span data-feather="edit"></span></button>

                    <button type="button_detail" onclick="detailProduct({{$oneRow->id}})"
                            style="font-size: smaller" class="btn btn-info">
                        <span data-feather="info"></span></button>

                    <button type="button_delete" onclick="deleteProduct({{$oneRow->id}})"
                            style="font-size: smaller" class="btn btn-danger">
                        <span data-feather="x-circle"></span></button>

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
                <div class="modal-header">
                    Ürün Bilgileri
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


                            <!-- Product Update Modal Box -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Product Update
                    <button type="button" style="font-size: smaller" data-dismiss="modal"
                            class="btn btn-danger">X</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/product/update" id="formUpdatePost">
                        {{ csrf_field() }}

                        <div style="background-color: red">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="form-group">
                            <input type="hidden" value="0" name="id" id="hdn_id">

                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Unit:</label>
                            <input type="text" class="form-control" name="unit" id="unit" >
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Unit Price:</label>
                            <input type="text" class="form-control" name="unit_price" id="unit_price">
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button onclick="updateProduct();" type="button" class="btn btn-success" data-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("add_form_url")
/product/add
@endsection

<script>
    function deleteProduct(id) {

        //confirm
        var r = confirm("Are you sure want to delete?");
        if(r == true) {

            //ajax ile sil.
            $.ajax({

                method:"post",
                url:"/product/delete",
                data:"id="+id,
                success:function(return_text){

                    if(return_text=="SUCCESS")
                    location.reload();
                    else
                        alert("bir şeyler ters gitti!");

                }

            });


        }

    }

    function fetchData(id) {

        $.ajax({
           method:"post",
           url:"/product/fetch_data",
           data:"id="+id,
            success:function(return_text){

               the_obj = JSON.parse(return_text);
               name = the_obj.name;
               unit = the_obj.unit;
               unit_price = the_obj.unit_price;


               $("#hdn_id").val(id);
               $("#name").val(name);
               $("#unit").val(unit);
               $("#unit_price").val(unit_price);

               $("#updateModal").modal("show");
            }

        });

    }

    function detailProduct(id){

        console.log("I am here");   //debug yapılıyor...
        $.ajax({

            method:"post",
            url:"/product/detail",
            data:"id="+id,
            success:function(return_text){

                console.log("I am here2");      //debug yapılıyor...
                if(return_text != "ERROR"){

                    console.log("I am here3");      //debug yapılıyor...

                    $("#detailModal").find('.modal-body').html(return_text);
                    $("#detailModal").modal('show');
                }
                else
                    alert("bişeyler hatalı oldu!");
            }
        });

        console.log("I am here4");      //debug yapılıyor...
    }

    function updateProduct(){
        $("#formUpdatePost").submit();
    }

</script>