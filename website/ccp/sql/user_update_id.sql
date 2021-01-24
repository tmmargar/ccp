DELIMITER \\
CREATE OR REPLACE DEFINER=`root`@`localhost` PROCEDURE `user_update_id`()
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
COMMENT ''
BEGIN
 DECLARE v_done INT;
 DECLARE v_row_count INT;
 DECLARE v_id INT;
 DECLARE v_id_new INT;
 DECLARE v_name VARCHAR(100);
 DECLARE v_message VARCHAR(500);
 DECLARE cur_user CURSOR FOR SELECT id, CONCAT(FIRST_name, ' ', last_name) AS name FROM poker_user WHERE id > 0 ORDER BY id;
 DECLARE cur_user2 CURSOR FOR SELECT id, CONCAT(FIRST_name, ' ', last_name) AS name FROM poker_user WHERE id < 0 ORDER BY id;
 DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_done = TRUE;
 SET FOREIGN_KEY_CHECKS = 0;
 SET v_done = FALSE;
 SET v_row_count = 0;
 SET v_id_new = 1;
 CREATE OR REPLACE TEMPORARY TABLE user_update_id_log (message VARCHAR(500));
 START TRANSACTION;
 OPEN cur_user;
 read_loop: LOOP
   FETCH cur_user INTO v_id, v_name;
   IF v_done THEN
    LEAVE read_loop;
   END IF;
   SELECT CONCAT('updating ', v_name, ' (', v_id, ') to ', v_id_new) INTO v_message;
   INSERT INTO user_update_id_log(message) VALUES(v_message);

   UPDATE poker_location SET playerId = v_id_new WHERE playerId = v_id;
	SELECT ROW_COUNT() INTO v_row_count;
	SELECT CONCAT(v_row_count, ' records updated in poker_location') INTO v_message;
   INSERT INTO user_update_id_log(message) VALUES(v_message);

   UPDATE poker_result SET playerId = v_id_new WHERE playerId = v_id;
	SELECT ROW_COUNT() INTO v_row_count;
	SELECT CONCAT(v_row_count, ' records updated in poker_result') INTO v_message;
   INSERT INTO user_update_id_log(message) VALUES(v_message);

   UPDATE poker_result SET knockedOutBy = v_id_new WHERE knockedOutBy = v_id;
	SELECT ROW_COUNT() INTO v_row_count;
	SELECT CONCAT(v_row_count, ' records updated in poker_result (knocked out)') INTO v_message;
   INSERT INTO user_update_id_log(message) VALUES(v_message);

   UPDATE poker_result_bounty SET playerId = v_id_new WHERE playerId = v_id;
	SELECT ROW_COUNT() INTO v_row_count;
	SELECT CONCAT(v_row_count, ' records updated in poker_result_bounty') INTO v_message;
   INSERT INTO user_update_id_log(message) VALUES(v_message);

   UPDATE poker_tournament_absence SET playerId = v_id_new WHERE playerId = v_id;
	SELECT ROW_COUNT() INTO v_row_count;
	SELECT CONCAT(v_row_count, ' records updated in poker_tournament_absence') INTO v_message;
   INSERT INTO user_update_id_log(message) VALUES(v_message);

   UPDATE poker_tournament_bounty SET playerId = v_id_new WHERE playerId = v_id;
	SELECT ROW_COUNT() INTO v_row_count;
	SELECT CONCAT(v_row_count, ' records updated in poker_tournament_bounty') INTO v_message;
   INSERT INTO user_update_id_log(message) VALUES(v_message);

   UPDATE poker_user SET id = v_id_new, idPrevious = v_id WHERE id = v_id;
	SELECT ROW_COUNT() INTO v_row_count;
	SELECT CONCAT(v_row_count, ' records updated in poker_user') INTO v_message;
   INSERT INTO user_update_id_log(message) VALUES(v_message);

   SET v_id_new = v_id_new + 1;
 END LOOP;
 CLOSE cur_user;
 SET v_done = FALSE;
 OPEN cur_user2;
 read_loop2: LOOP
   FETCH cur_user2 INTO v_id, v_name;
   IF v_done THEN
    LEAVE read_loop2;
   END IF;
   SELECT CONCAT('updating ', v_name, ' (', v_id, ') to ', v_id_new) INTO v_message;
   INSERT INTO user_update_id_log(message) VALUES(v_message);

   UPDATE poker_location SET playerId = v_id_new WHERE playerId = v_id;
	SELECT ROW_COUNT() INTO v_row_count;
	SELECT CONCAT(v_row_count, ' records updated in poker_location') INTO v_message;
   INSERT INTO user_update_id_log(message) VALUES(v_message);

   UPDATE poker_result SET playerId = v_id_new WHERE playerId = v_id;
	SELECT ROW_COUNT() INTO v_row_count;
	SELECT CONCAT(v_row_count, ' records updated in poker_result') INTO v_message;
   INSERT INTO user_update_id_log(message) VALUES(v_message);

   UPDATE poker_result SET knockedOutBy = v_id_new WHERE knockedOutBy = v_id;
	SELECT ROW_COUNT() INTO v_row_count;
	SELECT CONCAT(v_row_count, ' records updated in poker_result (knocked out)') INTO v_message;
   INSERT INTO user_update_id_log(message) VALUES(v_message);

   UPDATE poker_result_bounty SET playerId = v_id_new WHERE playerId = v_id;
	SELECT ROW_COUNT() INTO v_row_count;
	SELECT CONCAT(v_row_count, ' records updated in poker_result_bounty') INTO v_message;
   INSERT INTO user_update_id_log(message) VALUES(v_message);

   UPDATE poker_tournament_absence SET playerId = v_id_new WHERE playerId = v_id;
	SELECT ROW_COUNT() INTO v_row_count;
	SELECT CONCAT(v_row_count, ' records updated in poker_tournament_absence') INTO v_message;
   INSERT INTO user_update_id_log(message) VALUES(v_message);

   UPDATE poker_tournament_bounty SET playerId = v_id_new WHERE playerId = v_id;
	SELECT ROW_COUNT() INTO v_row_count;
	SELECT CONCAT(v_row_count, ' records updated in poker_tournament_bounty') INTO v_message;
   INSERT INTO user_update_id_log(message) VALUES(v_message);

   UPDATE poker_user SET id = v_id_new, idPrevious = v_id WHERE id = v_id;
	SELECT ROW_COUNT() INTO v_row_count;
	SELECT CONCAT(v_row_count, ' records updated in poker_user') INTO v_message;
   INSERT INTO user_update_id_log(message) VALUES(v_message);

   SET v_id_new = v_id_new + 1;
 END LOOP;
 CLOSE cur_user2;
 SELECT 'ROLLING BACK!!!!"' INTO v_message;
-- SELECT 'COMMITING!!!!"' INTO v_message;
 INSERT INTO user_update_id_log(message) VALUES(v_message);
 SELECT * FROM user_update_id_log;
 ROLLBACK;
 DROP TABLE user_update_id_log;
 SET FOREIGN_KEY_CHECKS = 1;
-- SHOW ERRORS;
END;