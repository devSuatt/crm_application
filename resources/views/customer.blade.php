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
                        <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="customer/add" id="formAddPost">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Id:</label>
                                <input type="text" class="form-control" name="id" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Officer Name:</label>
                                <input type="text" class="form-control" name="officer_name" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Phone Number:</label>
                                <input type="text" class="form-control" name="tel" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Fax:</label>
                                <input type="text" class="form-control" name="fax" required>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Address:</label>
                                <textarea class="form-control" name="address" required></textarea>
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
    Customers
@endsection

@section("head_title")
    Customers
@endsection

@section("add_title")
    Add Customer
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
                <th>Id</th>
                <th>Name</th>
                <th>Officer Name</th>
                <th>Phone Number</th>
                <th>Fax</th>
                <th>Address</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @foreach($customerTable as $oneRow)
                <tr>
                    <td>{{ $oneRow->id }}</td>
                    <td>{{ $oneRow->name }}</td>
                    <td>{{ $oneRow->officer_name }}</td>
                    <td>{{ $oneRow->tel}}</td>
                    <td>{{ $oneRow->fax }}</td>
                    <td>{{ $oneRow->address }}</td>
                    <td>
                        <button type="button" onclick="fetchData({{$oneRow->id}});"
                                style="font-size: smaller" class="btn btn-warning" >
                            <span data-feather="edit"></span></button>

                        <button type="button" onclick="detailCustomer({{$oneRow->id}});"
                                style="font-size: smaller" class="btn btn-info" >
                            <span data-feather="info"></span></button>

                        <button onclick="deleteCustomer({{$oneRow->id}});" type="button"
                                style="font-size: smaller" class="btn btn-danger">
                                <span data-feather="x-circle"></span></button>

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

                            <!-- Customer Update Modal Box --!>
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog"
         aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Customer Update
                </div>
                <div class="modal-body">
                    <form method="post" action="/customer/update" id="formUpdatePost">
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
                            <label for="recipient-name" class="col-form-label">Officer Name:</label>
                            <input type="text" class="form-control" name="officer_name" id="officer_name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Phone Number:</label>
                            <input type="text" class="form-control" name="tel" id="tel">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Fax:</label>
                            <input type="text" class="form-control" name="fax" id="fax">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Address:</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button onclick="updateCustomer();" type="button" class="btn btn-success" data-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

                        <!-- Customer Details Modal Box --!>
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                   Müşteri Bilgileri
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("add_form_url")
/customer/add
@endsection

<script>

    $(document).ready(function () {
        $('#formAddPost').parsley();
    });

    function SaveButtonClicked(){

        $("#formAddPost").submit();

    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function deleteCustomer(id){

        //confirm

        var r = confirm("Silmek istediğinizden emin misiniz?");
        if(r == true){

            //ajax ile sil
            $.ajax({

                method:"post",
                url:"/customer/delete",
                data:"id="+id,
                success:function(return_text){

                    if(return_text == "SUCCESS")
                        location.reload();
                    else
                        alert("bişeyler hatalı oldu!");
                }
            });

        }

    }

    function detailCustomer(id){

        $.ajax({

            method:"post",
            url:"/customer/detail",
            data:"id="+id,
            success:function(return_text){

                if(return_text != "ERROR"){

                    $("#detailModal").find('.modal-body').html(return_text);
                    $("#detailModal").modal('show');
                }
                else
                    alert("bişeyler hatalı oldu!");
            }
        });
    }

    function fetchData(id) {


        $.ajax({

            method:"post",
            url:"/customer/fetch_data",
            data:"id="+id,
            success:function(return_text){

                the_obj = JSON.parse(return_text);
                name = the_obj.name;
                tel = the_obj.tel;
                officer_name = the_obj.officer_name;
                fax = the_obj.fax;
                address = the_obj.address;


                $("#hdn_id").val(id);
                $("#name").val(name);
                $("#officer_name").val(officer_name);
                $("#tel").val(tel);
                $("#fax").val(fax);
                $("#address").val(address);

                $("#updateModal").modal("show");
            }

        });

    }

    function updateCustomer(){
        $("#formUpdatePost").submit();
    }

</script>