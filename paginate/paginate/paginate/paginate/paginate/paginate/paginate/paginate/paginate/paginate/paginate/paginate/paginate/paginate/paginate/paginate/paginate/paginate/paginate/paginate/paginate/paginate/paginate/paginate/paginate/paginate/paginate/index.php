<?php

require_once 'paginator.php';

$conn       = new mysqli( 'localhost', 'root', '', 'mycoregdb' );

$page      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 25;
$limit       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
$links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
$query      = "SELECT * FROM Other_Reg";

$Paginator  = new Paginator( $conn, $query );

$results    = $Paginator->getData( $page, $limit );

?>



<!DOCTYPE html>
    <head>
        <title>PHP Pagination</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
                <div class="col-md-10 col-md-offset-1">
                <h1>PHP Pagination</h1>
                <table class="table table-striped table-condensed table-bordered table-rounded">
                        <thead>
                                <tr>
                                <th>Serial</th>
                                <th>City</th>
                                <th width="20%">Country</th>
                                <th width="20%">Continent</th>
                                <th width="25%">Region</th>
                        </tr>
                        </thead>
                        <tbody>
                            
        <?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
        <tr>    
                <td><?= $i ?></td>
                <td><?php echo $results->data[$i]['Regulator']; ?></td>
                <td><?php echo $results->data[$i]['Gene_no']; ?></td>
                <td><?php echo $results->data[$i]['Annotation']; ?></td>
                <td><?php echo $results->data[$i]['Promoter_name']; ?></td>
        </tr>
        <?php endfor; ?>


                        </tbody>
                </table>
                </div>

        <?php echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?> 
        </div>
        </body>
</html>