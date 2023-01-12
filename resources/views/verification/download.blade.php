<html>
<head>

    <style>
        body {
            background-color: #d7d6d3;
            font-family:'verdana';
        }
        .id-card-holder {
            width: 325px;
            padding: 4px;
            margin: 0 auto;
            background-color: #1f1f1f;
            border-radius: 5px;
            position: relative;
        }
        .id-card-holder:after {
            content: '';
            width: 7px;
            display: block;
            background-color: #0a0a0a;
            height: 200px;
            position: absolute;
            top: 205px;
            border-radius: 0 5px 5px 0;
        }
        .id-card-holder:before {
            content: '';
            width: 7px;
            display: block;
            background-color: #0a0a0a;
            height: 200px;
            position: absolute;
            top: 205px;
            left: 322px;
            border-radius: 5px 0 0 5px;
        }
        .id-card {

            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 1.5px 0px #b9b9b9;
        }
        .id-card img {
            margin: 0 auto;
        }
        .header img {
            width: 200px;
            margin-top: 15px;
        }


        .photo img {
            width: 180px;
            margin-top: 15px;
        }
        h2 {
            font-size: 15px;
            margin: 5px 0;
        }
        h3 {
            font-size: 12px;
            margin: 2.5px 0;
            font-weight: 300;
        }
        .qr-code img {
            width: 150px;
        }
        p {
            font-size: 5px;
            margin: 2px;
        }
        .id-card-hook {
            background-color: #000;
            width: 170px;
            margin: 0 auto;
            height: 15px;
            border-radius: 5px 5px 0 0;
        }
        .id-card-hook:after {
            content: '';
            background-color: #d7d6d3;
            width: 147px;
            height: 6px;
            display: block;
            margin: 0px auto;
            position: relative;
            top: 6px;
            border-radius: 4px;
        }
        .id-card-tag-strip {
            width: 145px;
            height: 140px;
            background-color: #0950ef;
            margin: 0 auto;
            border-radius: 5px;
            position: relative;
            top: 9px;
            z-index: 1;
            border: 1px solid #0041ad;
        }
        .id-card-tag-strip:after {
            content: '';
            display: block;
            width: 100%;
            height: 1px;
            background-color: #c1c1c1;
            position: relative;
            top: 10px;
        }
        .id-card-tag {
            width: 0;
            height: 0;
            border-left: 100px solid transparent;
            border-right: 100px solid transparent;
            border-top: 100px solid #0958db;
            margin: -10px auto -30px auto;
        }
        .id-card-tag:after {
            content: '';
            display: block;
            width: 0;
            height: 0;
            border-left: 50px solid transparent;
            border-right: 50px solid transparent;
            border-top: 100px solid #d7d6d3;
            margin: -10px auto -30px auto;
            position: relative;
            top: -130px;
            left: -50px;
        }
    </style>

</head>

<div class="id-card-tag"></div>
<div class="id-card-tag-strip"></div>
<div class="id-card-hook"></div>
<div class="id-card-holder">
    <div class="id-card">
        <div class="header" style="height: 40px;">
            <h2>Easy Verify </h2>
        </div>
        <div class="photo">
            <img src="data:image/png;base64, {{$data->photo}}">
        </div>
        <br />
        <h2>@if(isset($data->surname)){{$data->surname}}@endif @if(isset($data->firstname)){{$data->firstname}}@endif <br />@if(isset($data->middlename)){{$data->middlename}}@endif</h2>
        <h3>NIN: {{$data->nin}}</h3>
        <h3>DOB: {{$data->birthdate}}</h3>
        <br />
        <h3>Tracking id: {{$data->trackingId}}</h3>
        <br />

        <h3>www.easyverify.ng</h3>
        <hr>
        <p><strong>Info:</strong>Property of the National Identity Management commission <p>


    </div>
</div>

</body>
</html>