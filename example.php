<?php
require_once 'pager.class.php';
$data = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/posts'));
$pager = new Pager($data);
?>

<!DOCTYPE html>
<html>
<head>
<title>Pager</title>
</head>
<body>

    <table border="1">
        <thead>
            <tr>
            <?php
            foreach($pager->headers() as $label){
                echo '<th>'.$label.'</td>';
            }
            ?>
            </tr>
        </thead>
        <tbody>
            <?php 
            $html = '';
            foreach($pager->rows() as $row){
                $html .= '<tr>';
                    foreach($row as $key => $value){
                        $html .= '<td>'.$value.'</td>';
                    }
                $html .= '</tr>';
            } 
            print $html;
            ?>
        </tbody>
    </table>

    <nav>
        <ul>
            <?php foreach($pager->paginator() as $page){
                echo '<li><a href="'.$page['link'].'">'.$page['anchor'].'</a></li>';
            } ?>
        </ul>
    </nav>


</body>
</html>