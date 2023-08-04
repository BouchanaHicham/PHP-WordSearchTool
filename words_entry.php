<html>
<head>
    <title>Table</title>
</head>
<style>
    .search-container
    {
    background: #fff;
    height: 30px;
    border-radius: 30px;
    padding: 10px 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: 0.8s;
    box-shadow:  4px 4px 6px 0 rgba(255,255,255,.3),
                -4px -4px 6px 0 rgba(116, 125, 136, .2), 
    inset -4px -4px 6px 0 rgba(255,255,255,.2),
    inset 4px 4px 6px 0 rgba(0, 0, 0, .2);
    }

    .search-container:hover > .search-input{
    width: 400px;
    }

    .search-container .search-input
    {
    background: transparent;
    border: none;
    outline:none;
    width: 0px;
    font-weight: 500;
    font-size: 16px;
    transition: 0.8s;

    }

    .search-container .search-btn .fas{
    color: #5cbdbb;
    }


    .search-container:hover{
    animation: hoverShake 0.15s linear 3;
    }

    table {
    border-collapse: collapse;
    width: 100%;
    color: #588c7e;
    font-family: monospace;
    font-size: 25px;
    text-align: left;
    }
    th {
    background-color: #588c7e;
    color: white;
    }
    tr:nth-child(even) {background-color: #f2f2f2}
    
</style>
<?php



$server_name="localhost";
$username="root";
$password="";
$database_name="words_data_base";



if(isset($_POST['submit_file']))
{	
	$file = $_FILES['file'];
    $filename = $_FILES['file']['name'];
 

    $text = file_get_contents("$filename");


    $exlcuded_words = array( '.','?','!','_','-','(',',',')','{','}','@','"',':',';','/','[',']',">","<",'–','—','”','“','"',"'");  // The Words I'am Removing
    $text = str_replace($exlcuded_words," ",$text);
# ---------------------------------------------------------- Prints ----------------------------------------------------------
    //echo"<br>";
    $text = strtolower($text);                              // Lowers all the text so it becomes the same
    //echo"$text";
    //echo"<br>";

    $text_words = explode(" ", $text); //echo"<br>";

    $spaces=[" ","  ","   ","    ","     "];

    // $str = 'happy beautiful happy lines pear gin happy lines rock happy lines pear ';

    $words = array_count_values(str_word_count($text, 1)); // Counts each instance of a word in the file

    // We then convert the associative array into 2 arrays [Word | Reps]
    $counter=0;
    foreach ($words as $word => $rep)
    {
        $Words_Collector[$counter] = $word ;
        $Words_Counter_Collector[$counter] = $rep ;
        $counter++;
    }
   
    
/* --------------------------------------------------- Count Function That Doesn't Work Properly ---------------------------------------------------
    $counter=0;
    for($x=0;$x<10;$x++)
    {

    for($k=0;$k<count($text_words);$k++)
        {
            $Word_counter=0;
            $first_word = $text_words[$k];
            for($i=0;$i<count($text_words);$i++)
            {
                if($first_word==$text_words[$i])
                {
                    $Word_counter++;
                }
            }
            if($first_word=="")
            {

            }
            else
            {
            $Words_Collector[$counter] =$first_word;
            $Words_Counter_Collector[$counter] = $Word_counter;
            $counter++;
            // echo"$first_word => $Word_counter";
            }

            $text = str_replace(" $first_word "," ",$text);
            

            for($s=0;$s<count($text_words);$s++)
            {
                $text_words[$s] = $text_words[$s++];    
            }
            //echo"<br>";
            //echo"$text";
            //echo"<br>";
            $text = str_replace($spaces," ",$text);
            $text = str_replace($spaces," ",$text);     
            $text_words = explode(" ", $text);
        // var_dump($text_words);
            

        // echo"<hr>";

    }
    
    }


    echo"<hr>";
    print_r($Words_Collector);
    echo"<hr>";
    print_r($Words_Counter_Collector);
*/



$conn=mysqli_connect($server_name,$username,$password,$database_name);
//now check the connection
if(!$conn)
{
	die("Connection Failed:" . mysqli_connect_error());

}
else
{
    
    // ------------------------------------------------------- File -------------------------------------------------------
  
     $sql_query = "SELECT Doc_Name, Id FROM doc_id";
        $result = mysqli_query($conn, $sql_query);
        if ($result) 
        {
            $row = mysqli_num_rows($result);
            if ($row)
              {
                 //echo"<br>";
                 //   echo("Number of row in the table : " . $row);
                 $file_Id = $row +1;
              }
              else
              {
                $file_Id = 1;
              }
              $sql_query = "INSERT INTO doc_id (Doc_Name,Id)
                VALUES ('$filename','$file_Id')";
            if(mysqli_query($conn, $sql_query))
            {
            //    echo "File Has Been Entered Into Data Base";
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($conn);
            }
        }
         
        else
        {
            echo "Error: " . $sql . "" . mysqli_error($conn);
        }

    // ------------------------------------------------------- Words -------------------------------------------------------
    $sql_query = "INSERT INTO words_entry (Doc_Id,word,rep)
        VALUES ('$file_Id','$Words_Collector[0]','$Words_Counter_Collector[0]')";
    for($i=1;$i<count($Words_Collector);$i++)
    {
        $sql_query .= ",('$file_Id','$Words_Collector[$i]','$Words_Counter_Collector[$i]')";
    }
    if (mysqli_query($conn, $sql_query)) 
    {
      //  echo "New Details Entry inserted successfully !";
    } 
    else
    {
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
}

/////// PS  IM A  GENIUSSSSSSSSSSS     2:29 AM  DONEZO

}

?>
<body >
<head>
 <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</head>

<body>      <!-- Search Bar -->
<form action="Tables_Page.php" method="get" >
    <div class="search-container" > 
            
            <input type="text" name="search" placeholder="Search..." class="search-input">
            
            <a class="search-btn">
                    <i class="fas fa-search"></i>      
            </a>
            
    </div>
    </form>
   
    
    
</body>
<body>
<table>
    <tr>
    <th>Doc_Name</th>
    <th>Id</th>
    </tr>
    <?php
        $conn=mysqli_connect($server_name,$username,$password,$database_name);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT Doc_Name, Id FROM doc_id";
        $result = $conn->query($sql);
            if ($result->num_rows > 0) 
            {
            // output data of each row
                while($row = $result->fetch_assoc()) 
                {
                echo "<tr><td>" . $row["Doc_Name"]. "</td><td>" . $row["Id"] . "</td></tr>";
                }
            echo "</table>";
            } 
        else { echo "0 results"; }
        $conn->close();
    ?>
</table>

<table>
    <tr>
    <th>Id</th>
    <th>Doc_Id</th>
    <th>Occurrence</th>
    </tr>
    <?php
        $conn=mysqli_connect($server_name,$username,$password,$database_name);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT Doc_Id, word, rep FROM words_entry";
        $result = $conn->query($sql);
            if ($result->num_rows > 0) 
            {
            // output data of each row
                while($row = $result->fetch_assoc()) 
                {
                echo "<tr><td>" . $row["Doc_Id"]. "</td><td>" . $row["word"] . "</td><td>"
                . $row["rep"]. "</td></tr>";
                }
            echo "</table>";
            } 
        else { echo "0 results"; }

        $conn->close();
    ?>
</table>

</body>
</body>
</html>



