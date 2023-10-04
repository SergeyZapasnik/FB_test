<?php
$pageTitle = "Admin Panel";
include 'header.php';
?>

<p>This is the administration area of the website.</p>

<!-- List of saved currency rates -->
<h2>Saved Currency Rates</h2>
<h3><?= (new DateTime($exchangeRates['date']))->format("Y-m-d") ; ?></h3>
<h3>Base currence <?= $exchangeRates['base_currency']; ?></h3>
<ul>
    <?php foreach (json_decode($exchangeRates['rates'], true) as $currency => $rate): ?>
        <li><?= $currency; ?> - <?= $rate; ?></li>
    <?php endforeach; ?>
</ul>

<!-- Link to the conversion page -->
<a href="/">Currency Conversion</a>

<?php include 'footer.php'; ?>
