UPDATE poker_tournament
SET locationId = 2, tournamentDate = '2006-02-10'
WHERE tournamentId IN (110, 111);
UPDATE poker_tournament
SET locationId = 3, tournamentDate = '2006-03-24'
WHERE tournamentId IN (112, 113);
UPDATE poker_tournament
SET locationId = 5, tournamentDate = '2006-04-14'
WHERE tournamentId IN (114, 115);
UPDATE poker_tournament
SET locationId = 9, tournamentDate = '2006-05-12'
WHERE tournamentId IN (116, 117);
UPDATE poker_tournament
SET locationId = 1, tournamentDate = '2006-06-02'
WHERE tournamentId IN (118);
UPDATE poker_tournament
SET locationId = 7, tournamentDate = '2006-07-09'
WHERE tournamentId IN (119, 120);
UPDATE poker_tournament
SET locationId = 23, tournamentDate = '2006-08-18'
WHERE tournamentId IN (121, 123);
UPDATE poker_tournament
SET locationId = 22, tournamentDate = '2006-09-29'
WHERE tournamentId IN (124);
UPDATE poker_tournament
SET locationId = 14, tournamentDate = '2006-10-27'
WHERE tournamentId IN (125, 126);
UPDATE poker_tournament
SET locationId = 22, tournamentDate = '2006-11-10'
WHERE tournamentId IN (187, 188);
UPDATE poker_tournament
SET locationId = 10, tournamentDate = '2006-12-08'
WHERE tournamentId IN (189);

INSERT INTO `poker_location` VALUES(20, 'Madison Heights - Powell', 72, 'MadisonHeights', '80 W. Gumnthrie Ave', 'MI', 48048);
INSERT INTO `poker_location` VALUES(21, 'Hazel Park - Pritzl', 76, 'HazelPark', 'xxxx', 'MI', 48000);
INSERT INTO `poker_location` VALUES(22, 'Holly - Larson', 62, 'Holly', '12355 Grundyke Road', 'MI', 48442);

INSERT INTO `poker_tournament` VALUES(187, 'Season 1, Tournament 19', 3, 1, 5000, 22, '2006-11-11', '14:00:00', '19:00:00', 25, 27, 0, 0, 0, 0, 1, 3, 0.20, '12:00:00', NULL);
INSERT INTO `poker_tournament` VALUES(188, 'Season 1 Main Event', 3, 1, 5000, 10, '2006-11-11', '17:00:00', '19:00:00', 25, 27, 0, 0, 0, 0, 1, 3, 0.20, '12:00:00', NULL);
INSERT INTO `poker_tournament` VALUES(189, 'Season 1 Championship', 3, 1, 2500, 10, '2006-12-02', '14:00:00', '19:00:00', 25, 27, 0, 0, 0, 0, 2, 2, 0.00, '12:00:00', NULL);

DELETE FROM poker_result WHERE tournamentId = 187;
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 100, 'F', 0, 'Y', 'N', 'N', 0, 'N', 1, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 74, 'F', 0, 'Y', 'N', 'N', 0, 'N', 2, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 103, 'F', 0, 'Y', 'N', 'N', 0, 'N', 3, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 6673, 'F', 0, 'Y', 'N', 'N', 0, 'N', 4, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 96, 'F', 0, 'Y', 'N', 'N', 0, 'N', 5, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 63, 'F', 0, 'Y', 'N', 'N', 0, 'N', 6, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 112, 'F', 0, 'Y', 'N', 'N', 0, 'N', 7, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 82, 'F', 0, 'Y', 'N', 'N', 0, 'N', 8, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 76, 'F', 0, 'Y', 'N', 'N', 0, 'N', 9, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 70, 'F', 0, 'Y', 'N', 'N', 0, 'N', 10, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 105, 'F', 0, 'Y', 'N', 'N', 0, 'N', 11, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 86, 'F', 0, 'Y', 'N', 'N', 0, 'N', 12, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 90, 'F', 0, 'Y', 'N', 'N', 0, 'N', 13, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 71, 'F', 0, 'Y', 'N', 'N', 0, 'N', 14, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 106, 'F', 0, 'Y', 'N', 'N', 0, 'N', 15, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 102, 'F', 0, 'Y', 'N', 'N', 0, 'N', 16, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(187, 83, 'F', 0, 'Y', 'N', 'N', 0, 'N', 17, null, null);

