<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fibonacci Sequence</title>
    <style>
        table{
            border-collapse: collapse;
        }

        table thead{
            background: #333;
            color: #efefef;
        }

        table tbody tr:nth-child(even){
            background: #aeaeae;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Sequence #</th>
                <th>Value</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            
            $num_0 = 0;
            $num_1 = 1;
            for( $i=0; $i<=10; $i++ ) {
                $sum = 0;

                if( $i < 2 ) {
                    $sum = $i;
                } else {
                    $sum = $num_0 + $num_1;
                    $num_0 = $num_1;
                    $num_1 = $sum;
                }
            ?>
                <tr>
                    <td>F<sub><?= $i ?></sub></td>
                    <td><?php echo $sum ?></td>
                </tr>
            <?php
            } 
            ?>
        </tbody>
    </table>
</body>
</html>