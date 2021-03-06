<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?=$this->siteTitle();?></title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?=SROOT?>public/css/bootstrap.min.css" media="screen" charset="utf-8">
        <link rel="stylesheet" href="<?=SROOT?>public/css/custom.css" media="screen" charset="utf-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
        <script src="<?=SROOT?>public/js/jquery_3.4.js"></script>
        <script src="<?=SROOT?>public/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

        <?= $this->content('head'); ?>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

                <a class="navbar-brand" href="<?=SROOT?>">DOUH HMS</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?=SROOT?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=SROOT?>home/about">About</a>
                        </li>
                        <?php if (LoginHelper::isAdmin()){?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=SROOT?>admin/userlist">User List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=SROOT?>patient/listing">Patient List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=SROOT?>nurse/listing">Nurse List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=SROOT?>doctor/listing">Doctor List</a>
                        </li>
                        <?php } if (!LoginHelper::isLoggedIn()) {?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=SROOT?>patient/register">Register</a>
                        </li>
                        <?php } ?>
                        <?php if (!LoginHelper::isACurrentDoctor() || !LoginHelper::isLoggedIn()) {?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=SROOT?>appointment/search">Book an appointment</a>
                        </li>
                        <?php } ?>
                        <?php if (LoginHelper::isLoggedIn()){?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=SROOT?>auth/logout">Logout</a>
                        </li>
                        <?php } elseif(!LoginHelper::isLoggedIn()) {?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=SROOT?>auth/login">Login</a>
                        </li>
                        <?php } ?>

                        <?php if (LoginHelper::isAdmin()) {?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=SROOT?>admin/index"><i class="fa fa-cog"></i>&nbsp;Admin</a>
                        </li>

                        <?php } elseif (LoginHelper::isACurrentDoctor()){?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=SROOT?>doctor/profile/<?php echo UserHelper::getCurrentLoggedInDoctor()->id?>"><i class="fa fa-user"></i>&nbsp;Dr. <?=UserHelper::getCurrentLoggedInDoctor()->name?> (Doctor)</a>
                            </li>
                        <?php }elseif (LoginHelper::isACurrentNurse()){?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=SROOT?>nurse/profile/<?php echo UserHelper::getCurrentLoggedInNurse()->id?>"><i class="fa fa-user"></i>&nbsp;<?=UserHelper::getCurrentLoggedInNurse()->name?> (Nurse)</a>
                        </li>
                        <?php }elseif (LoginHelper::isACurrentPatient()){?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=SROOT?>patient/profile/<?php echo UserHelper::getCurrentLoggedInPatient()->id?>"><i class="fa fa-user"></i>&nbsp;<?=UserHelper::getCurrentLoggedInPatient()->name?> (Patient)</a>
                            </li>
                        <?php }?>
                    </ul>
                </div>

        </nav>
        <div class="container">
            <?=$this->content('body')?>
        </div>
    </body>
</html>