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

    $stmt = $pdo->prepare("SELECT * FROM series WHERE id= :id"); 
    $stmt->bindParam(':id', $id);
    $stmt->execute(); 
    while ($row = $stmt->fetch()) : ?>

        <h1><?= $row['title']?> - <?= $row['rating'] ?></h1>
        <table> 
            <tr>
                <td>Awards? <?= $row['has_won_awards'] ?></td>
            </tr>
            <tr>
                <td>Seasons <?= $row['seasons'] ?></td>
            </tr>
            <tr>
                <td>Country <?= $row['country'] ?></td>
            </tr>
            <tr>
                <td>Language <?= $row['language'] ?></td>
            </tr>
            <tr>
                <td><Br><?= $row['description'] ?></td>
            </tr>
        </table>
    <?php endwhile; ?>
<?php endif; ?>
