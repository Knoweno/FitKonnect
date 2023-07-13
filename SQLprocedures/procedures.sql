DELIMITER //

CREATE PROCEDURE RegisterTrainer(IN userEmail VARCHAR(255), IN userPassword VARCHAR(255))
BEGIN
    INSERT INTO tbltrainers (email, password) VALUES (userEmail, userPassword);
END; //

DELIMITER ;


// Prepare and execute the stored procedure
$query = "CALL RegisterTrainer('$email', '$password')";
mysqli_query($connection, $query);