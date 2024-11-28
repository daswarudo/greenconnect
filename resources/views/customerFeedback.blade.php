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
     
    </h1>
   
   </div>
   <h2>
    Enjoying our services?<br>Your feedback is greatly appreciated! &#x2661;&#x2661;&#x2661;
    
   </h2>
   <div class="feedback-box">
   <a href="/customerFeedbackAdd">
      <button>
        Add Feedback
      </button>
    </a>
    <div style="margin-bottom:3vh;"></div>
    @if ($feedbacks->isEmpty())
        <p>You have not submitted any feedback yet.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Feedback</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $index => $feedback)
                    <tr>
                        <td>{{ $index + 1 }}</td> <!-- Display row number -->
                        <td>{{ $feedback->feedback }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
   </div>
  </div>
</body>
</html>