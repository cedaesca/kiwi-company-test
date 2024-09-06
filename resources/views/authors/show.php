<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= "{$author->getLastName()}, {$author->getName()} - Authors" ?></title>
</head>

<body>
    <main>
        <section>
            <h1><?= "{$author->getLastName()}, {$author->getName()} ({$author->getBirthDay()->format('m-d-Y')})" ?></h1>
            <p><?= $author->getBiography() ?></p>
        </section>
    </main>
</body>

</html>