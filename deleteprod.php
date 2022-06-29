<?php

require 'fx.php';

$id = $_GET["id"];

if (deleteprod($id) > 0)
{
    echo "
            <script>
                alert('Succeeded');
                document.location.href = 'admin.php';
            </script>
    ";
}
else
{
    echo "
            <script>
                alert('Failed');
                document.location.href = 'admin.php';
            </script>
    ";
}

?>