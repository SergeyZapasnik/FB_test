<?php
$pageTitle = "Admin Panel";
include 'header.php';
?>

<p>This is the administration area of the website.</p>

<!-- List of saved currency rates -->
<h2>Saved Currency Rates</h2>
<ul>
    <li>USD to EUR: 0.85</li>
    <li>USD to GBP: 0.72</li>
    <!-- Add more currency rates here -->
</ul>

<!-- Link to the conversion page -->
<a href="conversion.php">Currency Conversion</a>

<?php include 'footer.php'; ?>
