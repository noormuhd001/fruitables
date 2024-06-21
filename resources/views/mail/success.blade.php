<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Email Confirmation</title>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">Hello, {{ $user->name }}</h1>
            </div>
            <div class="card-body">
                <p class="text-center">Verification successful!</p>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 library for a nice success message -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // Trigger SweetAlert success notification
        Swal.fire({
            icon: 'success',
            title: 'Verification Successful',
            text: 'User verified successfully'
        });
    </script>
</body>

</html>
