<!DOCTYPE HTML>
<html>

<head>
    <script src="/js/jquery.js"></script>
    <script src="/js/parsley.min.js"></script>
    <script src="/js/parsley.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">
    <link href="css/bootstrap.css" rel="stylesheet" >


</head>

<body>

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
        <input type="text" class="form-control" required required name="name" id="name">
    </div>
    <div class="form-group">
        <label for="recipient-name" class="col-form-label">Officer Name:</label>
        <input type="text" class="form-control" required name="officer_name" id="officer_name">
    </div>
    <div class="form-group">
        <label for="recipient-name" class="col-form-label">Phone Number:</label>
        <input type="text" class="form-control" required name="tel" id="tel">
    </div>
    <div class="form-group">
        <label for="recipient-name" class="col-form-label">Fax:</label>
        <input type="text" class="form-control" required name="fax" id="fax">
    </div>
    <div class="form-group">
        <label for="recipient-name" class="col-form-label">Address:</label>
        <input type="text" class="form-control" name="address" required id="address">
    </div>

        <input type="submit">

</form>



<script>
    $(document).ready(function () {
        $('#formUpdatePost').parsley();
    });

</script>


</body>


</html>

