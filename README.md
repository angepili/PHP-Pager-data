PHP Pager data
=============
```PHP
$data = ''; // generic php associative array, or json object;

// init
$pager = new Pager($data);

// get labels
$pager->headers();

// get rows data
$pager->rows();

// get pagination
$pager->pagination();
```
