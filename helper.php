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

function basePath($path)
{
  return __DIR__ . '/' . $path;
}


/***
 * Loadview file
 *
 *  @param string $name
 *  @param array $data
 *  @return void
 *
 * */

function loadView($name, $data = [])
{

  $viewPath = basePath("App/views/{$name}.view.php");
  if (file_exists($viewPath)) {
    extract($data);
    require $viewPath;
  } else {
    echo "Not found path: $viewPath";
  }
}


/*
 * Get partial file
 * @param string $name 
 * @return void
 * */


function loadPartial($name, $data = [])
{
  $partialPath = basePath("App/views/partials/{$name}.php");

  if (file_exists($partialPath)) {
    extract($data);
    require $partialPath;
  } else {
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


function inspect($value)
{

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


function inspectAndDie($value)
{

  echo "<pre>";
  die(var_dump($value));
  echo "</pre>";
}

/**
 *
 * Format salary
 *
 * @param string $salary
 * @return string
 * */

function formatSalary($salary)
{
  return "$" . number_format(floatval($salary));
}



/**
 *
 * sanitize special character data
 *
 * @param string $dirty
 * return string
 *
 * */

function sanitize($dirty)
{
  return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 *
 * Redirect 
 *
 * @param string $uri
 * @return void
 *
 * */

function redirect($uri)
{
  header("location: {$uri}");
  exit;
}
