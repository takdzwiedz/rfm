-- Artur Kacprzak, 15.11.2019

SET lc_time_names = 'pl_PL';

CREATE TABLE kalendarz
(
    miesiące DATE
);

DELIMITER |

CREATE PROCEDURE fill_calendar(start_date DATE, end_date DATE)

BEGIN
    DECLARE crt_date DATE;
    SET crt_date=start_date;
    WHILE crt_date < end_date DO
            INSERT INTO kalendarz VALUES(crt_date);
            SET crt_date = ADDDATE(crt_date, INTERVAL 1 MONTH);
        END WHILE;
END |
DELIMITER ;


CALL fill_calendar('1990-01-01', '2045-12-31');