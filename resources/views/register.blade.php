<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="{{ route('a') }}" method="post">
  
        <input type="text" name="username" id="" placeholder="username">
        <input type="text" name="password" id="" placeholder="senha">
        <input type="hidden" name = "tipo" value = "admin">
        <input type="submit">
        @csrf
    </form>
</body>
</html>