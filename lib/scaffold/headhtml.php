<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF8">
<title>Jasphp Reports</title>
<link href="/css/main.css" rel="stylesheet" type="text/css">
<link href="/css/datepickercontrol.css" rel="stylesheet" type="text/css">
<link href="/css/bootstrap.css" media="screen" type="text/css" rel="stylesheet">
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px; /* 40px to make the container go all the way to the bottom of the topbar */
      }
      .container > footer p {
        text-align: center; /* center align it with the container */
      }
      .container {
        width: 830px; /* downsize our container to make the content feel a bit tighter and more cohesive. NOTE: this removes two full columns from the grid, meaning you only go to 14 columns and not 16. */
      }

      /* The white background content wrapper */
      .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; /* negative indent the amount of the padding to maintain the grid system */
        -webkit-border-radius: 0 0 6px 6px;
           -moz-border-radius: 0 0 6px 6px;
                border-radius: 0 0 6px 6px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

      /* Page header tweaks */
      .page-header {
        background-color: #f5f5f5;
        padding: 20px 20px 10px;
        margin: -20px -20px 20px;
      }

      /* Styles you shouldn't keep as they are for displaying this base example only */
      .content .span11,
      .content .span3 {
        min-height: 300px;
      }
      /* Give a quick and non-cross-browser friendly divider */
      .content .span3 {
        margin-left: 0;
        padding-left: 19px;
        border-left: 1px solid #eee;
      }

      .topbar-inner, .topbar .fill{
        background-color: #0064CD;
        background-image: none;
      }

      .topbar .btn {
        border: 0;
      }

    </style>
<script language="JavaScript" src="/js/jquery-1.7.min.js"></script>
<script language="JavaScript" src="/js/bootstrap-modal.js"></script>
<script language="JavaScript" src="/js/bootstrap-tabs.js"></script>
<script language="JavaScript" src="/js/bootstrap-datepicker.js"></script>
<script language="JavaScript" src="/js/jquery.tablesorter.min.js"></script>


<script language="JavaScript" src="/js/jasphp.js"></script>

</head>
<body>

<?php
require_once("../lib/db/Database.class.php");
include_once("../lib/scaffold/taghtml.php");
?>