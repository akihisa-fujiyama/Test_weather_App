<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $location }} の天気情報</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h1 class="h4 mb-0">{{ $location }} の今日の天気</h1>
                    </div>
                    <div class="card-body text-center">
                        <p class="fs-4 mb-3">
                            <strong>気温:</strong> {{ $temp }} ℃
                        </p>
                        <p class="fs-4 mb-3">
                            <strong>天気:</strong> {{ $description }}
                        </p>
                        <p class="fs-4">
                            <strong>降水量:</strong> {{ $rain }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

