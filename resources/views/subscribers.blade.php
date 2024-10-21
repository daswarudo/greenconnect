
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribers</title>

    
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">   ==>login css-->
	<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js'></script>

    <!-- temporary-->
	<script> 
        
    </script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/rdnDash.css') }}">
<!-- naa sa public/css folder ang css, ignore css sa resources sdfasfda-->
    
</head>
<body>
    @include('sidebar')

    <div class="content">
   <div class="header">
    <h1>
     WELCOME, RDN
    
   </div>
   <div class="tabs">
    <button class="active">
     Weight Loss
    </button>
    <button>
     Weight Gain
    </button>
    <button>
     Therapeutic
    </button>
    <button>
     Gluten Free
    </button>
   </div>
   <h2>
    List of Subscribers
   </h2>
   <table>
    <tr>
     <th>
      First Name
     </th>
     <th>
      Last Name
     </th>
     <th>
      Sex
     </th>
     <th>
      Age
     </th>
     <th>
      Height(cm)
     </th>
     <th>
      Weight(kg)
     </th>
     <th>
      Address
     </th>
     <th>
      Contact Number
     </th>
     <th>
      Allergy
     </th>
    <th>
     Food Preference
     </th>
    </tr>
    <tr> <!--FOR DATA ROWS-->
     <td>
      <!--FIRSTNAME-->
     </td>
     <td>
      <!--Last nAME-->
     </td>
     <td>
      <!--SEX-->
     </td>
     <td>
      <!--AGE-->
     </td>
     <td>
      <!--Height-->
     </td>
     <td>
      <!--Weight-->
     </td>
     <td>
      <!--Address-->
     </td>
     <td>
      <!--Contact Number-->
     </td>
     <td>
      <!--ALLERGY-->
     </td>
     <td>
        <!--Food Preference-->
    </td>
    </tr>
    
     
   </table>
  </div>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
