<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <div class="row">
            <form method="post" action="{{ route('post.create') }}">
            @csrf

            <!-- Post input -->
                <div class="form-group">
                    @if($errors->has('text'))
                        <ul class="alert alert-danger">
                            @foreach($errors->get('text') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <label for="text">Post text</label>
                    <textarea class="form-control" name="text" style="width:800px" id="text" rows="3">{{ old('text') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Create post</button>
            </form>
        </div>
    </div>

</body>
</html>
