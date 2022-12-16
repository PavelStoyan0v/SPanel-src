<?php
//DIRECTORIES
  //directory on the server - example("/somedir/"); default("/")
  define("MAIN_DIR", "/");

  //domain in format name.com; default("localhost")
  define("DOMAIN", "localhost");

  //protocol; default("http://")
  define("PROTOCOL", "http://");

  //root url
  define("ROOT_URL", PROTOCOL.DOMAIN.MAIN_DIR);


//MYSQL
  //host
  define("DB_HOST", "localhost");

  //user
  define("DB_USER", "root");

  //password
  define("DB_PASSWORD", "");

  //database
  define("DB_DATABASE", "spanelpw_root");
?>
