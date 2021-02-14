<?php

function check_rate_limit($database, $ipaddr, $q) {
    $db = new \SQLite3($database);
    $db->exec("CREATE TABLE IF NOT EXISTS Access (ipaddr TEXT, address TEXT, retrieved_at DATETIME DEFAULT CURRENT_TIMESTAMP)");
    $db->exec("DELETE FROM Access WHERE retrieved_at <= date('now', '-1 day')");


    $stm = $db->prepare("SELECT address, julianday('now'), julianday(retrieved_at) FROM Access WHERE ipaddr = :ip ORDER BY retrieved_at DESC LIMIT 1");
    $stm->bindValue(':ip', $ipaddr, SQLITE3_TEXT);

    $res = $stm->execute();
    $row = $res->fetchArray(SQLITE3_NUM);

    $delta = 1000;
    if ( $row ) {
        $now = $row[1];
        $retrieved_at = $row[2];
        $delta = intval(($now - $retrieved_at) * (24*60*60));
    }

    $stm = $db->prepare('INSERT INTO Access (ipaddr, address) VALUES (:ip, :address);');
    $stm->bindValue(':ip', $ipaddr, SQLITE3_TEXT);
    $stm->bindValue(':address', $q, SQLITE3_TEXT);

    $res = $stm->execute();

    $db->close();

    return $delta;
}
