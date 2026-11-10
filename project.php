<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum PHP</title>
</head>
<body>
    <?php
        $data = null;
        $error = [];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nama = trim($_POST["nama"] ?? "");
            $nim = trim($_POST["nim"] ?? "");
            $prodi = trim($_POST["prodi"] ?? "");
            $semesterInput = $_POST["semester"] ?? "";
            $email = trim($_POST["email"] ?? "");
            if ($nama === "") $error[] = "Nama wajib diisi.";
            if ($nim === "") {
                $error[] = "NIM wajib diisi.";
            } 
            if (!ctype_digit((string)$nim) || strlen($nim) < 9 || strlen($nim) > 9) {
                $error[] = "NIM harus berupa angka dan berisi 9 digit.";
            }
            if ($prodi === "") $error[] = "Program studi wajib diisi.";
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error[] = "Format email tidak valid.";
            }
            if (!ctype_digit((string)$semesterInput) || (int)$semesterInput < 1 || (int)$semesterInput > 14) {
                $error[] = "Semester harus berupa angka 1–14.";
            }
            if (!$error) {
                $data = compact("nama", "nim", "prodi", "email");
                $data["semester"] = (int)$semesterInput;
            }
        }
    ?>

    <form method="post" action="">
        <label>
            Nama
            <input type="text" name="nama">
        </label>
        <label>
            NIM
            <input type="text" name="nim">
        </label>
        <label>
            Program Studi
            <input type="text" name="prodi">
        </label>
        <label>
            Semester
            <input type="text" name="semester">
        </label>
        <label>
            Email
            <input type="text" name="email">
        </label>
        <button type="submit">Submit</button>
    </form>
    <?php 
    
    if (isset($error)){
        foreach ($error as $e){
            echo "<p>" . htmlspecialchars($e) ."</p>";
        }
    } if (isset($data)) {
        echo "<strong>Data Mahasiswa :</strong>";
        echo "<p>Nama :" . $data['nama'] . "</p>";
        echo "<p>NIM :" . $data['nim'] . "</p>";
        echo "<p>Program Studi :" . $data['prodi'] . "</p>";
        echo "<p>Semester :" . $data['semester'] . "</p>";
        echo "<p>Email :" . $data['email'] . "</p>";
        echo "<a href='{$_SERVER['PHP_SELF']}'><button type='button'>Reset Data</button></a>";
    }
    ?>
</body>
</html>