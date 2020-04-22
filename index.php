<?php 
$host = '127.0.0.1';
$db   = 'netland';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Welkom op het netland beheerderpaneel</h1>
    <h2>Series</h2>
    <table>
        <tr>
            <th><form action="index.php" method="get"><a type='submit' name='series_title' href="index.php?series_title=1">Titel</a></form></th>
            <th><form action="index.php" method="get"><a type='submit' name='series_rating' href="index.php?series_rating=1">Rating</a></form></th>
        </tr>
        <?php
        if (isset($_GET['series_title'])) :
            $stmt = $pdo->query('SELECT * FROM series ORDER BY title ASC;');
            while ($row = $stmt->fetch()): ?> 
            <tr>
            <td><?= $row['title'] ?></td> 
            <td><?= $row['rating'] ?></td>
            <td><form action="series.php" method="get"><a type='submit' name='id' href="series.php?id=<?= $row['id']?>">Bekijk de details</a></form></td>
            </tr>
            <?php endwhile; ?>
        <?php elseif (isset($_GET['series_rating'])) : 
            $stmt = $pdo->query('SELECT * FROM series ORDER BY rating DESC;');
            while ($row = $stmt->fetch()): ?> 
            <tr>
            <td><?= $row['title'] ?></td> 
            <td><?= $row['rating'] ?></td>
            <td><form action="series.php" method="get"><a type='submit' name='id' href="series.php?id=<?= $row['id']?>">Bekijk de details</a></form></td>
            </tr>
            <?php endwhile; ?>
        <?php else:
            $stmt = $pdo->query('SELECT * FROM series');
            while ($row = $stmt->fetch()): ?> 
            <tr>
            <td><?= $row['title'] ?></td> 
            <td><?= $row['rating'] ?></td>
            <td><form action="series.php" method="get"><a type='submit' name='id' href="series.php?id=<?= $row['id']?>">Bekijk de details</a></form></td>
            </tr>
            <?php endwhile; ?>
        <?php endif; ?>
        

    </table>

    <h2>Films</h2>
    <table>
        <tr>
            <th><form action="index.php" method="get"><a type='submit' name='movies_title' href="index.php?movies_title=1">Titel</a></form></th>
            <th><form action="index.php" method="get"><a type='submit' name='movies_duur' href="index.php?movies_duur=1">Duur</a></form></th>
        </tr>
        <?php
        if (isset($_GET['movies_title'])) :
            $stmt = $pdo->query('SELECT * FROM movies ORDER BY title ASC;');
            while ($row = $stmt->fetch()): ?> 
            <tr>
            <td><?= $row['title'] ?></td> 
            <td><?= $row['duur'] ?></td>
            <td><form action="series.php" method="get"><a type='submit' name='id' href="series.php?id=<?= $row['id']?>">Bekijk de details</a></form></td>
            </tr>
            <?php endwhile; ?>
        <?php elseif (isset($_GET['movies_duur'])) : 
            $stmt = $pdo->query('SELECT * FROM movies ORDER BY duur DESC;');
            while ($row = $stmt->fetch()): ?> 
            <tr>
            <td><?= $row['title'] ?></td> 
            <td><?= $row['duur'] ?></td>
            <td><form action="series.php" method="get"><a type='submit' name='id' href="series.php?id=<?= $row['id']?>">Bekijk de details</a></form></td>
            </tr>
            <?php endwhile; ?>
        <?php else:
            $stmt = $pdo->query('SELECT * FROM movies');
            while ($row = $stmt->fetch()): ?> 
            <tr>
            <td><?= $row['title'] ?></td> 
            <td><?= $row['duur'] ?></td>
            <td><form action="series.php" method="get"><a type='submit' name='id' href="series.php?id=<?= $row['id']?>">Bekijk de details</a></form></td>
            </tr>
            <?php endwhile; ?>
        <?php endif; ?>
    </table>

</body>

</html>