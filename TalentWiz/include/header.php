<?php
include_once 'settings.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>TalentWiz</title>

        <!-- Modern UI framework: Bootstrap 5 (vendored locally so it never depends
             on CDN reachability / SRI in the browser) + Inter font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <link href="<?php echo URL ?>css/bootstrap.min.css?v=2" rel="stylesheet" type="text/css">

        <!-- jQuery upgraded 1.2.6 (2008) -> 3.7.1 so it's compatible with Bootstrap 5
             (the old version crashed Bootstrap: "n.Event is not a function").
             jQuery Migrate restores APIs the legacy pages relied on. The original
             1.2.6 is preserved at scripts/jquery-1.2.6-legacy.min.js. -->
        <script src="<?php echo URL ?>scripts/jquery-3.7.1.min.js" type="text/javascript"></script>
        <script src="<?php echo URL ?>scripts/jquery-migrate-3.4.1.min.js" type="text/javascript"></script>

        <!-- Legacy date picker & wizard styles still used by some pages -->
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo URL ?>scripts/calender/jsDatePick_ltr.min.css" />
        <script type="text/javascript" src="<?php echo URL ?>scripts/calender/jsDatePick.min.1.3.js"></script>
        <link rel="stylesheet" href="<?php echo URL ?>scripts/steps/demo/css/jquery.steps.css" />
        <script src="<?php echo URL ?>scripts/steps/lib/jquery.cookie-1.3.1.js"></script>
        <script src="<?php echo URL ?>scripts/steps/build/jquery.steps.js"></script>

        <!-- Legacy + modern theme layer (modern.css overrides the old look).
             ?v= cache-buster: bump when these files change so browsers reload them. -->
        <link href="<?php echo URL ?>css/siteStyle.css?v=2" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL ?>css/modern.css?v=2" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="mainContainer">
            <!-- Branded header -->
            <header class="tw-header py-3">
                <div class="container d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <a href="<?php echo URL ?>" class="tw-brand text-decoration-none">
                        <span><span class="t">T</span><span class="alent">alent</span><span class="w">W</span><span class="iz">iz</span></span>
                    </a>
                    <div class="tw-welcome text-end">
                        <?php if (isset($_SESSION["userid"])) { ?>
                            Welcome, <strong><?php echo ucfirst($_SESSION['userid']); ?></strong>
                            &nbsp;<a class="btn btn-sm btn-outline-secondary" href="<?php echo URL ?>logout.php">Sign Out</a>
                        <?php } else { ?>
                            Welcome, <strong>Guest</strong>
                            &nbsp;<a class="btn btn-sm btn-primary" href="<?php echo URL ?>guest/login.php">Sign In</a>
                        <?php } ?>
                    </div>
                </div>
            </header>

            <!-- Primary navigation -->
            <nav class="navbar navbar-expand-lg tw-nav">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#twMainNav" aria-controls="twMainNav"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="twMainNav">
                        <?php include_once 'topmenu.php'; ?>
                    </div>
                </div>
            </nav>

            <!-- Page content shell (pages render into #containerInner; footer closes these) -->
            <div id="containerOuter">
                <div id="containerInner">
