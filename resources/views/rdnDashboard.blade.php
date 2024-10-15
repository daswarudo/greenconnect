
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">   ==>login css-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/rdnDash.css') }}">
<!-- naa sa public/css folder ang css, ignore css sa resources sdfasfda-->
    
</head>
<body>

<div class="sidebar">
	<img alt="Green Chef Logo" height="100" src="https://storage.googleapis.com/a1aa/image/5ZVSiXJk97ooLNVVlietIe85bAyorQ641AarmzfLZ1jPFJHnA.jpg" width="100" />
   <a href="#">
    <i class="fas fa-users">
    </i>
    Subscribers
   </a>
   <a href="#">
    <i class="fas fa-calendar-alt">
    </i>
    Appointments
   </a>
   <a href="#">
    <i class="fas fa-utensils">
    </i>
    Meal Plans
   </a>
   <a href="#">
    <i class="fas fa-sign-out-alt">
    </i>
    Log Out
   </a>
  </div>
  <div class="content">
   <div class="header">
    <h1>
     WELCOME, RDN
    </h1>
    <i class="fas fa-user-circle">
    </i>
   </div>
   <div class="dashboard">
    <h2>
     GreenConnect Dashboard
    </h2>
    <h3>
     Pending Customers:
    </h3>
    <table>
     <tr>
      <th>
       Name
      </th>
      <th>
       Subscription Plan
      </th>
      <th>
       Mode of Payment
      </th>
      <th>
       Reference Number
      </th>
      <th>
       Status
      </th>
     </tr>
     <tr>
      <td>
       Lyka Monroe
      </td>
      <td>
       Weight Loss
      </td>
      <td>
       GCASH
      </td>
      <td>
       3019229110542
      </td>
      <td class="status">
       PENDING
      </td>
     </tr>
    </table>
   </div>
   <div class="widgets">
    <div class="widget">
     <h3>
      Subscribers
     </h3>
     <p>
      Manage your subscriber list
     </p>
     <table>
      <tr>
       <th>
        Name
       </th>
       <th>
        Subscription
       </th>
      </tr>
      <tr>
       <td>
        Peter Griffin
       </td>
       <td>
        Weight Loss
       </td>
      </tr>
      <tr>
       <td>
        Bart Strong
       </td>
       <td>
        Weight Gain
       </td>
      </tr>
     </table>
    </div>
    <div class="widget calendar">
     <h3>
      Appointments
     </h3>
     <p>
      View your upcoming appointments
     </p>
     <table>
      <tr>
       <th colspan="7">
        September
       </th>
      </tr>
      <tr>
       <th>
        SUN
       </th>
       <th>
        MON
       </th>
       <th>
        TUE
       </th>
       <th>
        WED
       </th>
       <th>
        THU
       </th>
       <th>
        FRI
       </th>
       <th>
        SAT
       </th>
      </tr>
      <tr>
       <td>
        1
       </td>
       <td>
        2
       </td>
       <td>
        3
       </td>
       <td>
        4
       </td>
       <td>
        5
       </td>
       <td>
        6
       </td>
       <td>
        7
       </td>
      </tr>
      <tr>
       <td>
        8
       </td>
       <td>
        9
       </td>
       <td>
        10
       </td>
       <td>
        11
       </td>
       <td>
        12
       </td>
       <td>
        13
       </td>
       <td>
        14
       </td>
      </tr>
      <tr>
       <td>
        15
       </td>
       <td>
        16
       </td>
       <td>
        17
       </td>
       <td>
        18
       </td>
       <td>
        19
       </td>
       <td>
        20
       </td>
       <td>
        21
       </td>
      </tr>
      <tr>
       <td>
        22
       </td>
       <td>
        23
       </td>
       <td>
        24
       </td>
       <td>
        25
       </td>
       <td>
        26
       </td>
       <td>
        27
       </td>
       <td>
        28
       </td>
      </tr>
      <tr>
       <td>
        29
       </td>
       <td>
        30
       </td>
       <td>
        1
       </td>
       <td>
        2
       </td>
       <td>
        3
       </td>
       <td>
        4
       </td>
       <td>
        5
       </td>
      </tr>
     </table>
    </div>
   </div>
  </div>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
