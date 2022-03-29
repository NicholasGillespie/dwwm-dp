<?php

// function to autoload class files
spl_autoload_register(function ($class) {
  require dirname(__DIR__) . "/classes/{$class}.php";
});

// starting session
session_start();

// require config.php for all the db configuration info
require dirname(__DIR__) . '/config.php';


// ERROR HANDLING
// errors generally for language level errors : synthax
// exceptions are the ones you get using Classes and $objects
// https: //www.php.net/manual/en/language.errors.php7.php

// Circumvent having to craete try catch block
// Create custom handlers that will catch and deal with uncaught errors & exceptions
// Pass function to the set_error_handler() and set_exception_handler()

// https://www.php.net/manual/en/function.set-error-handler.php
// https://www.php.net/manual/en/function.set-exception-handler.phps
// https://www.php.net/manual/en/class.errorexception.php
// https://www.php.net/manual/en/class.exception.php

function errorHandler($level, $message, $file, $line)
{
  throw new ErrorException($message, 0, $level, $file, $line);
}

function exceptionHandler($exception)
{
  if (SHOW_ERROR_DETAIL) {

    echo "<h1>An error occurred</h1>";
    echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
    echo "<p>" . $exception->getMessage() . "'</p>";
    echo "<p>Stack trace: <pre>" . $exception->getTraceAsString() . "</pre></p>";
    echo "<p>In file '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
  } else {
    echo "<h1>An error occurred</h1>";
    echo "<p>Please try again later.</p>";
  }
  exit();
}

set_error_handler('errorHandler');
set_exception_handler('exceptionHandler');
