<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TFF3-Installer</title>
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link rel="stylesheet" type="text/css" href="<?= $this->view['PAGEROOT'] ?>templates/skeleton/normalize.css" >
        <link rel="stylesheet" type="text/css" href="<?= $this->view['PAGEROOT'] ?>templates/skeleton/skeleton.css" >
        <style type="text/css">
            .stepper {
                padding-right: 1rem;
                padding-top:1.5rem;
                float:left;
            }
            .stactive {
                color:#afc;
                font-weight:bold;
            }
            .gpl {
                height:50rem;
                overflow:auto;
            }
            .footer {
                color:#fff;
                background:#000;
            }
            .main {
                min-height:100rem;
            }
            html {
                font-size:60.5%;
            }
            body {
                background:#466;
            }
            .container {
                background:#fff;
            }
            .mycontents {
                padding:1rem;
            }
            .kopf {
                background:#000;
                color:#fff;
                padding:1rem;
            }

        </style>
    </head>
    <body>
        <div clasS="kopf">
            <div class="row">
                <div class="two columns">
                    <a href="?" class="button button-primary">TFF3-Installer</a>
                </div>
                <div class="ten columns">
                    <?php foreach ($this->view['stepper'] as $row => $value): ?>
                    <span class="stepper<?php if ($row == $this->view['step']): ?> stactive <?php endif ?>">&bullet;<?= $value ?></span>
                    <?php endforeach; ?>


                </div>
            </div></div>
        <div class="container main"><div class="mycontents">
