<?php

function check_rate_limit($database, $ipaddr, $q) {

    if ( ! is_string($ipaddr) ) return 1;
    $db = false;
    try {
        $db = new \SQLite3($database);
        $db->enableExceptions(true);
        $db->exec("CREATE TABLE IF NOT EXISTS Access (ipaddr TEXT UNIQUE, retrieved_at DATETIME DEFAULT CURRENT_TIMESTAMP)");
        $db->exec("DELETE FROM Access WHERE retrieved_at <= date('now', '-1 day')");

        $stm = $db->prepare("SELECT julianday('now'), julianday(retrieved_at) FROM Access WHERE ipaddr = :ip ORDER BY retrieved_at DESC LIMIT 1");
        $stm->bindValue(':ip', $ipaddr, SQLITE3_TEXT);

        $res = $stm->execute();
        $row = $res->fetchArray(SQLITE3_NUM);

        $delta = 1000;
        if ( $row ) {
            $now = $row[0];
            $retrieved_at = $row[1];
            $delta = intval(($now - $retrieved_at) * (24*60*60));
        }

        $stm = $db->prepare("INSERT OR REPLACE INTO Access (ipaddr, retrieved_at) VALUES (:ip, datetime('now'));");
        $stm->bindValue(':ip', $ipaddr, SQLITE3_TEXT);

        $res = $stm->execute();

    } catch(\Exception $e) {
       error_log("check_rate_limit error ".$e->getMessage());
       $delta = 1;
    }

    if ( $db ) $db->close();

    return $delta;
}

function filter_bad_things($address, $ipaddr) {
    if ( strlen($address) < 1 && strlen($address) > 120 ) {
       echo('{ "address": "length", "answer" : 42 }');
       error_log("geo_fail_length $ipaddr $address");
       return true;
    }

    for($i=0; $i<strlen($address); $i++) {
        $ch = substr($address, $i, 1);
        if ( ord($ch) < 32 ) {
           echo('{ "address": "npc", "answer" : 42 }');
           error_log("geo_fail_npc $ipaddr $address");
           return true;
        }
    }

    $badthings = array(
        'Address', 'scrapy.org', 'HTTP',
        "\r", "\n", "http", "https",
    );
    foreach($badthings as $badthing) {
        if ( strpos($address, $badthing) !== false ) {
           echo('{ "address": "fail", "answer" : 42 }');
           error_log("geo_fail_hack $ipaddr $address");
           return true;
        }
    }
    return false;
}