DELETE FROM poker_result WHERE tournamentId = 188;
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 66, 'F', 0, 'Y', 'N', 'N', 0, 'N', 1, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 86, 'F', 0, 'Y', 'N', 'N', 0, 'N', 2, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 90, 'F', 0, 'Y', 'N', 'N', 0, 'N', 3, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 63, 'F', 0, 'Y', 'N', 'N', 0, 'N', 4, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 77, 'F', 0, 'Y', 'N', 'N', 0, 'N', 5, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 87, 'F', 0, 'Y', 'N', 'N', 0, 'N', 6, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 82, 'F', 0, 'Y', 'N', 'N', 0, 'N', 7, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 105, 'F', 0, 'Y', 'N', 'N', 0, 'N', 8, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 103, 'F', 0, 'Y', 'N', 'N', 0, 'N', 9, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 83, 'F', 0, 'Y', 'N', 'N', 0, 'N', 10, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 76, 'F', 0, 'Y', 'N', 'N', 0, 'N', 11, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 112, 'F', 0, 'Y', 'N', 'N', 0, 'N', 12, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 71, 'F', 0, 'Y', 'N', 'N', 0, 'N', 13, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 70, 'F', 0, 'Y', 'N', 'N', 0, 'N', 14, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 75, 'F', 0, 'Y', 'N', 'N', 0, 'N', 15, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 97, 'F', 0, 'Y', 'N', 'N', 0, 'N', 16, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 109, 'F', 0, 'Y', 'N', 'N', 0, 'N', 17, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 72, 'F', 0, 'Y', 'N', 'N', 0, 'N', 18, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 69, 'F', 0, 'Y', 'N', 'N', 0, 'N', 19, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 74, 'F', 0, 'Y', 'N', 'N', 0, 'N', 20, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 100, 'F', 0, 'Y', 'N', 'N', 0, 'N', 21, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 102, 'F', 0, 'Y', 'N', 'N', 0, 'N', 22, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 78, 'F', 0, 'Y', 'N', 'N', 0, 'N', 23, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 96, 'F', 0, 'Y', 'N', 'N', 0, 'N', 24, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 106, 'F', 0, 'Y', 'N', 'N', 0, 'N', 25, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 91, 'F', 0, 'Y', 'N', 'N', 0, 'N', 26, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 108, 'F', 0, 'Y', 'N', 'N', 0, 'N', 27, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(188, 84, 'F', 0, 'Y', 'N', 'N', 0, 'N', 28, null, null);

DELETE FROM poker_result WHERE tournamentId = 189;
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 98, 'F', 0, 'Y', 'N', 'N', 0, 'N', 1, null, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 100, 'F', 0, 'Y', 'N', 'N', 0, 'N', 2, 98, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 76, 'F', 0, 'Y', 'N', 'N', 0, 'N', 3, 98, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 91, 'F', 0, 'Y', 'N', 'N', 0, 'N', 4, 76, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 118, 'F', 0, 'Y', 'N', 'N', 0, 'N', 5, 76, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 83, 'F', 0, 'Y', 'N', 'N', 0, 'N', 6, 100, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 75, 'F', 0, 'Y', 'N', 'N', 0, 'N', 7, 118, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 90, 'F', 0, 'Y', 'N', 'N', 0, 'N', 8, 98, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 104, 'F', 0, 'Y', 'N', 'N', 0, 'N', 9, 76, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 109, 'F', 0, 'Y', 'N', 'N', 0, 'N', 10, 91, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 89, 'F', 0, 'Y', 'N', 'N', 0, 'N', 11, 76, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 111, 'F', 0, 'Y', 'N', 'N', 0, 'N', 12, 98, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 94, 'F', 0, 'Y', 'N', 'N', 0, 'N', 13, 83, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 86, 'F', 0, 'Y', 'N', 'N', 0, 'N', 14, 118, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 96, 'F', 0, 'Y', 'N', 'N', 0, 'N', 15, 98, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 92, 'F', 0, 'Y', 'N', 'N', 0, 'N', 16, 90, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 88, 'F', 0, 'Y', 'N', 'N', 0, 'N', 17, 109, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 77, 'F', 0, 'Y', 'N', 'N', 0, 'N', 18, 91, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 82, 'F', 0, 'Y', 'N', 'N', 0, 'N', 19, 100, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 99, 'F', 0, 'Y', 'N', 'N', 0, 'N', 20, 118, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 106, 'F', 0, 'Y', 'N', 'N', 0, 'N', 21, 118, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 108, 'F', 0, 'Y', 'N', 'N', 0, 'N', 22, 83, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 103, 'F', 0, 'Y', 'N', 'N', 0, 'N', 23, 118, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 93, 'F', 0, 'Y', 'N', 'N', 0, 'N', 24, 92, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 63, 'F', 0, 'Y', 'N', 'N', 0, 'N', 25, 76, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 87, 'F', 0, 'Y', 'N', 'N', 0, 'N', 26, 94, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 107, 'F', 0, 'Y', 'N', 'N', 0, 'N', 27, 83, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 114, 'F', 0, 'Y', 'N', 'N', 0, 'N', 28, 94, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 81, 'F', 0, 'Y', 'N', 'N', 0, 'N', 29, 83, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 85, 'F', 0, 'Y', 'N', 'N', 0, 'N', 30, 88, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 102, 'F', 0, 'Y', 'N', 'N', 0, 'N', 31, 85, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 70, 'F', 0, 'Y', 'N', 'N', 0, 'N', 32, 98, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 66, 'F', 0, 'Y', 'N', 'N', 0, 'N', 33, 76, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 73, 'F', 0, 'Y', 'N', 'N', 0, 'N', 34, 98, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 119, 'F', 0, 'Y', 'N', 'N', 0, 'N', 35, 83, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 113, 'F', 0, 'Y', 'N', 'N', 0, 'N', 36, 102, null);
INSERT INTO poker_result(TournamentId,PlayerId,StatusCode,registerOrder,BuyinPaid,RebuyPaid,AddonPaid,RebuyCount,AddonFlag,Place,KnockedOutBy,Food)
VALUES(189, 78, 'F', 0, 'Y', 'N', 'N', 0, 'N', 37, 119, null);

update poker_tournament set locationid = 13 where tournamentdate between '2007-01-01' and '2007-12-31';