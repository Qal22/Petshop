<?php
    
    $conn = mysqli_connect("localhost","root","","petshop");
    
    function query($query)
    {
        global $conn;
        
        $result  = mysqli_query($conn,$query);
        
        $rows = [];
        
        while ($row = mysqli_fetch_assoc($result))
        {
            $rows[] = $row;
        }
        
        return $rows;
    }

    function addprod($data)
    {
        global $conn;

        $name = $data["name"];
        $type = $data["type"];
        $quantity = $data["quantity"];
        $price = $data["price"];

        $imageprod = upload();
        if (!$imageprod)
        {
            return false;
        }

        $query = "INSERT INTO product VALUES ('$name','','$type',$quantity,$price,'$imageprod')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function upload()
    {
        $filename = $_FILES['imageprod']['name'];
        $filesize = $_FILES['imageprod']['size'];
        $error = $_FILES['imageprod']['error'];
        $filetmpname = $_FILES['imageprod']['tmp_name'];

        if ($error === 4)
        {
            echo "<script> alert('Image not Uploaded'); </script>";

            return false;
        }

        $fileextensionallowed = ['jpg','jpeg','png'];
        $fileextension = explode('.',$filename);
        $fileextension = strtolower(end($fileextension));

        if (!in_array($fileextension,$fileextensionallowed))
        {
            echo "<script> alert('Not a image file Uploaded'); </script>";

            return false;
        }

        if ($filesize > 5000000)
        {
            echo "<script> alert('Image file too big'); </script>";

            return false;
        }

        $newfilename = uniqid();
        $newfilename .= '.';
        $newfilename .= $fileextension;
        move_uploaded_file($filetmpname,'' .  $newfilename);

        return $newfilename;
    }

    function deleteprod($id)
    {
        global $conn;

        mysqli_query($conn, "DELETE FROM product WHERE prod_id = $id");

        return mysqli_affected_rows($conn);
    }

    function updateprod($data)
    {
        global $conn;

        $prod_id = $data["prod_id"];
        $name = $data["name"];
        $type = $data["type"];
        $quantity = $data["quantity"];
        $price = $data["price"];
        $oldimg = $data["oldimg"];

        if ($_FILES['imageprod']['error'] === 4)
        {
            $imageprod = $oldimg;
        }
        else
        {
            $imageprod = upload();
        }

        $query = "UPDATE product SET
                    name = '$name',
                    type = '$type',
                    quantity = $quantity,
                    price = $price,
                    imageprod = '$imageprod'
                    WHERE prod_id = $prod_id
        ";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function searchprod($keyword)
    {
        $query = "SELECT * FROM product WHERE name LIKE '%$keyword%'";

        return query($query);
    }

    function buyprod($data)
    {
        global $conn;

        $cust_name = $data["cust_name"];
        $address = $data["address"];
        $num_phone = $data["num_phone"];
        $prod_id = $data["prod_id"];
        $quantity = $data["quantitybuy"];
        $total_price = $data["price"] * $data["quantitybuy"];

        $query = "INSERT INTO sales_record VALUES ('$cust_name','','$address','$num_phone',$prod_id,$quantity,$total_price)";

        mysqli_query($conn, $query);

        $oldquantity = $data["quantity"];

        $updatedquantity = $oldquantity - $quantity;

        $query = "UPDATE product SET quantity = $updatedquantity WHERE prod_id = $prod_id";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }