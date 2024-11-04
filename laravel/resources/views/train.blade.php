<!DOCTYPE html>
<html>

<head>
    <title>تدريب النموذج</title>
</head>

<body>
    <h1>تدريب النموذج</h1>
    @if (session('success'))
    <div>
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('borhan.train.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">رفع الملف وتدريب النموذج</button>
    </form>
</body>

</html>