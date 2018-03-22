<?php $title = "Work with files" ?>
<?php require_once("../header.php"); ?>

<form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="csv">File input</label>
        <input type="file" id="csv" name="csv"/>
    </div>
    <input type="submit" id='csv' class="" value="Upload"/>
</form>

<?php
if (isset($_FILES["csv"])) {
    $myfile = $_FILES["csv"]["tmp_name"];
    $myfile_name = $_FILES["csv"]["name"];
    $myfile_size = $_FILES["csv"]["size"];
    $myfile_type = $_FILES["csv"]["type"];
    $error_flag = $_FILES["csv"]["error"];
    $fileExp = explode('.', $myfile_name);
    $fileActualExt = strtolower(array_pop($fileExp)); //extantion

    if ($fileActualExt != 'csv') {
        $result = "<div class=\"alert alert-warning\" role=\"alert\"> <strong>Warning!</strong> You cannot upload files of this type!</div>";
        echo $result;

        return false;
    }

    $uploaddir = '/temp/csv/';

    if (! is_dir($uploaddir)) {
        mkdir($uploaddir, 0700, true);
    }

    if ($error_flag == 0) {
        $uploadfile = $uploaddir . basename($_FILES['csv']['name']);

        if (copy($_FILES['csv']['tmp_name'], $uploadfile)) {
            Viewer($uploadfile);
        } else {
            echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>";
            exit;
        }
    }
}

function Viewer($uploadfile)
{
    $tract = $uploadfile;
    if (($handle = fopen($tract, "r")) !== false) {
        $val = "|";
        $head = "<table  class='table'>
                    <thead>
                        <tr>
                            <th class='cell-1'>Name</th>
                            <th class='cell-2'>Vendor code</th>
                            <th class='cell-3'> Trade price </th>
                            <th>Retail price</th>
                        </tr>
                    </thead>
                    <tbody>";
        $body = "";

        while (($data = fgetcsv($handle, 1000, $val)) !== false) {

            $float = $data[3] - floor($data[3]);
            $data[4] = (int)($data[3]) + 0.99;
            $data[5] = "";

            if ($float < 0.50) {
                $data[4] = $data[4] - 1;
                $data[5] = "alert alert-danger";
            }
            if ($float > 0.50) {
                $data[5] = "alert alert-success";
            }

            $body .= "<tr class='" . $data[5] . "'>";
            $body .=    "<td><span class='text-overflow'>" . $data[0] . "</span></td>
                         <td><span class='text-overflow'>" . $data[1] . "</span></td>
                         <td><span class='text-overflow'>" . $data[3] . "</span></td>
                         <td><span class='text-overflow'>" . $data[4] . "</span></td>";
            $body .= "</tr>";
        }

        $footer = "</tbody></table>";
        $table = $head . $body . $footer;
        echo $table;

        fclose($handle);
    }
    echo "<h6> File download (the size of the logfile: " . filesize($tract) . " bytes)</h6>";
}
?>

</body>
</html>
