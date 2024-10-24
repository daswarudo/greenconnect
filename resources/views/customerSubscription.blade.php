<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenConnect</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/customerSubscription.css') }}">
</head>
<body>
        @include('customerSidebar')

<div class="content">
   <h1>
    WELCOME, SUBSCRIBER
   </h1>
   <div class="subscription-info">
    <p>
     Active Subscription Plan : <span> Weight Loss </span>  <!--Weight Loss DRI GURO I ANG DATA SA Subscription ID= SUBSRIPTION NAME   -->      
    </p>
    <table>
     <tr>
      <th>
       Subscription:
      </th>
      <th>
       Start Date: 
      </th>
      <th>
       End Date:
      </th>
     </tr>
     <tr>
      <td>
        <!--SUBSCRIPTION NAME of PREVIOUS SUBSCRIPTION --> Weight Loss 
      </td>
      <td>
       <!-- START DATE-->                                  10-7-2024
      </td>
      <td>
       <!-- END DATE -->                                   10-14-2024
      </td>
     </tr>
    </table>
    <h2>
     Subscription History
    </h2>
    <table>
     <tr>
      <th>
       Subscription Name
      </th>
      <th>
       Start of Subscription
      </th>
      <th>
       End of Subscription
      </th>
     </tr>
     <tr>
      <td>
      </td>
      <td>
      </td>
      <td>
      </td>
     </tr>
    </table>
   </div>
  </div>
</body>
</html>