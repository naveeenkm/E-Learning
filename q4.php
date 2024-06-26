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
    <title>Page with Header and Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(img.jpg);
        }

        header {
            background-color: #1a444b;
            backdrop-filter: blur(150px);
            color: white;
            padding: 54px;
            text-align: center;
        }

        

        button{
            width: 10%;
            height:50px;
        }
        .icon{
          position: absolute;
            top: 34px; 
            right: 5px;
        }
        .x1
        {
            background-color: transparent;
            border-radius: 20px;
    backdrop-filter: blur(120px);
            position: absolute;
            top: 282px; 
            left: 30%;
            
            color: black;
            padding: 2%;
            
        }
        .x1 button{
            width: 32%;
    height: 40px;
    border-radius: 40px;
    background-color: rgb(98, 81, 238,1);
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.4s ease;
        }
        .x2
        {
            background-color: transparent;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
    backdrop-filter: blur(120px);
            position: absolute;
            top: 235px; 
            left: 0px;
            
            color: black;
            padding: 9px;
            height: 900px;
            width:290px;
        }
        .x2 button{
            width: 100%;
    height: 129px;
    border-radius: 10px;
    background-color:rgb(25, 0, 226,1);
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.4s linear(-0.39 -30.59%, 1.26 108.82%);
    
        }
        .a{
            text-decoration: none;
            color: white;
        }
       
        section{
            min-height: 100vh;
            background-image: url(img3.webp);
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
        }
        button {
    width: 10%;
    height: 52px;
    border-radius: 40px;
    background-color: rgb(255, 255,255, 1);
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.4s ease;
}

button:hover {
  background-color: rgb(255, 255,255, 0.5);
} a{
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>

<header>
    <h3> Quiz Details with Associated Course, Faculty, and Enrolled Students for a Specific Course</h3><br>
    <div class="icon"><ion-icon name="person" style="font-size: 5em;"></ion-icon><br>


    <?php 
    if (isset($_GET['id']) && is_array($_GET['id'])) {
        $id1 = $_GET['id'][0];
        $id2 = $_GET['id'][1];
        echo "Username: <strong>$id1</strong><br>";
        echo "Email id: <strong>$id2</strong><br>";
    } else {
        echo '<button style="width: 100px;" onclick="window.location.href=\'index.php\'">Login Here</button>'; 
    }
?></div>
    <button class="abc"><a href="content.php?id[]=<?php echo $id1; ?>&id[]=<?php echo $id2; ?>" >Home</a></button>
    <button><a href="entity.php?id[]=<?php echo $id1; ?>&id[]=<?php echo $id2; ?>" >Your Details</a></button>
    <button><a href="queries.php?id[]=<?php echo $id1; ?>&id[]=<?php echo $id2; ?>" >Search</a></button>
    <button>History</button>
    
    <button><a href="about.php?id[]=<?php echo $id1; ?>&id[]=<?php echo $id2; ?>" >About</a></button>
    <button><a href="index.php" >Sign Out</a></button>
</header>



<section>
    <div class="x2">
    
   <button ><a class="a" href="q1.php?id[]=<?php echo $id1; ?>&id[]=<?php echo $id2; ?>">Faculty</a></button></h4><br><br>
    <button ><a class="a" href="q2.php?id[]=<?php echo $id1; ?>&id[]=<?php echo $id2; ?>">Assignments</a></button></h4><br><br>
    <button ><a class="a" href="q3.php?id[]=<?php echo $id1; ?>&id[]=<?php echo $id2; ?>">Students</a></button></h4><br><br>
    <button ><a class="a" href="q4.php?id[]=<?php echo $id1; ?>&id[]=<?php echo $id2; ?>">Quiz</a></button></h4>
    
</div>
<div class="x1">

<form action="q4.php" method="GET">
<input type="hidden" name="id[]" value="<?php echo $id1; ?>">
    <input type="hidden" name="id[]" value="<?php echo $id2; ?>">
    <h5>Enter the course id it starts from 101:</h5>
    <input type="number" name="courseid" placeholder="Enter the course id here :"><br><br>
    <button type="submit">Submit</button><br><br>
</form>
<?php
            if (isset($_GET['courseid'])) {
                
                
                $facultyid = $_GET['courseid'];
                
                $sql="SELECT courses.course_name, quiz.quiz_id, Quiz.quiz_date, Quiz.quiz_type, Quiz.quiz_grade, Faculty.faculty_name, Student.fname, Student.lname
                FROM Courses
                JOIN Quiz ON Courses.course_id = Quiz.course_id
                JOIN Lectures ON Courses.course_id = Lectures.course_id
                JOIN Faculty ON Lectures.faculty_id = Faculty.faculty_id
                JOIN Enrolls ON Courses.course_id = Enrolls.course_id
                JOIN Student ON Enrolls.student_id = Student.student_id
                WHERE Courses.course_id = $facultyid;
                ";
                $result=mysqli_query($con,$sql);



            
            if($result){
                $row=mysqli_fetch_array($result);
                

                $id1 = is_array($row) && !empty(array_filter($row)) ? 1 : 0;


                if($id1)
                {
                echo '<table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">course_name</th>
            <th scope="col">quiz_id</th>
            <th scope="col">quiz_date</th>
            <th scope="col">quiz_type</th>
            <th scope="col">faculty_name</th>
            <th scope="col">student first name</th>
            <th scope="col">student last name</th>
            </tr>
        </thead>
        <tbody>';
          
        $facultyid = $_GET['courseid'];
                
                $sql="SELECT courses.course_name, quiz.quiz_id, Quiz.quiz_date, Quiz.quiz_type, Quiz.quiz_grade, Faculty.faculty_name, Student.fname, Student.lname
                FROM Courses
                JOIN Quiz ON Courses.course_id = Quiz.course_id
                JOIN Lectures ON Courses.course_id = Lectures.course_id
                JOIN Faculty ON Lectures.faculty_id = Faculty.faculty_id
                JOIN Enrolls ON Courses.course_id = Enrolls.course_id
                JOIN Student ON Enrolls.student_id = Student.student_id
                WHERE Courses.course_id = $facultyid;";
                $result=mysqli_query($con,$sql);

                while( $row=mysqli_fetch_array($result)){
                    $fid= $row["course_name"];
                    $fname=$row["quiz_id"];
                    $cid=$row["quiz_date"];
                    $cname=$row["quiz_type"];
                    $cname1=$row["faculty_name"];
                    $cname2=$row["fname"];
                    $cname3=$row["lname"];
                   echo ' <tr>
                   <th scope="row">'.$fid.'</th>
                   <td>'.$fname.'</td>
                   <td>'.$cid.'</td>
                   <td>'.$cname.'</td>
                   <td>'.$cname1.'</td>
                   <td>'.$cname2.'</td>
                   <td>'.$cname3.'</td>
              
               
           </tr>';

               }
            
           
        }
        else{
            echo $facultyid. ' course id not exisits...<br>';
            echo 'enter onther one';
        }
    }
        }
            
             ?>

            </tbody>
            
        </table>

</div>

</section>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


</body>
</html>
