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
        <!--
     WELCOME, 
        @if($userType == 'customer')
            <p>Customer {{ $customer->first_name }}! Your ID is: {{ $loginId }}</p>
        @endif
-->
    </h1>
       </div>
       <div class="table-container">
      

        
        
        </div>
        <div class="container">
        <h2>Add a New Consultation</h2>

        <!-- Show success message if consultation is added -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Consultation Form -->
        <form action="{{ route('consultation.store') }}" method="POST">
            @csrf

            <!-- Hidden Customer ID (logged-in customer) -->
            <input type="hidden" name="customer_id" value="{{ $customer->customer_id }}">

            <!-- RDN ID (auto-filled, as there's only one RDN) -->
            <input type="hidden" name="rdn_id" value="{{ $rdnId }}">

            <!-- Date Input -->
            <div class="form-group">
                <label for="date">Consultation Date</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>

            <!-- Time Input -->
            <div class="form-group" style="margin-bottom:2vh;">
                <label for="time">Consultation Time</label>
                <input type="time" name="time" id="time" class="form-control" required>
                
            </div>

            <!-- Submit Button -->
            <button style="width:30vh;" class="crudButtons" type="submit" class="btn btn-success" onclick="return confirm('Are you sure about that?')">Add Consultation</button>
        </form>
    </div>
</body>
</html>

