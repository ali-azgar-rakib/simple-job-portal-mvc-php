<?php

/**
*
* get the base path
*
* @param string $path
* @return string
*
*
* */

  function basePath($path){
  return __DIR__.'/'.$path;
}


/***
 * Loadview file
 *
 *  @param string $name
 *  @return void
 *
 * */

function loadView($name){

  $viewPath = basePath("views/{$name}.php");
  if(file_exists($viewPath)){
    require $viewPath;
  }else{
    echo "Not found path: $viewPath";
  }
}


/*
 * Get partial file
 * @param string $name 
 * @return void
 * */


function loadPartial($name){
  $partialPath = basePath("views/partials/{$name}.php");

  if(file_exists($partialPath)){
    require $partialPath;
  }else{
    echo "Not found path: $partialPath";
  }
}



/**
 *
 * Inspect value(s)
 *
 ** @param mixed $value 
 * @return void
 *
 *
 *
 * */


function inspect($value){

  echo "<pre>";
  var_dump($value);
  echo "</pre>";
}


/**
 *
 * Inspect value(s) and die
 *
 ** @param mixed $value 
 * @return void
 *
 *
 *
 * */


function inspectAndDie($value){

  echo "<pre>";
  die(var_dump($value));
  echo "</pre>";
}
