<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@300;500;700&display=swap" rel="stylesheet">

</head>

<body style="font-family: 'Signika Negative', sans-serif;">

    <?php
    $nonimage = "iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAflBMVEX///+qqqqmpqY0NDQ3NzcmJiarq6vKysr8/PykpKT19fXPz88qKiro6OiwsLDY2Nju7u64uLi+vr5NTU16enqQkJAwMDDV1dVqamqCgoJYWFiJiYlDQ0PExMS0tLQ7OzthYWFJSUlvb2+Xl5dlZWUfHx8QEBBTU1MAAAAgICCMBqY5AAAPi0lEQVR4nO1diXqquhoVkzJEQgAVigKpQ3fvef8XvBmZREUFBdv1fWd7rBCy8o/5E2A2+8Mf/vCHt4GNfB9r+D6yX92h3oAwWWSBZ5qGMS9hGKbpBdmCYPTqDj4AGxMrV3zOQPyaZwRPT6IIW7lT5zavo07U8SwyHWna2PKcggInY3p5EFqLmBDCjJD9Gy+sMMg905hXjmMspyBLFIeG7jX79AKL4HNuhTkfpshhXj0hHLcoEQmMorNeGONOHtNGOA69kmUwVpI21vSYvmXEv03hbJ9kTLfl+UYwQnX1LVPTC+Ib2WnYfhxokqbl99zDx4ADqWRzJ39QxWyiSDJtxT317nEQz5F9epSehE1yNV4m6aG5h2ETc967Xmmdn5vxqw3SJp7sSkD67QrTVtmw13PDN0Lym8/DIUwGh0JZGccBGu/YBTXM2VBuz8/kBfLX+ByUDcyPQ3MMX5AExCK8O+HQYcsPhaM2FgNf5+S6uTSRZ6iPulb+1BTAcp4arojUF+tJl2ODKj2o9Tw3bltSZZ4kxnj+Av+GparGT7gUCoV3Wzw7Dtvxk5wq5unUk61eQXicuTmw7sTS5F+USEkHN2jckBr6ulkNFsYYDtY+8oSGvrLGgHiiOPcG6oJvihgxTOOdIeKGOYgfwCJ5ev2clBgDWQp5sQmWwEKXeh9q4USflVNcAfIGCP4LbuDBqysKGrbwN71GDW7eAzrp28HDVp9OTxDM+muvB2S9UlyMj6Ci2JOixj1rRE8QitWLuyFjlCCHkGIPQQOPlaCi+HCE9odNdR+DmAg8GKMRzx+CfvozAAKeoz6WhvPswRtLoD+FLfr3SAtcDR4co2HBdewRIxLJ6BiS7fPAD6WouCd3PCjIAw5VaMD4In0T1v2WxI0w77k7QyC41xRFsjZmL6OB7kzffHaeM24vo4EdRvH2wO9NwggluCneHBWtiRihRH67OPz7BP8q8OzZua27+dDV856xuFXluB/Nx5uOnsLOb/OnyOhj4vVUiBWN7rEtm5Af1WCusftEXYzHlHSUw75F7/IJJNyn4Cl4x7k6mVQoLOF1FQyfN08kXauDJ2+d6hFchGMtPV1G2E2IXIQTymaq4JOFDkLkIhxnefQ6sk5CNCcrQilE89pB5JbAOTpk8+tCnK4VcvjXJ4rc407TkUqEVyNdMLmUuw58LbHxu2c+I0VwxcqsDpY6bnBPeWFaZLNQYU5tUlHHFQr48gBMAlwNz3uSa0o8BfiX0mpevJjitKmO/EI5g0zez3BcYsGU1Jm2n+FAztmIh0a9ZN8dwVk1jd9CSS+pafgWSirVtNWb2m+ipFJN20TFw/0zbkkZHvGZoM+SgRuXb8YK32lPzbxR7w26BbyY1jIP5vY53fJFHRnzmafx4j0SGol2Ljwnfw8zFNl3iyHmD5ohyYLQ6nFzCrbCIFzc1yA3xJMphN2tBHX4dqNC0u6/4gwjdd2PD9fdnyhH8I+Kz/yf+70t/rr4dj825cXTj2+j3pv0Q7TnfqlbILbsBIV/ztVutiUvHaOhQ1O61l9SoFyTv4nofp4F6x/gzpsXA0vxGcA03RWDs6Jp+lkcY7HfNpVzSBqleyfMvGQJolSctKa7jcLy+gyvLSKSi1PjKsMU6OM0Q7SEX1J29pxGDYolw90S6JzJT9MfWjJc0U1Ky/GNYZSoa9jh5lv87xoUA9sBuMXVZN2WwR24/6Qr9UUz3MNNIZwcuvWmC4bg6wA1KROmRvFlhlNgbWChwv4SHMrzUaIYlip+HXya1Ax9HR2NAxILRmq4FcM4qoz/bAW/amdUGBIAFPsveMhBwdCEdJaDpR6lA6i3ILp1G8M2V9Nx0dABq9mRqh4ohiu4rxxBKKgJsWS4YcSkqjE1xF7B0OZ/RkCrMFpGLZnHbQxFxan+F9SxysYZxlBpp2Ro70BtbDaw5harDA2YCoFsmZzNgiEBERuTRI/TIqIt5nIjQx7d6620mWYbOEPmGGSnJUNCYc1FbeGq+rXK0E/FYLCPoMJwC48zTkw1My/Vt4IbGZ46zo6uVDLEQIpJMlxAWDNgA1Qdf43hLBEK7oEUlQxRCrjJ2Bt4UFySlguvKb0hHrZIjO8L65KzCYazNRSRTTK0AKwdEoCf6tcawwV0sbS7kmEAZMSbwx+hV9syLvgCSDJcHr8kNh0qnv7Jvrys415pyRBRMd7tDPMLDJmg1jMScV9UMPxUcQLTyGowhP+xvOZD/HxbPBR71Ov+KuiYlUqGTBNTrBnGENbGxqmHixpD5msoszvOTTPEEVXqlEgDPoDCjrdJkmxkDnWjHfJwUS/JtKWqbVAM7SVNNEPcCA8rWLOjOkOfUk/anWZ4oOnxU+AnBVxdPfBVHWslvBsZivhe+4PZsQqlGM7CCBIdD5ewtjugzM3kkTWGIiEVRqwZ0jRSHsSlwoGxvKDqEbb3MQwaexbsE7U9A81w9kX3muEBVp0nS3lqLqvB0AIpFX1VDC2h7xJryA+1v0A1oN7JMGwssqGu2y0LhgsQxUvJ0I9gqRDMl9SdfYPhbJdKu1MMP2mZEBEq8sEAwMoY3cmQ71OvuodT53oGBUOmbsedym2ciBYnJ7CRkTQZakiGPoAV3TnK0alm8vcybIY/v2uttGRI+DxK9S6JqChE2uQT0EY7lxnO4a6iS7l0y/4XSD3x/EzbzzZARYvE1+iSmsSNokzXpG12cEtXDqirx/8A2RQ4WW2iaNNsJnR3kqFbC5Mzw+W52jKqTJSYp42ER0fbyKXHVbI6Ujf6jCVDqHOaj/916GgzSevMMEyKlB1vt0khL7LewA833QcnaUOcyFC9SOohO0sYN5wkNYE4iSJMDl/U/Yh2nwfVrXxboi2ra+JuhufBn0je511Sor37G2xjOOWNQqdoMvpjOD20MXyXkr7EAJ5mZPh9DDvnNJNBM6fpnJdOBs28tPPcYjJozi34/HDKm59P0Zwfdp7jTwbNOX7nOs1kcFKn6Vprm5lJIs/0k1XN+5orNUXdJqvSaeGVnG2RVa0QLuEkSak4aJUIbA/FSnLjJKKO4KjOudpwWmvrWi9FKaVy7WF2jKrXRz+RLEXHgFbK+rH7n/hcqM8qfNbWrmzgg8pVXjf6UdNOy42qx1tuUfb+rs+mW/p5UnjqWvPOQDGzD2CEqj+oAtSWzf3L4lIMXNm++qwih2kaFeJGESCIT+DDI4xk9tGoNVuA2nqaf00ap+Gv67rFniaJqh2hHaiY7koJDi2hl5arT5cYHuF6X6y2MoaRXvf9VMvDJwzrxfVLOE3SOqZt2AULC7haWmVdAlMl2RBE9gEWNd0LDHlxP4RAS6NkOGN/FZ8PMDyVWMf1QwdubPsHSosjEJLyB1VR+oTJDEdAO6ELDNdsHFBaFCIrDC0Qqc+7GZ6uH3ZcAxYrMgeo/MNPsfZeLI1hyi3rWPxwnqEtKtzboppcYbhWKx8PMDxdA+62jm9FFIt1bGnEHtypcYojtUHjALnm6gWzSwxDUewmQK/LMIbyHJTrGt79DNvW8TvtxVhJF3CkieoUVHLfqiVqJDVYLPIKnGd4lE7mRy3ts8bS/Yph/wOOQSslC6TJSuHKUhvfi9E0ui7O1KeSUQCViFbarVLFiPUJS8afVxjiCIoumGCJNMNIhkN4jM8x7BoP2xxnlz1RptpoYEMoVUBqLV8UVbuddMyIgTKqswwduLQlMaUHIh4y+PEBquThNB7OkMblnrbtieqyr22jNUq7gtlOOpiNXE6a+QAo3Tgqz3OW4U455GIPRsXTECp3Hd1vh62b8q+7mhjStWcyeGuq4oQj1t5JBKX45zB1THHEPqUXGVowPcgjt1TqQYXhbCs3K9zNsHVvYof9pawvrl7LVNv3sBDaWrv8nxSqIyK9X+oMw1W1rUOTYSBXc+5m2L6/9OoeYX8JD/FCgJmK8g/C8KjK0uIoDRbqiL10u2cY+imc67bWdGM3GIZg9xDDdrd5dZ93AIoMixucNNoMUJ/9J5tLys14swyK3O4MQ1PlZRxSD2oMlZ3fzbB9n/fVvfr76uKu3suGliDX6bMdwVL57aVwJWcY6g1ulYYrDP0dEG7oXoZn9upfu98Cw6gyHbH0Hq01/UmVAy0zGY6DWJRvZ0j0/EggFKvaRU7jZxtK7RZKnRmeu9/iSkRk+VhFwvYP0Ok3mw7Kv9VX8AnkuV3JMF0q7D4r2SgH0wM24shVR6RR9IMVpfKkfe3rkl5yGefumbl83xNK3dp2soOrJhNHoJZxievWBmjDl4vjj2/J8AMChWiD6EdNidYuEzf6lkfQZaLdgVU56av2FXxfYnjuvqf3v3ftbe4pOc/j/e8hFfcBT+GBpZdxXknfRU0vsXj/+/Hf/5kKv+C5GO//bJP3fz7NL3jG0Ps/J+oXPOvr/Z/X9gueuff+z038Bc++fP/nl77/M2h/wXOE3/9Z0DKxmV52esPzvH/BM9lF4JzaPPGm5+r/gncjvP/7LX7BO0rEe2YefbPgE3HHe2am9a4g+65XN739+55+wTu75MsPp7CMce9716bz7rz87tdYTuT9h9kDbxJ9+3dY/oL3kE7hXbIPv5D57d8H/Ave6fz+7+VWDnWcFPt5t7pyx2OsEWe9BTPx2tzxRX7r7mTtFIsxSlFIsLdJujU+W8x6VqzRUQx7txyhqMFYQr8d9KqiEiJF9cZRuUHeg8loO3jQGEcajnmeNcSch2fxhvH6yRQxBhtqX4zdq6MGd3qGOZC5II8beP7K2RTKeRe84bogUt0XrmiI1Ylhw5ZwqY71orBh8Ur80KsN2BRq8oqw4QsNNQfXICQ01Vg8W4z2QmroM7yA0NR5/lxrxPl8kDDfDt8TV3uiNdoiRjzTOKTJPy38E0M6uCddTsCXSuM9Q1WVgubP9m6xHNdw6Ov6oSPStBc8igxlwqnOsyE5+voir0mkcDAwR80veF0WRXLZhXCILuBwLo39pfMZm3hqmEm/scMmSkG8nhu+pyum7IrZo7L6lm705fwEiCfc3Xyekz4cgs10X/Probl+wHyO7JPzKEmmnY5s6pX+pQ1arxjJIPbvUy3bjxU9Jj5rHFWvKmwcGJqkmZEbWdo+yTxNzwjxKMzvFIiEiiRTMi+MMerSURvhOPTm+kQj6MWaB4MgWbA0vMAi2D9D1EY+JlaQV08Ix01PwsYW0zfVadbruWF6eRBai5gQgjFm/8YLKwxyzxS/6uMczxqrcrYAYSt3yu4rqlUYtZ+c3JqC8BqwmQrmJ2yMOjWGPCMTkt0pECaLLPBMsyZFwzBNL8gWBE9PcufA3wSANfxzzucPf/jDHyaJ/wOGieZcVqoZuQAAAABJRU5ErkJggg==";



    $qrcode = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHsAAAB7AQAAAAB8vMLSAAAACXBIWXMAAAsSAAALEgHS3X78AAAB40lEQVRIx5WVMY7EIAxFHVHQTS6AxDXouNLkApPkAsmV6LgGUi4QOgo03u9ot8YbpUBPAr7Nt01Elu/g5uY3cvR8I+A594X7ktzMfWUNcFN2FHhvvAX3tkpAa3Yv3PkPYO7oT2bcrwNQ6uZcPtEc9k/6ACAfbsm//2+CBgDXeaQQiawZ66IAWPa1XbVduJasBnRo5EZzojVdeyIF4MPyQb6yx+ImDcAZZWGaG7CbmgZcNRWkBBh6z6wB9InyqgubIyLEogBXzX4LkoyJSd5WARj54w4fQe8kZwwBf/HHPmdzEE4iBXBrKzPii2az9CYNMDXxiQNimfixwxhAYH8Tsii5X1SAKywQ+CspMZxUYAtdXtia2z4FNAaoG39HPpPZmaFXAdBvLs4MxtnvcNAYlA/JK00ZSssCpWPgt9gpXkfwNRlxkAJ8raPoa+4v21FGCsDYfeByKE04rGjALVYtb2lUiJIUAO0ZvnMrI8oiNTcG/ov4grmlRhFi0YDKTuzW4CNzB1IAJ0bAtcm9AnJfFADbZW7IwIEvLCmAzKja+pL5ZLdIdxgC9HVpaRg4O0O1BjzTw/YXofJoSkqArSwzJ19fIh1AqaHvmjMVqdcxkHkLr8EOOxpV0wDkw+9o0pkesQrwA71DzAGha0sdAAAAAElFTkSuQmCC";





   

    if(isset($data->surname)){
        if(is_object($data->surname)){
            $surname = "***";
        }else{
            $surname = $data->surname;
        }
    }else{
        $surname = "***";
    }



    if(isset($data->firstname)){
        if(is_object($data->firstname)){
            $firstname = "***";
        }else{
            $firstname = $data->firstname;
        }
    }else{
        $firstname = "***";
    }
    
    
    if(isset($data->middlename)){
        if(is_object($data->middlename)){
            $middlename = "***";
        }else{
            $middlename = $data->middlename;
        }
    }else{
        $middlename = "***";
    }
    
    if(isset($data->birthdate)){
        if(is_object($data->birthdate)){
            $birthdate = "***-**-***";
        }else{
            $birthdate = $data->birthdate;
        }
    }else{
        $birthdate = "***";
    }
       
    if(isset($data->gender)){
        if(is_object($data->gender)){
            $gender = "***";
        }else{
            $gender = strtoupper($data->gender);
        }
    }else{
        $gender = "***";
    }


    //dd($gender);
    
    if(isset($data->nin)){
        if(is_object($data->nin)){
            $nin = "***";
        }else{
            $nin = strtoupper($data->nin);
        }
    }else{
        $nin = "***********";
    }
       
       
       
       


    $year = $birthdate;
    $fr_month = explode("-",$year);





    $first_nin = substr($nin, 0, 4);
    $second_nin = substr($nin, 4, 3);
    $third_nin = substr($nin, 7, 4);


    $month['01'] = "JAN";
    $month['02'] = "FEB";
    $month['03'] = "MAR";
    $month['04'] = "APR";
    $month['05'] = "MAY";
    $month['06'] = "JUN";
    $month['07'] = "JUL";
    $month['08'] = "AUG";
    $month['09'] = "SEP";
    $month['10'] = "OCT";
    $month['11'] = "NOV";
    $month['12'] = "DEC";


    $day = date('d',time());
    $mtn = date('m',time());
    $yr = date('Y',time());

       // dd($month[$mtn]);




    function url2(){
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        return $protocol . "://" . $_SERVER['HTTP_HOST'];
    }



   // dd(url2())

    ?>












    <style>
        .rotate1 {
            writing-mode: vertical-lr;
            -webkit-transform: rotate(-40deg);
            -moz-transform: rotate(-40deg);
            color:#a7b1a1;
            position: absolute;
            margin-top:160px;
            margin-left:15px;
            font-size: 13px;
            letter-spacing: 1px;
        }


        .rotate2 {
            writing-mode: vertical-lr;
            -webkit-transform: rotate(-35deg);
            -moz-transform: rotate(-35deg);
            color:#a7b1a1;
            position: absolute;
            margin-top:210px;
            margin-left:8px;
            font-size: 13px;
            letter-spacing: 1px;

        }


        .rotate3 {
            writing-mode: vertical-lr;
            -webkit-transform: rotate(35deg);
            -moz-transform: rotate(35deg);
            color:#a7b1a1;
            position: absolute;
            margin-top:210px;
            margin-left:345px;
            font-size: 13px;


        }



        .rotate4 {
            writing-mode: vertical-lr;
            -webkit-transform: rotate(-180deg);
            -moz-transform: rotate(-180deg);
            color:#a7b1a1;
            position: absolute;
            margin-top:10px;
            margin-left:315px;
            font-size: 13px;
            letter-spacing: 2px;

        }


    </style>
