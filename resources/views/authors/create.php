<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Author</title>
</head>

<body>
    <h1>Create a New Author</h1>
    <form action="/authors" method="post">
        <label for="name">Name:</label>
        <br>
        <input type="text" id="name" name="name" required>
        <br><br>

        <label for="lastName">Last Name:</label>
        <br>
        <input type="text" id="lastName" name="lastName" required>
        <br><br>

        <label for="birthDay">Birthday:</label>
        <br>
        <input type="date" id="birthDay" name="birthDay" required>
        <br><br>

        <label for="biography">Biography:</label>
        <br>
        <textarea id="biography" name="biography" rows="4" cols="50"></textarea>
        <br><br>

        <button type="submit">Create Author</button>
    </form>
</body>

</html>