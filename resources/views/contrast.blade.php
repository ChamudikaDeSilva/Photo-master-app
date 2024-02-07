<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adjust Contrast</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #caf0ff;
        }

        .container {
            background-color: #cfcaff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        h2 {
            color: #000000;
            text-align: center;
            margin-top: 20px;
        }

        h1 {
            color: #0041bb;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="content">
        <h1 class="mb-5">Photo Master</h1>
        <div class="container mt-5">
            <h2>Adjust Contrast</h2>
            <form action="{{ route('adjustContrast') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="image">Upload Image:</label>
                    <input type="file" name="image" id="image" class="form-control-file" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label for="contrast">Contrast (-100 to 100):</label>
                    <input type="number" name="contrast" id="contrast" class="form-control" min="-100" max="100" required>
                </div>
                <button type="submit" class="btn btn-primary">Adjust Contrast</button>
            </form>
            <br>
            @if(isset($adjustedImagePath))
                <div class="text-center">
                    <img src="{{ $adjustedImagePath }}" alt="Adjusted Image" class="img-fluid">
                </div>
            @endif
        </div>
    </div>
</body>
</html>
