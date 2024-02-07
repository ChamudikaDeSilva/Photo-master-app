<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Laravel</title>
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
            text-align: center; /* Center the text */
            margin-top: 20px; /* Add space from the top */
        }
        h1 {

            color: #0041bb;
            text-align: center; /* Center the text */
            margin-top: 20px; /* Add space from the top */
        }

        .alert {
            margin-bottom: 20px;
        }

        .custom-file-input {
            cursor: pointer;
        }

        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }

        .btn-outline-danger:hover {
            color: #fff;
            background-color: #4035dc;
            border-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="content">
        <h1 class="mb-5">Photo Master</h1>
    <div class="container mt-5" >
        <h2 class="mb-5">RGB To Gray</h2>
        <form action="{{route('generateGrayscaleImg')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>

            <div class="col-md-12 mb-3">
                <strong>Grayscale Image:</strong><br/>
                <!--img src="/uploads/{{ Session::get('image') }}" width="550px" /-->
                <img src="{{ asset('uploads/' . Session::get('image')) }}" width="550px" />

            </div>
            @endif
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                <label class="custom-file-label" for="chooseFile">Select file</label>
            </div>
            <button type="submit" name="submit" class="btn btn-outline-primary btn-block mt-4">
                Upload
            </button>
        </form>
        <br>
        <div class="resizeBtn">
            <a href="/file-resize" class="btn btn-dark">Next</a>
        </div>
    </div>
    </div>
</body>
</html>
