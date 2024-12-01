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
   <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Meal ID</th>
                <th>Meal Name</th>
                <th>Plan Name</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @foreach ($details as $detail)
                <tr>
                    <td>{{ $detail->meal_id }}</td>
                    <td>{{ $detail->meal_name }}</td>
                    <td>{{ $detail->plan_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

   </div>
  </div>
</body>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tableBody tr');

        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
</html>