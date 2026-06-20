<?php
$utype = isset($_SESSION["usertype"]) ? $_SESSION["usertype"] : null;

if ($utype == "admin" || $utype == "operator") {
    ?>
    <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="<?php echo URL ?>admin/">Home</a></li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Manage</a>
            <ul class="dropdown-menu">
                <?php if ($utype == "admin") { ?>
                    <li><a class="dropdown-item" href="<?php echo URL ?>admin/geographicInformation/manageCountries.php">Geographic Information</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>admin/manageUsers.php">Users</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>admin/candidate/manageCandidate.php">Candidates</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>admin/faq/manageFAQ.php">FAQ's</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>admin/sq/manageSQ.php">Security Questions</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>admin/college/manageCollege.php">Colleges</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>admin/discussion/manageDiscussion.php">Discussions</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>admin/feedback/manageFeedback.php">Feedback</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>admin/request/manageRequest.php">Request</a></li>
                <?php } else { ?>
                    <li><a class="dropdown-item" href="<?php echo URL ?>admin/faq/manageFAQ.php">FAQ's</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>admin/college/manageCollege.php">Colleges</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>admin/discussion/manageDiscussion.php">Discussions</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>admin/feedback/manageFeedback.php">Feedback</a></li>
                <?php } ?>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Questions</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo URL ?>admin/questions/manageCategory.php">Question Category</a></li>
                <li><a class="dropdown-item" href="<?php echo URL ?>admin/questions/manageQuestions.php">Question Bank</a></li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Account</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo URL ?>admin/account/manageProfile.php">Profile</a></li>
                <li><a class="dropdown-item" href="<?php echo URL ?>admin/account/changePassword.php">Change Password</a></li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Jobs</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo URL ?>admin/jobs/manageJobs.php">Job openings</a></li>
            </ul>
        </li>
    </ul>
    <?php
} else if ($utype == "candidate") {
    if (!isset($_SESSION['jobid'])) {
        ?>
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="<?php echo URL ?>candidate/">Home</a></li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Account</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo URL ?>candidate/account/manageProfile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>candidate/account/changePassword.php">Change Password</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Feedback &amp; Requests</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo URL ?>candidate/feedback/sendFeedback.php">Give Feedback</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>candidate/feedback/sendRequest.php">Request</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Jobs</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo URL ?>candidate/jobs/searchJobs.php">Search Jobs</a></li>
                    <li><a class="dropdown-item" href="<?php echo URL ?>candidate/jobs/result.php">Results</a></li>
                </ul>
            </li>

            <li class="nav-item"><a class="nav-link" href="<?php echo URL ?>candidate/faq.php">FAQ's</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo URL ?>candidate/discussion/viewDiscussion.php">Discussion Forum</a></li>
        </ul>
        <?php
    }
    /* When a test is in progress ($_SESSION['jobid'] set) the nav is intentionally
       hidden so the candidate can't navigate away mid-exam. */
} else {
    ?>
    <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="<?php echo URL ?>guest/index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo URL ?>guest/faq.php">FAQ's</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo URL ?>aboutUs.php">About Us</a></li>
    </ul>
<?php } ?>
