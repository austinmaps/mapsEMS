<?php 
//? READ THIS FIRST:
//? Author By: Austin Maps
//? each line of code i write a comment, this will be my explanation
//? for my code how really it work when backup our database 
//? i  write this comment because i dont know how to explain  in person

include 'session.php';
 
//? Get All Table Names From the Database
$tables = array();
$sql = "SHOW TABLES";
$result = mysqli_query($db, $sql);

while ($row = mysqli_fetch_row($result)) {
   $tables[] = $row[0];
}

$sqlScript = "";
foreach ($tables as $table) {
   
    //? Prepare SQLscript for creating table structure
   $query = "SHOW CREATE TABLE $table";
   $result = mysqli_query($db, $query);
   $row = mysqli_fetch_row($result);
   
   $sqlScript .= "\n\n" . $row[1] . ";\n\n";
   
   
   $query = "SELECT * FROM $table";
   $result = mysqli_query($db, $query);
   
   $columnCount = mysqli_num_fields($result);
   
  //? Prepare SQLscript for dumping data for each table
   for ($i = 0; $i < $columnCount; $i ++) {
       while ($row = mysqli_fetch_row($result)) {
           $sqlScript .= "INSERT INTO $table VALUES(";
           for ($j = 0; $j < $columnCount; $j ++) {
               $row[$j] = $row[$j];
               
               if (isset($row[$j])) {
                   $sqlScript .= '"' . $row[$j] . '"';
               } else {
                   $sqlScript .= '""';
               }
               if ($j < ($columnCount - 1)) {
                   $sqlScript .= ',';
               }
           }
           $sqlScript .= ");\n";
       }
   }
   
   $sqlScript .= "\n"; 
}

if(!empty($sqlScript))
{
 //? Save the SQL script to a backup file
   $backup_file_name = $database_name . '../backupDatabase/Backup_EMS' .   '.sql';
   $fileHandler = fopen($backup_file_name, 'w+');
   $number_of_lines = fwrite($fileHandler, $sqlScript);
   fclose($fileHandler); 

   //? Download the SQL backup file to the browser
   header('Content-Description: File Transfer');
   header('Content-Type: application/octet-stream');
   header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
   header('Content-Transfer-Encoding: binary');
   header('Expires: 0');
   header('Cache-Control: must-revalidate');
   header('Pragma: public');
   header('Content-Length: ' . filesize($backup_file_name));
   ob_clean();
   flush();
   readfile($backup_file_name);
   exec('rm ' . $backup_file_name); 
}

 ?>

