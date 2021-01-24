use chipch5_stats;
-- DELETE FROM poker_tournament WHERE tournamentid > 446;
-- DELETE FROM poker_result WHERE tournamentid > 421;
-- SELECT * FROM poker_result ORDER BY tournamentid DESC;
-- DELETE FROM poker_result_bounty WHERE tournamentid > 421;
-- SELECT * FROM poker_result_bounty ORDER BY tournamentid DESC;

-- UPDATE poker_user SET rejection_userid = NULL, rejection_Date = NULL WHERE id = 13623;
-- SELECT IFNULL(MAX(seasonId), 0) + 1, 'season 16', '01/01/2021', '12/31/2021' FROM poker_season
-- UPDATE poker_season SET seasonactive = '0' WHERE seasonid = 2;
-- SELECT * FROM poker_result_bounty WHERE tournamentid = 447;
-- SELECT * FROM poker_result WHERE tournamentid = 447;
-- SELECT * FROM poker_tournament_bounty WHERE tournamentid = 447;
-- SELECT typeId AS id, typeDescription AS description FROM poker_special_type WHERE typeId = 2
-- update poker_tournament set tournamentdesc = replace(REPLACE(REPLACE(tournamentdesc, 'Season ', 'S'), 'Tournament ', 'T'), ',', ' -');
-- SELECT DISTINCT playerid from poker_result WHERE playerid NOT IN (SELECT id FROM poker_user);
--  SELECT * from poker_result WHERE tournamentid NOT IN (SELECT tournamentid FROM poker_tournament);
-- DELETE FROM poker_result_bounty WHERE tournamentid = 382;

-- SELECT *
-- FROM poker_group g INNER JOIN poker_group_payout gp ON g.groupId = gp.groupId
-- INNER JOIN poker_payout p ON gp.payoutId = p.payoutId
-- INNER JOIN poker_structure s ON p.PayoutId = s.PayoutId
-- ORDER BY g.groupName, p.PayoutName, s.Place;
-- 
-- SELECT p.payoutId AS id, p.payoutName AS name, p.bonusPoints AS 'bonus pts', p.minPlayers AS 'min players', p.maxPlayers AS 'max players', s.place, s.percentage FROM poker_payout p INNER JOIN poker_structure s ON p.payoutId = s.payoutId WHERE p.payoutId = 3;
-- 
-- SELECT p.payoutId AS id, p.payoutName AS name, p.bonusPoints AS 'bonus pts', p.minPlayers AS 'min players', p.maxPlayers AS 'max players' FROM poker_group_payout gp INNER JOIN poker_payout p ON gp.payoutId = p.payoutId;
--  WHERE gp.groupId = 1;

-- INSERT INTO poker_structure(payoutid, place, percentage) VALUES(3, 1, .5);
-- INSERT INTO poker_structure(payoutid, place, percentage) VALUES(3, 2, .25);
-- INSERT INTO poker_structure(payoutid, place, percentage) VALUES(3, 3, .15);
-- INSERT INTO poker_structure(payoutid, place, percentage) VALUES(3, 4, .1);

-- DELETE FROM poker_structure WHERE payoutid > 10;
-- DELETE FROM poker_payout WHERE payoutid > 10;

-- SELECT * FROM poker_user WHERE id = 100
CALL `user_update_id`();