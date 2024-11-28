
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
    <form action="{{ route('subscription.add') }}" method="POST">
    @csrf
    
    
   <div class="subscription-info" style="margin-top:5vh;">
    <form action="{{ route('subscription.add') }}" method="POST">
    @csrf
                    <div class="form-group">
                    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
                    @if(session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                     @endif
                       <h1>Add Subscription</h1>
                        <input name="customer_id" value="{{ $customer->customer_id }}" type="hidden">
                        <br>
                        <label for="subscription_type_id">Diet Plan <span> * </span> </label>
                        <select id="subscription_type_id" name="subscription_type_id" required><!-- query subs type-->
                            <option value="">Select Diet Program</option>
                            @foreach ($subscriptionTypes as $subscriptionType)
                                <option value="{{ $subscriptionType->subscription_type_id }}">
                                    {{ $subscriptionType->plan_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mop">Payment Option <span> * </span> </label>
                        <select id="mop" name="mop" required >
                            <option value="">Select Payment Option</option>
                            <option value="GCash">GCash</option>
                            <option value="Maya">Maya</option>
                            <option value="BPI">BPI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ref-number">Ref Number <span> * </span> </label>
                        <input id="ref_number" name="ref_number" type="text" placeholder="" required />
                    </div>
        <br>
        <button type="submit" onclick="return confirm('Are you sure about that')">
            ADD
        </button>
        </form>
    </div>
    </form>
</div>
</body>
</html>