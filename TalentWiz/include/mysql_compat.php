<?php

/*
 * mysql_compat.php
 *
 * Compatibility shim that re-implements the legacy mysql_* API on top of
 * mysqli. The original TalentWiz code (2014) was written against the mysql_*
 * extension, which was deprecated in PHP 5.5 and REMOVED in PHP 7. This shim
 * lets the unchanged application code run on modern PHP (7/8) as well as the
 * old PHP 5.x runtime, without touching the ~250 call sites.
 *
 * Only the functions actually used by the project are implemented:
 *   mysql_connect, mysql_select_db, mysql_query, mysql_error,
 *   mysql_fetch_assoc, mysql_fetch_array, mysql_num_rows,
 *   mysql_result, mysql_insert_id
 *
 * All calls in the codebase use the implicit "last opened connection" form
 * (no link argument), so we track a single connection in a global.
 */

// Only define these when the real mysql_* extension is absent (PHP 7+).
if (!function_exists('mysql_connect')) {

    $GLOBALS['__mysqli_link'] = null;

    function mysql_connect($host, $username, $password) {
        // Suppress the connection warning; original code checks the return value.
        $link = @mysqli_connect($host, $username, $password);
        if ($link) {
            $GLOBALS['__mysqli_link'] = $link;
        }
        return $link;
    }

    function mysql_select_db($dbname, $link = null) {
        $link = $link ?: $GLOBALS['__mysqli_link'];
        if (!$link) {
            return false;
        }
        return mysqli_select_db($link, $dbname);
    }

    function mysql_query($query, $link = null) {
        $link = $link ?: $GLOBALS['__mysqli_link'];
        if (!$link) {
            return false;
        }
        return mysqli_query($link, $query);
    }

    function mysql_error($link = null) {
        $link = $link ?: $GLOBALS['__mysqli_link'];
        return $link ? mysqli_error($link) : mysqli_connect_error();
    }

    function mysql_fetch_assoc($result) {
        if (!($result instanceof mysqli_result)) {
            return false;
        }
        return mysqli_fetch_assoc($result);
    }

    function mysql_fetch_array($result, $type = MYSQLI_BOTH) {
        if (!($result instanceof mysqli_result)) {
            return false;
        }
        return mysqli_fetch_array($result, $type);
    }

    function mysql_num_rows($result) {
        if (!($result instanceof mysqli_result)) {
            return 0;
        }
        return mysqli_num_rows($result);
    }

    function mysql_insert_id($link = null) {
        $link = $link ?: $GLOBALS['__mysqli_link'];
        return $link ? mysqli_insert_id($link) : 0;
    }

    /*
     * mysql_result($result, $row, $field) — every call in the codebase uses
     * a numeric row offset and column index 0. We support a numeric or named
     * field for completeness.
     */
    function mysql_result($result, $row, $field = 0) {
        if (!($result instanceof mysqli_result)) {
            return false;
        }
        if (!mysqli_data_seek($result, $row)) {
            return false;
        }
        $data = mysqli_fetch_array($result, MYSQLI_BOTH);
        if ($data === null || $data === false) {
            return false;
        }
        return isset($data[$field]) ? $data[$field] : false;
    }
}
