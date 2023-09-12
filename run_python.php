<?php
// Get the document root path
$documentRoot = $_SERVER['DOCUMENT_ROOT'];

// Define the relative path to your Python script
$relativeScriptPath = '/final_repo_S7/Python/phpdb.py';

// Construct the absolute path to the Python script
$absoluteScriptPath = $documentRoot . $relativeScriptPath;

// Execute the Python script using the system command
exec("python $absoluteScriptPath");
?>
