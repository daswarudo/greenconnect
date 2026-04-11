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
                <h1>Share Your Experience</h1>
            </div>

            <h2>
                Enjoying our services?<br>Your testimony is greatly appreciated! &#x2661;&#x2661;&#x2661;
            </h2>

            <div class="feedback-box">
                <a href="/customerFeedbackAdd">
                    <button>Add Testimonials</button>
                </a>
                <div style="margin-bottom:3vh;"></div>

                <!-- User Feedback Table -->
                @if ($feedbacks->isEmpty())
                    <p>You have not submitted any feedback yet.</p>
                @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Feedback</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $index => $feedback)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $feedback->feedback }}</td>
                                    <td>
                                        <form action="{{ route('feedback.delete', $feedback->feedback_id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure about that?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <br><br>

            <!-- Display All Testimonials -->
            <h2>What Others Are Saying</h2>
            <div class="testimonial-box">
                @if ($testimonials->isEmpty())
                    <p>No testimonials available yet.</p>
                @else
                    @foreach ($testimonials as $testimonial)
                        <div class="testimonial-card">
                            <div class="testimonial-header">
                                <img src="{{ asset('images/freepik1-min.jpg') }}" alt="Profile Picture" class="profile-pic">
                                <div class="testimonial-user">
                                    <p class="username">
                                        {{ optional($testimonial->customer)->first_name ?? 'Anonymous' }} 
                                        {{ optional($testimonial->customer)->last_name ?? '' }}
                                    </p>
                                </div>
                            </div>
                            <p class="testimonial-text"><em>"{{ $testimonial->feedback }}"</em></p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
</body>
</html>
