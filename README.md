PHP Pager data
=============
```PHP
$data = []; // generic php associative array, or json object;

//example with json
$data = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/posts'));

// init
$pager = new Pager($data);

// get labels
$pager->headers();

// get rows data
$pager->rows();

// get pagination
$pager->pagination();
```
