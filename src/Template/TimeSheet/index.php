<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Bootstrap 3, from LayoutIt!</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="img/favicon.png">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="#">Brand</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="#">Link</a>
                        </li>
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">Action</a>
                                </li>
                                <li>
                                    <a href="#">Another action</a>
                                </li>
                                <li>
                                    <a href="#">Something else here</a>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                    <a href="#">Separated link</a>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                    <a href="#">One more separated link</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text">
                        </div> <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">Action</a>
                                </li>
                                <li>
                                    <a href="#">Another action</a>
                                </li>
                                <li>
                                    <a href="#">Something else here</a>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                    <a href="#">Separated link</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </nav>
            <div class="row clearfix">

            <div class="col-md-12 column">
                <div class="panel-group" id="panel-timecard">
                <?php
                $panelContentClass = 'panel-collapse in';
                foreach ($timeCard as $monthlyTimeCard) :
                    $panelId = 'panel-element-' . $monthlyTimeCard['id'];
                ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                 <a class="panel-title" data-toggle="collapse" data-parent="#panel-timecard"
                                    href="#<?php echo $panelId;?>"
                                 ><?php echo $monthlyTimeCard['title'];?></a>
                            </div>
                            <div id="<?php echo $panelId;?>" class="<?php echo $panelContentClass;?>">
                                <div class="panel-body">
                                    <table class="table table-condensed table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>In</th>
                                                <th>Out</th>
                                                <th>In</th>
                                                <th>Out</th>
                                                <!-- <th>Daily Total</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ( $monthlyTimeCard['dates'] as $currentDate ) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo $currentDate->date->format('d/m/Y');?>
                                                </td>
                                                <td>
                                                   <input name="time_in_1" type="text"
                                                           value="<?php echo $currentDate->time_in_1;?>" />
                                                </td>
                                                <td>
                                                    <input name="time_out_1" type="text"
                                                           value="<?php echo $currentDate->time_out_1;?>" />
                                                </td>
                                                <td>
                                                    <input name="time_in_2" type="text"
                                                           value="<?php echo $currentDate->time_in_2;?>" />
                                                </td>
                                                <td>
                                                    <input name="time_out_2" type="text"
                                                           value="<?php echo $currentDate->time_out_2;?>" />
                                                </td>
                                                <!-- <td>08:56</td> -->
                                            </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <div class="panel-footer">
                                    <p>Total: <span class="text-info">200:00</span></p>
                                    <p>Overtime: <span class="text-success">10:00</span></p>
                                    <p>Negative: <span class="text-danger">10:00</span></p>
                                </div>
                                -->
                            </div>
                        </div>
                    <?php
                    $panelContentClass = 'panel-collapse collapse';
                    endforeach;
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>