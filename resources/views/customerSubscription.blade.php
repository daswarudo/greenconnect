
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
   
   <div class="subscription-info" style="margin-top:5vh;">
    <h2>Subscriptions</h2>
   {{--@foreach($subscriptions as $subscription)
    <div>
        <p>Subscription ID: {{ $subscription->subscription_id }}</p>
        <p>Start Date: {{ $subscription->start_date }}</p>
        <p>End Date: {{ $subscription->end_date }}</p>
        <p>Payment Method: {{ $subscription->mop }}</p>
        <p>Reference Number: {{ $subscription->ref_number }}</p>
        <p>Status: {{ $subscription->sub_status }}</p>
        <p>Plan Name: {{ $subscription->plan_name }}</p> <!-- Accessing plan_name -->
    </div>
@endforeach--}}


    <table>
    
     <tr>
      <th>
       Subscription:
      </th>
      <th>
       Status:
      </th>
      <th>
       Start Date: 
      </th>
      <th>
       End Date:
      </th>
     </tr>
     @foreach($subscriptions as $subscription)
     <tr>
     
      <td>
      {{ $subscription->plan_name }}
      </td>
      <td>
      {{ $subscription->sub_status }}
      </td>
      <td>
      {{ $subscription->start_date }}
      </td>
      <td>
      {{ $subscription->end_date }}
      </td>
     </tr>
     @endforeach
    </table>
    
    
   </div>
  </div>
</body>
</html>