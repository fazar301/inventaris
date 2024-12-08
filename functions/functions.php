<?php  
    $db = mysqli_connect('localhost','root','','inventaris');

    function select($query){
        global $db;

        $results = [];
        $fetch = mysqli_query($db, $query);

        while($result = mysqli_fetch_assoc($fetch)){
            $results[] = $result;
        }
        return $results;
    }

    function basic_operation($query){
        global $db;

        mysqli_query($db,$query);

        return mysqli_affected_rows($db);
    }

    function upload(){
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $tmpLoc = $_FILES['gambar']['tmp_name'];

        $validExt = ['jpg','jpeg','png'];
        $gambarExt = strtolower(end(explode('.',$namaFile)));

        if(!in_array($gambarExt,$validExt)){
            $error = ["error" => true, "message" => "Pilih format gambar yang valid!"];
            return $error;
        }else if($ukuranFile > 10000000){
            $error = ["error" => true, "message" => "Ukuran gambar lebih besar dari 10mb"];
            return $error;
        }
        
        $uid = uniqid();
        $namaFileBaru = $uid . '.' . $gambarExt;
        
        move_uploaded_file($tmpLoc,'img/' . $namaFileBaru);
        return $namaFileBaru;
    }

    // start of barang funtions

    function insert_barang($data){
        global $db;
        
        $nama = htmlspecialchars($data['nama_barang']);
        $kategori = htmlspecialchars($data['kategori']);
        $supplier = htmlspecialchars($data['supplier']);
        $stok = htmlspecialchars($data['stok']);
        $harga = htmlspecialchars($data['harga']);

        // upload gambar
        $gambar = upload();
        if(isset($gambar['error'])){
            return $gambar;
        }
        

        mysqli_query($db, "INSERT INTO barang(nama,kategori,supplier,stok,harga,gambar) VALUES('$nama','$kategori','$supplier',$stok,$harga,'$gambar')");
        

        return mysqli_affected_rows($db);
    }

    function update_barang($data,$id){
        global $db;
        
        $nama = htmlspecialchars($data['nama_barang']);
        $kategori = htmlspecialchars($data['kategori']);
        $supplier = htmlspecialchars($data['supplier']);
        $stok = htmlspecialchars($data['stok']);
        $harga = htmlspecialchars($data['harga']);
        
        if(isset($_FILES['gambar'])){
            // upload gambar
            $gambar = upload();
            if(isset($gambar['error'])){
                return $gambar;
            }
        }

        mysqli_query($db, "UPDATE barang SET nama='$nama', kategori='$kategori', supplier='$supplier', stok=$stok, harga=$harga, gambar='$gambar' WHERE id = $id");

        return mysqli_affected_rows($db);
    }

    // end of barang functions

    function update_role($data,$id){
        global $db;

        $role = $data['role'];

        mysqli_query($db, "UPDATE user SET role='$role' WHERE id = $id");
        return mysqli_affected_rows($db);
    }
?>