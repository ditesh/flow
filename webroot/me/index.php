<?php

require_once "../../includes.php";

$data["name"] = "Ditesh Gathani";


RenderPrint::header("My Flow", array("me",
		"http://fonts.googleapis.com/css?family=Josefin+Sans:100,100italic,300,300italic,400,400italic,600,600italic,700,700italic",
		"http://fonts.googleapis.com/css?family=Raleway:100"
	));

RenderPrint::body("me", $data);
RenderPrint::footer(array("me"));
