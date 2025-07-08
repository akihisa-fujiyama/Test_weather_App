<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
    <div class="alert alert-danger">
        <h4>エラー内容</h4>
        <p>{{ $error }}</p>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
</div>
</body>
</html>