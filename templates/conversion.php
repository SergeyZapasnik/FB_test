<?php

$pageTitle = "Currency Conversion";

include 'header.php';
?>

<form id="currencyConversionForm">
    <label for="amount">Amount:</label>
    <input type="text" id="amount" name="amount" required><br><br>

    <label for="fromCurrency">From Currency:</label>
    <select id="fromCurrency" name="fromCurrency" required>
        <?php foreach (json_decode($exchangeRates['rates'], true) as $currency => $rate): ?>
            <option value="<?= $currency; ?>"><?= $currency; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="toCurrency">To Currency:</label>
    <select id="toCurrency" name="toCurrency" required>
        <?php foreach (json_decode($exchangeRates['rates'], true) as $currency => $rate): ?>
            <option value="<?= $currency; ?>"><?= $currency; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <input type="submit" value="Convert">
</form>

<div id="result"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('currencyConversionForm');
        const resultDiv = document.getElementById('result');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(form);

            fetch('/convert', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {

                    if (data.success) {
                        resultDiv.innerHTML = `Result: ${data.result}`;
                    } else {
                        resultDiv.innerHTML = 'Conversion failed. Please try again.';
                    }
                })
                .catch(error => {
                    resultDiv.innerHTML = 'An error occurred. Please try again later.';
                    console.error(error);
                });
        });
    });
</script>
</body>

<?php include 'footer.php'; ?>

