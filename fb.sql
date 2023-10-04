CREATE TABLE fb.exchange_rates (
                                id INT AUTO_INCREMENT PRIMARY KEY,
                                base_currency VARCHAR(3) NOT NULL,
                                rates JSON NOT NULL,
                                date TIMESTAMP NOT NULL
);
INSERT INTO fb.exchange_rates (base_currency, rates, date)
VALUES
    (
     'USD',
     '{"EUR": 4.62594, "GBP": 1.660069, "JPY": 1.433085, "RUB": 18.608522, "USD": 1}',
     '2023-10-03 00:00:00'
     );
