<?php
include "rental/database.php";

//tombol delete
if(isset($_POST['delete'])){
    $id = $_POST['id'];
  $delete = mysqli_query($db, "DELETE FROM booking_komik WHERE id='$_POST[id]'");
                              
if($delete){
      echo "<script>
              alert('Hapus data sukses!');
              document.location='laporankomik.php';
            </script>";
  } else {
      echo "<script>
              alert('Hapus data gagal!');
              document.location='laporankomik.php';
            </script>";
  }
}


if (isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $update = mysqli_query($db, "UPDATE booking_komik SET status='$status' WHERE id='$id'");

    if ($update) {
        echo "<script>
                alert('Update status sukses!');
                document.location='laporankomik.php';
              </script>";
    } else {
        echo "<script>
                alert('Update status gagal!');
                document.location='laporankomik.php';
              </script>";
    }
}
?>


