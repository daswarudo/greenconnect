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
     WELCOME, SUBSCRIBER
    </h1>
   
   </div>
   <h2>
    Do you have any feedback for Green Chef?
    <br/>
    Mind sharing them?
   </h2>
   @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
   <form action="{{ route('addFeedback') }}" method="POST">
    @csrf
      <div class="feedback-box">
        <textarea placeholder="Do you like what you have experienced so far, do you mind sharing it to the public?" name="feedback" id="feedback" class="form-control" ></textarea>
        <button>
        Post
        </button>
      </div>
  </form>
  </div>
</body>
</html>