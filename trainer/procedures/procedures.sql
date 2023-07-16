DELIMITER //
CREATE PROCEDURE CheckTrainerEmail(IN p_email VARCHAR(255), OUT p_exists INT)
BEGIN
    SELECT COUNT(*) INTO p_exists FROM tbltrainers WHERE email = p_email;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE InsertTrainer(IN p_email VARCHAR(255), IN p_password VARCHAR(255))
BEGIN
    INSERT INTO tbltrainers (email, password) VALUES (p_email, p_password);
END //
DELIMITER ;


  <!-- <?php //if (!empty($errors)) { ?>
                    <div class="alert alert-danger" id="errorMessage">
                        <?php// foreach ($errors as $error) {
                           // echo $error . '<br>';
                        //} ?>
                    </div>
                <?php //} ?> -->