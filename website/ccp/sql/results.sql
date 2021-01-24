SELECT r.place, CONCAT(p.first_name, ' ', p.last_name) AS NAME, r.rebuycount * t.rebuyamount AS rebuy, CASE WHEN r.addonpaid = 'Y' THEN t.addonamount ELSE 0 END AS addon, 4398.00 * CASE WHEN s.percentage IS NULL THEN 0 ELSE s.percentage END AS earnings, CASE WHEN t.tournamentdesc LIKE '%Championship%' THEN 0 ELSE CASE WHEN r.place BETWEEN 1 AND 8 THEN CASE WHEN t.tournamentdesc LIKE '%Main Event%' THEN (np.numplayers - r.place + 4) * 2 ELSE np.numplayers - r.place + 4 END ELSE CASE WHEN t.tournamentdesc LIKE '%Main Event%' THEN (np.numplayers - r.place + 1) * 2 ELSE np.numplayers - r.place + 1 END END END AS 'pts', ko.knockedoutby AS 'knocked out by' 
FROM poker_result r INNER JOIN poker_user p ON r.playerid = p.id 
INNER JOIN poker_tournament t ON r.tournamentid = t.tournamentid 
INNER JOIN poker_location l ON t.locationid = l.locationid 
INNER JOIN poker_limit_type lt ON t.limittypeid = lt.limittypeid 
INNER JOIN poker_game_type gt ON t.gametypeid = gt.gametypeid 
LEFT JOIN (SELECT s1.payoutid, s1.place, s1.percentage 
                  FROM (SELECT p.payoutid 
                        FROM (SELECT r.tournamentid, Count(*) AS numPlayers FROM poker_result r WHERE r.tournamentid = 379 AND r.place > 0 AND r.statuscode IN ( 'R', 'F' )) np INNER JOIN poker_tournament t ON np.tournamentid = t.tournamentid INNER JOIN poker_group_payout gp ON t.groupid = gp.groupid INNER JOIN poker_payout p ON gp.payoutid = p.payoutid AND np.numplayers BETWEEN p.minplayers AND p.maxplayers) a 
                  INNER JOIN poker_structure s1 ON a.payoutid = s1.payoutid) s ON r.place = s.place 
           INNER JOIN (SELECT r1.tournamentid, Count(*) AS numPlayers FROM poker_result r1 WHERE r1.place > 0 GROUP BY r1.tournamentid) np ON r.tournamentid = np.tournamentid 
       LEFT JOIN (SELECT r2.tournamentid, Sum(r2.rebuycount) AS numRebuys FROM poker_result r2 WHERE r2.rebuycount > 0 GROUP BY r2.tournamentid) nr ON r.tournamentid = nr.tournamentid 
       LEFT JOIN (SELECT r3.tournamentid, r3.playerid, CONCAT(p1.first_name, ' ', p1.last_name) AS knockedOutBy FROM  poker_result r3 INNER JOIN poker_user p1 ON r3.knockedoutby = p1.id) ko ON r.tournamentid = ko.tournamentid AND r.playerid = ko.playerid 
       LEFT JOIN (SELECT tournamentid, playerid, Count(bountyid) AS numBountys FROM poker_result_bounty GROUP BY tournamentid, playerid) rb ON r.tournamentid = rb.tournamentid AND r.playerid = rb.playerid 
       LEFT JOIN (SELECT tournamentid, Count(addonpaid) AS numAddons FROM poker_result WHERE addonpaid = 'Y' GROUP BY tournamentid) na ON r.tournamentid = na.tournamentid 
WHERE r.tournamentid = 379 AND r.place > 0 
ORDER BY t.tournamentdate DESC, t.starttime DESC, r.place;