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

<a href="index.php">Terug</a>

<?php
if (isset($_GET['id'])) :
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM movies WHERE id= :id"); 
    $stmt->bindParam(':id', $id);
    $stmt->execute(); 
    while ($row = $stmt->fetch()) : ?>
        <h1><?= $row['title']?> - <?= $row['duur'] ?> minuten</h1>
        <table>
            <tr>
                <td><h2>Datum van uitkomst: <?= $row['datum_van_uitkomst'] ?></h2></td>
            </tr>
            <tr>
                <td><h2>Land van uitkomst: <?= $row['land_van_uitkomst'] ?></h2></td>
            </tr>
            <tr>
                <td><h3><?= $row['description'] ?><h3></td>
            </tr>
            <tr>
                <td>
                <iframe width="1080" height="620" src="https://www.youtube.com/embed/<?= $row['youtube_trailer_id'] ?>"
                 frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </td>
            </tr>
        </table>
    <?php endwhile; ?>
<?php endif; ?>
