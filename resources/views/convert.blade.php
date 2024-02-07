<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Convert Image</title>
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

        h1, h2 {
            color: #0041bb;
            text-align: center;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-check-inline {
            margin-right: 10px;
        }

        .btn-primary {
            width: 100%;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="content">
        <h1 class="mb-5">Photo Master</h1>
        <div class="container mt-5">
            <h2>Convert Image</h2>
            <form action="{{ route('convertImage') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="image">Upload Image:</label>
                    <input type="file" name="image" class="form-control-file" id="image" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label>Color Conversion:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="color" id="red" value="red" required>
                        <label class="form-check-label" for="red">Red</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="color" id="green" value="green">
                        <label class="form-check-label" for="green">Green</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="color" id="blue" value="blue">
                        <label class="form-check-label" for="blue">Blue</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Convert</button>
            </form>
            <br>
            <div>
            @if(isset($convertedImagePath))
                <!--h2>Converted Image</h2-->
                <img src="{{ $convertedImagePath }}" alt="Converted Image">
            @endif
            </div>
            <br>
            <div class="resizeBtn">
                <a href="/index2" class="btn btn-dark">Next</a>
            </div>
        </div>
    </div>
</body>
</html>
