<html>
<head>

    <?php
    $nonimage = "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"

    ?>

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
            @if(is_object($data->photo))

            <img src="data:image/png;base64, {{$nonimage}}">
                @else
                <img src="data:image/png;base64, {{$data->photo}}">
                @endif
        </div>
        <br />
        <h2> @if(is_object($data->surname))
                ***
            @else
                @if(isset($data->surname)){{$data->surname}}@endif
            @endif
            @if(is_object($data->firstname)) *** @else @if(isset($data->firstname)){{$data->firstname}}@endif @endif <br />@if(is_object($data->surname)) *** @else @if(isset($data->middlename)){{$data->middlename}}@endif @endif</h2>
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