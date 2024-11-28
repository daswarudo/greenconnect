<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenConnect</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/customerFeedback.css') }}">
</head>
<body>
        @include('customerSidebar')
        <div class="content">
   <div class="header">
    <h1>
     Meal Plans
    </h1>
   
   </div>
   <h2>
   
   </h2>
   <div class="feedback-box">
   <table class="table table-bordered">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Subscription ID</th>
                    <th>Plan Name</th>
                    <th>Meal ID</th>
                    <th>Meal Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                    <tr>
                        <td>{{ $detail->first_name }}</td>
                        <td>{{ $detail->last_name }}</td>
                        <td>{{ $detail->subscription_id }}</td>
                        <td>{{ $detail->plan_name }}</td>
                        <td>{{ $detail->meal_id }}</td>
                        <td>{{ $detail->meal_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

   </div>
  </div>
</body>
</html>