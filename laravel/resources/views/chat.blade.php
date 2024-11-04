<!DOCTYPE html>
<html>

<head>
    <title>الشات</title>
</head>

<body>
    <h1>الشات</h1>
    <form action="{{ route('chat.ask') }}" method="POST">
        @csrf
        <input type="text" name="question" required>
        <button type="submit">طرح السؤال</button>
    </form>
    @isset($answer)
    <div>
        <strong>الإجابة:</strong> {{ $answer }}
    </div>
    @endisset
</body>

</html>