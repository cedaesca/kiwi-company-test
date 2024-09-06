<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Authors</title>
</head>

<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Last Name</th>
            <th>Birth Date</th>
            <th>Biography</th>
        </tr>
        <?php foreach ($authors as $author) { ?>
            <tr>
                <td><?= $author->getId() ?></td>
                <td><?= $author->getName() ?></td>
                <td><?= $author->getLastName() ?></td>
                <td><?= $author->getBirthDay()->format('d-m-Y') ?></td>
                <td><?= $author->getBiography() ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>