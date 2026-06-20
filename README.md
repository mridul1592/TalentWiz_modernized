# TalentWiz (Modernized)

An online test & recruitment web application — candidates register, browse jobs,
take timed MCQ / true-false tests and get auto-scored; admins/operators manage
questions, jobs, colleges, geography, discussions and feedback.

Originally a hand-written PHP/MySQL college project (2014). This repository is the
**modernized** snapshot: the same application, made to run on modern PHP.

## What was modernized

The original code was written against the `mysql_*` extension, which was deprecated
in PHP 5.5 and **removed in PHP 7**, so the app no longer ran on any current runtime.

- **`TalentWiz/include/mysql_compat.php`** — a compatibility shim that re-implements
  the legacy `mysql_*` API (`mysql_connect`, `mysql_query`, `mysql_fetch_assoc`,
  `mysql_fetch_array`, `mysql_num_rows`, `mysql_result`, `mysql_insert_id`,
  `mysql_select_db`, `mysql_error`) on top of **mysqli**. It is guarded by
  `function_exists('mysql_connect')`, so it stays dormant on old PHP 5.x and activates
  on PHP 7/8. None of the ~250 original call sites needed editing.
- **`TalentWiz/include/settings.php`** — includes the shim, and derives the `URL` /
  `PATH` constants from the request at runtime (with the original hard-coded values as
  a fallback) so the app is portable instead of pinned to one absolute path.

## Running it

Requirements: PHP (5.4+ or 7/8 with the `mysqli` extension) and MySQL/MariaDB.

1. Create the database and import the schema:
   ```sh
   mysql -u root -e "CREATE DATABASE IF NOT EXISTS talentwiz"
   mysql -u root talentwiz < talentwiz.sql
   ```
2. Adjust DB credentials at the top of `TalentWiz/include/settings.php` if needed
   (defaults: host `localhost`, user `root`, empty password).
3. Serve the project with a real web server (Apache/Nginx) pointed so that the
   `TalentWiz/` folder is reachable, then browse to `…/TalentWiz/index.php`.

   > Note: PHP's built-in server (`php -S`) is unstable on the legacy PHP 5.4.3
   > Windows build (segfaults on startup) — use Apache or a modern PHP for that.

## Known limitations (inherited from the original)

This is a faithful modernization of a 2014 project, not a security rewrite. The
following pre-existing issues remain and should be addressed before any real use:

- SQL queries interpolate user input directly (SQL injection); no prepared statements.
- Passwords are stored and compared in plaintext.
- `header('Location: …')` redirects are not followed by `exit`, weakening access control.
- User-supplied content is echoed without escaping (XSS).
