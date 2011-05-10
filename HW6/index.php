<?php
    require_once('classes.php');

    $v = new View(); // some class that implements the IView inteface
    $v->setPageTitle("Use case for the homework");
    $v->setJavascriptFolder("js");
    $v->setCSSFolder("styles");

    $v->addJavascriptFiles(array("jquery.js", "custom.js"));
    $v->addCSSFiles(array("jquery.css", "custom.css"));

    $v->assignTemplateVariable("message", "Hello!");

    $v->display("index.tpl");
?>