<div class="id-card-tag" style="width:430px">




    <div style="position: absolute">
        @if(is_object($data->photo))

            <img src="data:image/png;base64, {{$nonimage}}" style="width:90px;margin-top: 55px;margin-left: 10px">
        @else
            <img src="data:image/png;base64, {{$data->photo}}" style="width:90px;margin-top: 55px;margin-left: 10px">
        @endif

    </div>
    <div  id="flip" class="rotate1">
        {{$nin}}
    </div>
    <div  id="flip2" class="rotate2">
        {{$nin}}
    </div>

    <div  id="flip3" class="rotate3">
        {{$nin}}
    </div>

    <div  id="flip4" class="rotate4">
        {{$nin}}
    </div>

    <div style="position: absolute;margin-top:5px;">

        <div style="margin-left: 120px;margin-top: 55px">
            <div>
                <div style="font-size: 11px;font-weight: bold;color:#646262">SURNAME/NOM</div>
                <div style="font-size: 13px;color:black;letter-spacing: 2px;font-family: 'Signika Negative', sans-serif;font-weight:lighter">  {{$surname}}</div>
            </div>

            <div style="margin-top: 12px">
                <div style="font-size: 11px;font-weight: bold;color:#646262">GIVEN NAMES/PRENOMS</div>
                <div style="font-family: 'Signika Negative', sans-serif;font-size: 12px;color:black;letter-spacing: 2px;width: 400px;font-weight: 500">{{$middlename}},  {{$firstname}}</div>
            </div>

            <div style="margin-top: 12px">
                <div style="font-size: 11px;font-weight: bold;color:#646262">DATE OF BIRTH</div>
                <div style="font-size: 12px;color:black;letter-spacing: 2px;width:100%">{{$fr_month[0]}} {{$month[$fr_month[01]]}} {{$fr_month[2]}}</div>
            </div>


        </div>



    </div>

    <div style="margin-top: 145px;margin-left: 230px;position: absolute;">
        <div style="font-size: 11px;font-weight: bold;color:#646262">SEX/SEXE</div>
        <div style="font-size: 12px;color:black;letter-spacing: 2px;">{{$gender}}</div>
    </div>


    <div style="margin-top: 200px;margin-left: 100px;position: absolute;width:100%">
        <div style="font-size: 13px;font-weight: bold;color:#000000; letter-spacing: 1px">National Identification Number (NIN)</div>

    </div>

    <div style="margin-top: 214px;margin-left: 63px;position: absolute;width:100%;">

        <div style="font-family: 'Signika Negative', sans-serif;font-size: 30px;margin-top: 0px;color:black;letter-spacing: 6px;font-weight: lighter">{{$first_nin}}&nbsp;&nbsp; {{$second_nin}}&nbsp;&nbsp; {{$third_nin}}</div>
    </div>

    <div style="margin-top: 133px;margin-left: 345px;position: absolute;color:black;">
        <div style="font-family: 'Signika Negative', sans-serif;font-size: 20px;font-weight: bold;color:#000000">NGA</div>
    </div>

    <div style="margin-top: 158px;margin-left: 335px;position: absolute;color:black;">
        <div style="font-size: 12px;font-weight: bold;color:#000000">ISSUE DATE</div>
    </div>

    <div style="margin-top: 172px;margin-left: 320px;position: absolute;color:black; width: 100%;">
        <div style="font-size: 12px;letter-spacing:1px;color:#000000">{{$day}}&nbsp;&nbsp; {{$month[$mtn]}}&nbsp;&nbsp; {{$yr}} </div>
    </div>


    <div style="position: absolute">
        <img src="{{$qrcode}}" style="margin-top: 22px;margin-left: 312px;width:108px;height:105px">
    </div>

    <img src="{{url2()}}/image-000.jpg" style="width: 100%;">
</div>
<div class="id-card-tag-strip"></div>
<div class="id-card-hook"></div>
<div class="id-card-holder">
    
</div>

</body>
</html>