<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenConnect</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/customerDash.css') }}">
    </head>
    <body>
        @include('customerSidebar')
    <div class="content">
        <div class="header">
    <h1>
    WELCOME, 
        @if($userType == 'customer')
            <p>Customer {{ $customer->first_name }} {{ $customer->last_name }}!</p>
        
    </h1>
       </div>
       <div class="table-container">
      
       <a href="{{ route('consultation.create') }}" class="btn btn-primary">Add Consultation</a>
        </div>
        @endif
</body>
</html>

