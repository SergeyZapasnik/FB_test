<?php
$pageTitle = "Currency Conversion";
include 'header.php';
?>

<form action="convert.php" method="POST">
    <label for="amount">Amount:</label>
    <input type="text" id="amount" name="amount"><br>

    <label for="fromCurrency">From Currency:</label>
    <select id="fromCurrency" name="fromCurrency">
        <option value="USD">USD</option>
        <option value="EUR">EUR</option>
        <option value="GBP">GBP</option>
        <!-- Add more currency options here -->
    </select><br>

    <label for="toCurrency">To Currency:</label>
    <select id="toCurrency" name="toCurrency">
        <option value="USD">USD</option>
        <option value="EUR">EUR</option>
        <option value="GBP">GBP</option>
        <!-- Add more currency options here -->
    </select><br>

    <input type="submit" value="Convert">
</form>

<?php include 'footer.php'; ?>
