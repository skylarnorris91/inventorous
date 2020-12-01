<?php
    session_start();
    $html = '<nav class="navbar navbar-light navbar-expand-md fixed-top navigation-clean-search">
            <div class="container"><a class="navbar-brand" href="#" style="color: #333333;">Inventorous</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div style="display: flex!important; justify-content: space-between" class="collapse navbar-collapse" id="navcol-1">';

    $loggedIn = isset($_SESSION['member_id']);

	if ($loggedIn) {
        $html .=
            '<ul class="nav navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            </ul>
            <a class="btn btn-light action-button" role="button" href="../logout.php" style="background: rgb(133,21,21);">
                Logout
            </a>';
    } else {
        $html .=
            '<ul class="nav navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#FAQ">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
            </ul>
            <a class="btn btn-light action-button" role="button" href="#login" style="background: rgb(133,21,21);">
                Login/Sign Up
            </a>';
    }

    $html .= '</div></div></nav>';

    echo $html;
?>