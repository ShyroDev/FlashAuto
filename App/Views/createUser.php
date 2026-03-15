<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>User Form</title>
</head>
<body>
    <h1>Create User</h1>
    <form action="../createUser" method="POST">
        <input type="hidden" name="action" value="createUser">
        <label for="nom">Name :</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="surname">Surname :</label>
        <input type="text" id="suname" name="surname" required><br><br>
        
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password :</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>