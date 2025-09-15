<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Create a New Job</title>
</head>
<body>
   <h1>Create a New Job</h1>
   <form action="/jobs" method="POST">
      @csrf
      <input type="text" name="title" placeholder="title"><br>
      <input type="text" name="description" placeholder="description"><br>
      <button type="submit">Submit</button>
   </form>
</body>
</html>