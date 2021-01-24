SELECT NAME, 
       d.tourneys, 
       CASE WHEN e.points IS NULL THEN 0 ELSE e.points END                                AS points, 
       e.points / d.numtourneys                                                           AS AvgPoints, 
       d.fts                                                                              AS 'count', 
       d.pctfts                                                                           AS '%', 
       d.avgplace                                                                         AS 'avg', 
       d.high                                                                             AS 'best', 
       d.low                                                                              AS 'worst', 
       -( CASE WHEN d.numtourneys IS NULL THEN 0 ELSE d.numtourneys * e.buyinamount END ) AS buyins, 
       -( CASE WHEN e.rebuys IS NULL THEN 0 ELSE e.rebuys END )                           AS rebuys, 
       -( CASE WHEN e.addons IS NULL THEN 0 ELSE e.addons END )                           AS addons, 
       CASE WHEN e.numbountys IS NULL THEN 0 ELSE e.numbountys * 0 END                    AS bounties, 
       d.earnings, 
       d.earnings - CASE WHEN d.numtourneys IS NULL THEN 0 ELSE d.numtourneys * e.buyinamount END
                  - CASE WHEN e.rebuys IS NULL THEN 0 ELSE e.rebuys END - CASE WHEN e.addons IS NULL THEN 0 ELSE e.addons END
                  - CASE WHEN e.numbountys IS NULL THEN 0 ELSE e.numbountys * 0 END       AS 'net(+/-)' 
