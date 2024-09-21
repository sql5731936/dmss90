
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>رفع وعرض الصورة</title>
</head>
<body>
    <!-- نموذج لرفع الصورة -->
    <form action="kimiimage.php" method="post" enctype="multipart/form-data">
        <label for="name">الاسم:</label>
        <input type="text" name="name" id="name" ><br>

        <label for="age">العمر:</label>
        <input type="text" name="age" id="age" ><br>

        <label for="image">الصورة:</label>
        <input type="file" name="image" ><br>

        <input type="submit" value="رفع الصورة">
    </form>

    <hr>

    <!-- عرض الصورة المحملة -->
    <h2>الصورة المحملة:</h2>
   
</body></html>

<?php

/*
//3. قم بإنشاء ملف PHP بإسم "upload_image.php" لحفظ الصورة في قاعدة البيانات:

//require_once 'database.php';
$host = "localhost";
$username = "root";
$password = "";
$dbname = "kimiimage";
$conn = mysqli_connect($host, $username, $password, $dbname);
// التحقق من أن تم تحميل الصورة بنجاح
if (isset($_FILES['image'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $imageName = $_FILES['image']['name'];
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

    // استعلام SQL لإدخال الصورة في قاعدة البيانات
    $sql = "INSERT INTO images (name, age, image) VALUES ('$name', '$age', '$image')";
    if ($conn->query($sql) === TRUE) {
        echo "تم تحميل وحفظ الصورة بنجاح.";
    } else {
        echo "حدث خطأ في التحميل والحفظ: " . $conn->error;
    }
}
if(isset($_GET['id']))
{
$delete=mysqli_query($conn, "DELETE FROM images where id=".$_GET['id'] );

}
$select =mysqli_query($conn, "SELECT * FROM images ");
echo '<table border="3" style="column-rule-color: aqua;"> <tr> <th>id</th> <th>name</th> <th>age</th> <th>image</th> </tr>'; 
while($row=mysqli_fetch_assoc($select))
{echo'<tr>';echo "<td> " . $row['id'] . "</td>";echo "<td> " . $row['name'] . "</td>";echo "<td> " . $row['age'] . "</td>";
    echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='الصورة المحملة' width='100' height='100'></td>";
    echo " <td><a href='kimiimage.php?id=" . $row['id'] . "' >delete</a> </td> ";
    echo " <td><a href='index.html'>index</a> </td> </tr>";

}echo'
</table>';



*/
?>










<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "kimiimage";
$conn = mysqli_connect($host, $username, $password, $dbname);

// Adding a record
if(isset($_POST['add'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $image = $_FILES['image']['tmp_name'];
    $imageData = addslashes(file_get_contents($image));

    $sql = "INSERT INTO images (name, age, image) VALUES ('$name', '$age', '$imageData')";
    mysqli_query($conn, $sql);
}
if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $image = $_FILES['image']['tmp_name'];
    $image = addslashes(file_get_contents($image));
    $sql = "UPDATE images SET name='$name', age='$age',image='$image' WHERE id=$id";
    mysqli_query($conn, $sql);
   
              
    }

// Displaying records
$sql = "SELECT * FROM images";
$result = mysqli_query($conn, $sql);

// Modifying a record
if(isset($_POST['edit'])) {
    $id = $_POST['edit_id'];
    $name = $_POST['edit_name'];
    $age = $_POST['edit_age'];

    $sql = "UPDATE images SET name='$name', age='$age',image='$image' WHERE id=$id";
    mysqli_query($conn, $sql);
}

// Searching for a record
if(isset($_POST['search'])) {
    $searchTerm = $_POST['search_term'];
    $sql = "SELECT * FROM images WHERE id LIKE '$searchTerm'";
    $result = mysqli_query($conn, $sql);
}
?>

<!-- HTML code -->
<!DOCTYPE html>
<html>
<head>
    <title>Image Table</title>
</head>
<body>
    <h1>Add Image</h1>
    <form method="POST" enctype="multipart/form-data">
    <input type="text" name="id" placeholder="id">
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="age" placeholder="Age">
        <input type="file" name="image">
        <input type="submit" name="add" value="Add">
        <input type="submit" name="update" value="update">
    </form>

    <h1>Images Gallery</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>" width="100" height="100"></td>
            <td>
                <form method="POST"   enctype="multipart/form-data">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <input type="text" name="edit_name" placeholder="Name" value="<?php echo $row['name']; ?>">
                    <input type="text" name="edit_age" placeholder="Age" value="<?php echo $row['age']; ?>">
                    <input  name="image" value="<?php base64_encode($row['image']); ?>">
                    <input type="submit" name="edit" value="Edit">
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>

    <h1>Search Image</h1>
    <form method="POST">
        <input type="text" name="search_term" placeholder="Search by Name">
        <input type="submit" name="search" value="Search">
    </form>
</body>
</html>
```






