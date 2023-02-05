<?php

$defaultPage = "tiktok";
$requestedRoute = $_GET['page'] ?? null;
$file = $defaultPage;

switch ($requestedRoute) {
    case "tiktok":
        $file = $defaultPage;
        break;
    case "youtube":
        $file = "youtube";
        break;
    default:
        $file = $defaultPage;
}


include("./pages/" . $file . ".php");
