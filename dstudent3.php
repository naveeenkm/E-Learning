<?php
include 'connect.php';?>
<?php 
    if (isset($_GET['id']) && is_array($_GET['id'])) {
        $id1 = $_GET['id'][0];
        $id2 = $_GET['id'][1];
        
    }
    ?>
 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style1.css">
    <style>
         .x
        {
            background-color: transparent;
            border-radius: 20px;
    backdrop-filter: blur(500px);
            position: absolute;
            top: 282px; 
            left: 30%;
            
            color: black;
            padding: 2%;
            top: 10%; 
            left: 200px;
            right: 403px;
            
        }
        .x button{
            width: 100%;
    height: 34px;
    border-radius: 40px;
    background-color: rgb(98, 81, 238,1);
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.4s ease;
        }
        .q1
        {
            margin-top: -655px;
    margin-right: -1290px;
            width: 13%;
    height: 52px;
    border-radius: 40px;
    background-color: #6c5bfd;
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.4s ease;
        }
        button:hover {
  background-color: rgb(255, 255,255, 0.5);
} 
    </style>
    
</head>

<body>
<div class="x">

<form action="dstudent3.php" method="GET">
   
<input type="hidden" name="id[]" value="<?php echo $id1; ?>">
    <input type="hidden" name="id[]" value="<?php echo $id2; ?>">
    <h5>Enter your student id:</h5>
    <input type="number" name="courseid" placeholder="Enter the student id here :"><br><br>
    <button type="submit">Submit</button><br><br>
</form>
<?php
$id=0;
            if (isset($_GET['courseid'])) {
                
                
                $courseid = $_GET['courseid'];
            $sql="SELECT s.*, GROUP_CONCAT(ssp.student_phno) AS phone_numbers, e.course_id
            FROM student s
            LEFT JOIN student_student_phno ssp ON s.student_id = ssp.student_id
            LEFT JOIN enrolls e ON s.student_id = e.student_id
            WHERE s.student_id = $courseid
            GROUP BY s.student_id, e.course_id;";
            $result=mysqli_query($con,$sql);



            
            if($result){
                $row=mysqli_fetch_array($result);
                

                $id= is_array($row) && !empty(array_filter($row)) ? 1 : 0;


                if($id)
                {
                echo '<table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">student_id</th>
                    <th scope="col">first name</th>
                    <th scope="col">last name</th>
                    <th scope="col">student age</th>
                    <th scope="col">student gender</th>
                    <th scope="col">student phone numbers</th>
                    <th scope="col">course id</th>
                    
                    
            </tr>
        </thead>
        <tbody>';
          
        $courseid = $_GET['courseid'];
        $sql="SELECT s.*, GROUP_CONCAT(ssp.student_phno) AS phone_numbers, e.course_id
        FROM student s
        LEFT JOIN student_student_phno ssp ON s.student_id = ssp.student_id
        LEFT JOIN enrolls e ON s.student_id = e.student_id
        WHERE s.student_id = $courseid
        GROUP BY s.student_id, e.course_id;";
        $result=mysqli_query($con,$sql);

               while( $row=mysqli_fetch_array($result)){
                $fid = $row["student_id"];
                $fname = $row["fname"];
                $fage = $row["lname"];
                $fexp = $row["student_age"];
                $fexp1 = $row["student_gender"];
                $fexp2 = $row["phone_numbers"];
                $fexp3 = $row["course_id"];
                

                echo '<tr>
                        <th scope="row">' . $fid . '</th>
                        <td>' . $fname . '</td>
                        <td>' . $fage . '</td>
                        <td>' . $fexp . '</td>
                        <td>' . $fexp1 . '</td>
                        <td>' . $fexp2. '</td>
                        <td>' . $fexp3 . '</td>
                       
                        
                            
                       
              
               
           </tr>';

               }
            
           
        }
        else{
            echo $courseid. ' student  id not exisits...<br>';
            echo 'enter onther one';
        }
    }
        }
     ?>

            </tbody>
            
        </table><br>
<?php if (isset($_GET['courseid'])) { echo '<button class="z" ><a href="zstudent.php?deleteid=' . $fid . '&id[]=' . $id1 . '&id[]=' . $id2 . '"
                            class="text-light " >Delete</a></button>';}?>
</div>
<?php
            if (isset($_GET['courseid'])) {
                echo '<button class="q1" onclick="window.location.href=\'entity.php?id[]=' . $id1 . '&id[]=' . $id2 . '\'">Logout</button>';


            }
            else
            {
                echo '<button class="q1" onclick="window.location.href=\'entity.php?id[]=' . $id1 . '&id[]=' . $id2 . '\'">Cancel</button>'; 
            }
            
            
            ?>
        <section>

    
    
        </section>
    
</body>

</html>