FROM (SELECT a.id, a.NAME, a.tourneys, a.fts, a.pctfts, a.avgplace, a.low, a.high, CASE WHEN b.earnings IS NULL THEN 0 ELSE b.earnings END AS Earnings, a.numtourneys 
      FROM (SELECT p.id, 
                   Concat(p.first_name, ' ', p.last_name) AS NAME, 
                   CASE WHEN nt.numtourneys IS NULL THEN 0 ELSE nt.numtourneys END Tourneys, 
                   CASE WHEN nft.numfinaltables IS NULL THEN 0 ELSE nft.numfinaltables END FTs, 
                   CASE WHEN nt.numtourneys IS NULL THEN 0 ELSE CASE WHEN nft.numfinaltables IS NULL THEN 0 ELSE nft.numfinaltables END / nt.numtourneys END AS PctFTs, 
                   CASE WHEN nt.numtourneys IS NULL THEN 0 ELSE CASE WHEN nt.totalplaces IS NULL THEN 0 ELSE nt.totalplaces END / nt.numtourneys END AS AvgPlace, 
                   CASE WHEN nt.maxplace IS NULL THEN 0 ELSE nt.maxplace END AS Low, 
                   CASE WHEN nt.minplace IS NULL THEN 0 ELSE nt.minplace END AS High, 
                   nt.numtourneys 
            FROM poker_user p 
            LEFT JOIN (SELECT r1.playerid, Count(*) AS NumTourneys, Sum(r1.place) AS TotalPlaces, Max(r1.place) AS MaxPlace, Min(r1.place) AS MinPlace FROM poker_result r1 INNER JOIN poker_tournament t1 ON r1.tournamentid = t1.tournamentid AND t1.tournamentdate BETWEEN '2019-01-01' AND '2019-11-30' WHERE r1.place > 0 GROUP BY r1.playerid) nt ON p.id = nt.playerid 
            LEFT JOIN (SELECT r2.playerid, Count(*) AS NumFinalTables FROM  poker_result r2 INNER JOIN poker_tournament t2 ON r2.tournamentid = t2.tournamentid AND t2.tournamentdate BETWEEN '2019-01-01' AND '2019-11-30' WHERE r2.place BETWEEN 1 AND 8 GROUP  BY r2.playerid) nft ON p.id = nft.playerid) a 
            LEFT JOIN (SELECT id, NAME, Sum(totalearnings) AS Earnings, Max(maxearnings)   AS MaxEarnings, numtourneys 
                       FROM (SELECT id, NAME, Sum(earnings) AS TotalEarnings, Max(earnings) AS MaxEarnings, numtourneys 
                             FROM (SELECT p.id, Concat(p.first_name, ' ', p.last_name) AS NAME, ((np.numplayers * (t.buyinamount - (t.buyinamount * t.rake))) + (CASE WHEN nr.numrebuys IS NULL THEN 0 ELSE nr.numrebuys END * (t.rebuyamount - (t.rebuyamount * t.rake))) + (CASE WHEN na.numaddons IS NULL THEN 0 ELSE na.numaddons END * (t.addonamount - (t.addonamount * t.rake)))) * CASE WHEN s.percentage IS NULL THEN 0 ELSE s.percentage END AS Earnings, nt.numtourneys 
                                   FROM poker_result r 
                                   INNER JOIN poker_user p ON r.playerid = p.id 
                                   INNER JOIN poker_tournament t ON r.tournamentid = t.tournamentid AND t.tournamentdate BETWEEN '2019-01-01' AND '2019-11-30' 
                                   INNER JOIN (SELECT r1.playerid, Count(*) AS NumTourneys FROM poker_result r1 INNER JOIN poker_tournament t1 ON r1.tournamentid = t1.tournamentid AND r1.place > 0 AND t1.tournamentdate BETWEEN '2019-01-01' AND '2019-11-30' GROUP  BY r1.playerid) nt ON r.playerid = nt.playerid 
                                   INNER JOIN (SELECT r2.tournamentid, Count(*) AS NumPlayers FROM poker_result r2 WHERE r2.place > 0 GROUP  BY r2.tournamentid) np ON r.tournamentid = np.tournamentid 
                                   LEFT JOIN (SELECT r3.tournamentid, Sum(r3.rebuycount) AS NumRebuys FROM  poker_result r3 WHERE r3.place > 0 AND r3.rebuycount > 0 GROUP BY r3.tournamentid) nr ON r.tournamentid = nr.tournamentid 
                                   LEFT JOIN (SELECT tournamentid, Count(addonpaid) AS NumAddons FROM poker_result WHERE addonpaid = 'Y' GROUP BY tournamentid) na ON r.tournamentid = na.tournamentid 
                                   LEFT JOIN (SELECT a.tournamentid, s1.payoutid, s1.place, s1.percentage FROM (SELECT np.tournamentid, p.payoutid FROM (SELECT r.tournamentid, Count(*) AS numPlayers FROM poker_result r WHERE r.place > 0 AND r.statuscode IN ('R', 'F') GROUP BY r.tournamentid) np INNER JOIN poker_tournament t ON np.tournamentid = t.tournamentid INNER JOIN poker_group_payout gp ON t.groupid = gp.groupid INNER JOIN poker_payout p ON gp.payoutid = p.payoutid AND np.numplayers BETWEEN p.minplayers AND p.maxplayers) a 
                                   INNER JOIN poker_structure s1 ON a.payoutid = s1.payoutid) s ON r.tournamentid = s.tournamentid AND r.place = s.place 
                                   WHERE r.place > 0) y 
                             GROUP BY id 
                             UNION SELECT xx.id, xx.NAME, Sum(xx.earnings) AS TotalEarnings, Max(xx.earnings) AS MaxEarnings, 0 
                                  FROM (SELECT Year(t.tournamentdate) AS Yr, p.id, Concat(p.first_name, ' ', p.last_name) AS NAME, 
                                              (SELECT Sum(total) AS 'Total Pool' 
                                               FROM (SELECT Year(t2.tournamentdate) AS Yr, t2.tournamentid AS Id, 
                                                            CASE WHEN b.play IS NULL THEN 0 ELSE Concat(b.play, '+', CASE WHEN nr.numrebuys IS NULL THEN 0 ELSE nr.numrebuys END , 'r', '+' , CASE WHEN na.numaddons IS NULL THEN 0 ELSE na.numaddons END, 'a') END AS Play, 
                                                            ((t2.buyinamount * t2.rake) * play) + ((t2.rebuyamount * t2.rake) * 
                                                            CASE WHEN nr.numrebuys IS NULL THEN 0 ELSE nr.numrebuys END) + ((t2.addonamount * t2.rake) * 
                                                            CASE WHEN na.numaddons IS NULL THEN 0 ELSE na.numaddons END) AS Total 
                                                     FROM poker_tournament t2 
                                                     LEFT JOIN (SELECT tournamentid, Count(*) AS Play FROM poker_result WHERE buyinpaid = 'Y' AND place > 0 GROUP BY tournamentid) b ON t2.tournamentid = b.tournamentid AND t2.tournamentdate BETWEEN '2019-01-01' AND '2019-11-30' 
                                                     LEFT JOIN (SELECT r.tournamentid, Sum(r.rebuycount) AS NumRebuys FROM poker_result r WHERE  r.rebuypaid = 'Y' AND r.rebuycount > 0 GROUP  BY r.tournamentid) nr ON t2.tournamentid = nr.tournamentid 
                                                     LEFT JOIN (SELECT r.tournamentid, Count(*) AS NumAddons FROM poker_result r WHERE r.addonpaid = 'Y' GROUP  BY r.tournamentid) na ON t2.tournamentid = na.tournamentid) zz WHERE zz.yr = Year(t.tournamentdate) GROUP BY zz.yr) * CASE WHEN s.percentage IS NULL THEN 0 ELSE s.percentage END AS Earnings 
                                        FROM poker_result r INNER JOIN poker_user p ON r.playerid = p.id
                                        INNER JOIN poker_tournament t ON r.tournamentid = t.tournamentid AND t.tournamentdesc LIKE '%Championship%' AND t.tournamentdate BETWEEN '2019-01-01' AND '2019-11-30' 
                                        LEFT JOIN (SELECT a.tournamentid, s1.payoutid, s1.place, s1.percentage 
                                                   FROM (SELECT np.tournamentid, p.payoutid
                                                         FROM (SELECT r.tournamentid, Count(*) AS numPlayers FROM poker_result r WHERE r.place > 0 AND r.statuscode IN ('R', 'F') GROUP BY r.tournamentid) np 
                                                         INNER JOIN poker_tournament t ON np.tournamentid = t.tournamentid AND t.tournamentdate BETWEEN '2019-01-01' AND '2019-11-30' 
                                                         INNER JOIN poker_group_payout gp ON t.groupid = gp.groupid 
                                                         INNER JOIN poker_payout p ON gp.payoutid = p.payoutid AND np.numplayers BETWEEN p.minplayers AND p.maxplayers) a
                                                   INNER JOIN poker_structure s1 ON a.payoutid = s1.payoutid) s ON r.tournamentid = s.tournamentid AND r.place = s.place 
                                                   WHERE r.place > 0 
                                        GROUP BY id, yr) xx 
                            GROUP BY xx.id, xx.NAME) cc 
                      GROUP BY id, NAME) b ON a.id = b.id) d 
      LEFT JOIN (SELECT c.playerid, c.place, c.numplayers, CASE WHEN c.place IS NULL THEN 0 ELSE Sum(CASE WHEN (c.tournamentdesc IS NULL OR c.tournamentdesc <> 'Championship') THEN CASE WHEN c.place BETWEEN 1 AND 8 THEN CASE WHEN c.tournamentdesc LIKE '%Main Event%' THEN ( c.numplayers - c.place + 4 ) * 2 ELSE c.numplayers - c.place + 4 END ELSE CASE WHEN c.tournamentdesc LIKE '%Main Event%' THEN (c.numplayers - c.place + 1) * 2 ELSE c.numplayers - c.place + 1 END END END) END AS Points, Sum(CASE WHEN c.numrebuys IS NULL THEN 0 ELSE c.numrebuys END * c.rebuyamount) AS Rebuys, Sum(CASE WHEN c.numaddons IS NULL THEN 0 ELSE c.numaddons END * c.addonamount) AS Addons, Sum(c.numbountys) AS NumBountys, c.numrebuys, c.buyinamount 
                 FROM (SELECT a.tournamentid, a.tournamentdesc, a.playerid, a.place, a.numplayers, CASE WHEN b.numbountys IS NULL THEN 0 ELSE b.numbountys END AS NumBountys, a.numrebuys, a.buyinamount, a.rebuyamount, a.addonamount, a.numaddons 
                       FROM (SELECT r.tournamentid, t.tournamentdesc, r.playerid, r.place, np.numplayers, nr.numrebuys, t.buyinamount, t.rebuyamount, t.addonamount, na.numaddons 
                             FROM poker_result r INNER JOIN poker_tournament t ON r.tournamentid = t.tournamentid AND t.tournamentdate BETWEEN '2019-01-01' AND '2019-11-30' AND r.place > 0
                             INNER JOIN (SELECT r3.tournamentid, Count(*) AS NumPlayers
                                         FROM poker_result r3 INNER JOIN poker_tournament t3 ON r3.tournamentid = t3.tournamentid AND t3.tournamentdate BETWEEN '2019-01-01' AND '2019-11-30' WHERE r3.place > 0 GROUP BY r3.tournamentid) np ON r.tournamentid = np.tournamentid 
                             LEFT JOIN (SELECT r4.tournamentid, r4.playerid, Sum(r4.rebuycount) AS NumRebuys FROM poker_result r4 INNER JOIN poker_tournament t4 ON r4.tournamentid = t4.tournamentid AND t4.tournamentdate BETWEEN '2019-01-01' AND '2019-11-30' WHERE r4.place > 0 AND r4.rebuycount > 0 GROUP BY r4.tournamentid, r4.playerid) nr ON r.tournamentid = nr.tournamentid AND r.playerid = nr.playerid 
                             LEFT JOIN (SELECT tournamentid, playerid, Count(addonpaid) AS NumAddons FROM poker_result r7 WHERE addonpaid = 'Y' GROUP BY tournamentid, playerid) na ON r.tournamentid = na.tournamentid AND r.playerid = na.playerid) a 
                             LEFT JOIN (SELECT rb1.tournamentid, rb1.playerid, Count(bountyid) AS NumBountys FROM poker_result_bounty rb1 INNER JOIN poker_result r8 ON rb1.tournamentid = r8.tournamentid AND rb1.playerid = r8.playerid INNER JOIN poker_tournament t8 ON r8.tournamentid = t8.tournamentid AND t8.tournamentdate BETWEEN '2019-01-01' AND '2019-11-30' GROUP BY rb1.tournamentid, rb1.playerid) b ON a.tournamentid = b.tournamentid AND a.playerid = b.playerid) c 
                GROUP BY c.playerid) e ON d.id = e.playerid 
WHERE e.playerid IN (SELECT DISTINCT playerid FROM poker_result WHERE statuscode = 'F') 
ORDER BY Round(d.earnings, 0) DESC 