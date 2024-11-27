
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

    <a href="/customerSubscriptionAdd">
        <button type="submit">
            ADD
        </button>
    </a>
    
   </div>
  </div>
</body>
</html>