<html>
<head>

  <style>
    table{
      border: 2px solid black;
    }

    .td{
      border: 1px solid black;
      vertical-align: top;
      padding-bottom: 0px;
      margin-bottom: 0px;
    }

    .td{
      text-align: top;
    }

    #top{
      height: 60px;

    }

    #second{
      height: 200px;
    }

    #third{
      height: 60px;
    }

    #last{
      height: 80px;
    }

    tr{
      border: 1px solid black;
    }

    .title-div{
      height: 30px;
      border-bottom: 1px solid black;
      padding: 5px;
      margin-bottom: 0px;
      padding-bottom: 0px;
    }

    .title{
      width: calc(50% - 2px);
      margin-bottom: 0px;
      padding-bottom: 0px;
      font-size: 12px;
    }
    .value{
      width: calc(50% - 2px);
      margin-bottom: 0px;
      padding-bottom: 0px;
      font-size: 12px;
    }
  </style>

</head>

<body>

<table cellspacing="0">

  <colgroup>
    <col width="5%"><col width="5%">
    <col width="5%"><col width="5%">
    <col width="5%"><col width="5%">
    <col width="5%"><col width="5%">
    <col width="5%"><col width="5%">
    <col width="5%"><col width="5%">
    <col width="5%"><col width="5%">
    <col width="5%"><col width="5%">
    <col width="5%"><col width="5%">
    <col width="5%"><col width="5%">
  </colgroup>

  <tr>
    <td colspan="4">
      <img src="https://quickverify.ng/images/coat_of_arms.jpg" alt="" style="height: 60px; margin-top: 10px;" >
    </td>
    <td colspan="12" style="text-align: center; width: 90%;" >
      <h1 style="font-size: 30px; padding: 0px; margin: 0px; "><b>National Identity Management System</b></h1>
      <h3 style="font-size: 16px; padding: 0px; margin: 0px;"><b>Federal Republic of Nigeria</b></h3>
      <h3 style="font-size: 16px; padding: 0px; margin: 0px;"><b>National Identity Number Slip (NINS)</b></h3>
    </td>
    <td colspan="4" >
      <img src="https://quickverify.ng/images/nimc.png" alt="" style="height: 40px;" />
    </td>
  </tr>





  <tr>
    <td colspan="6" class="td" style="width: 25%;">
      <div class="title-div">
        <span class="title"><b>Tracking ID:</b></span> <span class="value">{{ $data->trackingId  }}</span>
      </div>
      <div class="title-div">
        <span class="title"><b>NIN:</b></span> <span class="value">{{ $data->nin }}</span>
      </div>
    </td>
    <td colspan="6" class="td" style="width: 25%;">
      <div class="title-div">
        <span class="title"><b>Surname:</b></span> <span class="value">{{$data->surname}}</span>
      </div>
      <div class="title-div">
        <span class="title"><b>First name:</b></span> <span class="value">{{$data->firstname}}</span>
      </div>
      <div class="title-div">
        <span class="title"><b>Middle name:</b></span>
        <span class="value">
              @isset($data->middlename)
            {{ $data->middlename }}
          @endisset
            </span>
      </div>
      <div class="title-div">
        <span class="title"><b>Gender:</b></span>
        <span class="value">
              @isset($data->gender)
            {{ ucfirst($data->gender) }}
          @endisset
            </span>
      </div>
    </td>
    <td colspan="5" class="td" style="width: 30%;">
      <div>
        <span class="title"><b>Address:</b></span><br><span class="value">{{$data->residence_AdressLine1}}</span>
      </div>
    </td>
    <td colspan="3" style="height: 120px; text-align: right; width: 20%;" class="td">
      <img src="data:image/png;base64, {{$data->photo}}" alt="" style="height: 150px;" />
    </td>
  </tr>
  <tr>
    <td colspan="20" class="td">
      <div>
        <span class="title"><b>Note:</b></span>&nbsp;<span class="value">The National Identification Number (NIN is your identity) It is confidential and may only be released for legitimate transactions</span>
      </div>
      <span class="value">You will be notified when your National Identity Card is ready (for any enquiries please contact)</span>
    </td>
  </tr>

  <tr>
    <td colspan="5" style="text-align: center; width: 15%" class="td">
      <div style="text-align: center;" style="text-align: center;">
        <img src="https://quickverify.ng/images/helpdesk.png" alt="" style="margin: 5px; width: 50px;" />
      </div>
      <span class="value">helpdesk@nimc.gov.ng</span>
    </td>
    <td colspan="4" style="text-align: center; width: 15%" class="td">
      <div style="text-align: center;" >
        <img src="https://quickverify.ng/images/website.png" alt="" style="margin: 5px; width: 50px;" />
      </div>
      <span class="value">www.nimc.gov.ng</span>
    </td>
    <td colspan="4" style="text-align: center; width: 15%" class="td">
      <div style="text-align: center;">
        <img src="https://quickverify.ng/images/call.png" alt="" style="margin: 5px; width: 50px;" />
      </div>
      <span class="value" style="font-size: 12px;">0700-CALL-NIMC</span><br>
      <span class="value" style="font-size: 12px;">0700-2255-646</span><br>
    </td>
    <td colspan="7" style="text-align: center; width: 55%;" class="td">
      <div style="text-align: center;">
        <img src="https://quickverify.ng/images/location.png" alt="" style="margin: 5px; width: 50px;" />
      </div>
      <span class="value">National Identity Management Commission</span><br>
      <span style="font-size: 12px;">11, Sokode Crescent, Off Databa Street, Zone 5 Wuse, Abuja Nigeria</span><br>
    </td>
  </tr>



</table>

</body>
</html>