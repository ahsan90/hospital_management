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

        <?= $this->content('head'); ?>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">

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
                            <a class="nav-link" href="<?=SROOT?>doctorcontroller/listing">Doctor List</a>
                        </li>

                    </ul>
                </div>

        </nav>
        <div class="container">
            <?=$this->content('body')?>
        </div>
    </body>
</html>