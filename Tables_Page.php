<html>
    <head>
        <title>Table Page </title>
    </head>
<style>
    table {
    border-collapse: collapse;
    width: 100%;
    color: #588c7e;
    font-family: monospace;
    font-size: 30px;
    text-align: center;
    
    }
    th {
    background-color: #588c7e;
    color: white;
    }
    tr:nth-child(even) {background-color: #f2f2f2}
</style>
    <body>
       


<?php   

class Node
{
    private $data;
    public $Array = array();
    private $next;

    public function __construct()
    {
        $this->data = 0;
        $this->left = null;
        $this->right = null;  
        $this->Array =array(); 
        $this->next = null;
    }

    //---------------------------------------------------[Data]---------------------------------------------------
    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
    //---------------------------------------------------[Set Array]---------------------------------------------------
    public function setArray($Array)
    {
        $this->Array = $Array;
    }

    public function getArray()
    {
        return $this->Array;
    }
    //---------------------------------------------------[Next]---------------------------------------------------
    public function setNext($next)
    {
        $this->next = $next;
    }

    public function getNext()
    {
        return $this->next;
    }
    //---------------------------------------------------[Right]---------------------------------------------------
    public function setRight($right)
    {
        $this->right = $right;
    }

    public function getRight()
    {
        return $this->right;
    }
    //---------------------------------------------------[Left]---------------------------------------------------
    public function setLeft($left)
    {
        $this->left = $left;
    }

    public function getLeft()
    {
        return $this->left;
    }

}
class LinkedList
{
    private $head;

    public function __construct()
    {
        $this->head = null;
    }

    public function insertAtBack($data , $Doc_id)
    {
        $newNode = new Node();
        $newNode -> setData($data);
        $newNode ->setArray($Doc_id);

        if($this->head)
        {
            $currentNode = $this->head;
            //Finding Last Node 
            while ($currentNode->getNext() != null)
            {
                $currentNode = $currentNode -> getNext();
            }
            $currentNode->setNext($newNode);

        }
        else
        {
            $this->head = $newNode;
        }
    }
    //------------------------------------------------------------------------------------[Not Filter]------------------------------------------------------------------------------------
    public function Not_Filter($target) 
    {
        if($this->head) 
        {
        $currentNode = $this->head; 
        // Finding our target node
        while ($currentNode!= null)         // While the list isnt Over
            {
                while ($currentNode->getData() != $target && $currentNode->getNext() != null) 
                {
                    $currentNode = $currentNode->getNext();
                }
                if($currentNode->getData() == $target) 
                {
                    $Next_Of_Curernt_Node = new Node ();
                    $Next_Of_Curernt_Node =  $currentNode->getNext();
                    
                    // ---------------------------------------- We Use Filler Node To Cut Off Node Out Of The List ----------------------------------------

                    $Filler_Node = new Node();
                    $Filler_Node ->setData($currentNode->getNext()->getData());
                    $Filler_Node ->setArray($currentNode->getNext()->getArray());

                    // ------------------------------------------------------------------------------------------------------------------------------------
                    $currentNode->setRight($Filler_Node); // we set Right of [not] to ONLY the Data of Next (Not the whole next list so it doesnt follow up with the others)
                    
                    $currentNode->setLeft("NULL");  // We set left side to [NULL]
                    $currentNode->setNext($currentNode->getNext()->getNext());
                }
                $currentNode = $currentNode->getNext();     // Iterates over the whole List till next is == NULL 
            }   
        }
    }

    //------------------------------------------------------------------------------------[And Filter]------------------------------------------------------------------------------------
    public function And_Filter($target) 
    {
        if($this->head) 
        {
        $currentNode = $this->head; 
        // Finding our target node
        while ($currentNode!= null)         // While the list isnt Over
            {
                while ($currentNode->getData() != $target && $currentNode->getNext() != null) 
                {
                    $PrevNode = $currentNode;
                    $currentNode = $currentNode->getNext();
                }
                if($currentNode->getData() == $target) 
                {
                    $Next_Of_Curernt_Node =  $currentNode->getNext();
                    
                    echo"And Found"; echo"<br>";
                    print_r("Prev_Node: ".$PrevNode->getdata()); echo"<br>";
                    print_r("Current_Node: ".$currentNode->getdata()); echo"<br>";
                    //print_r("Next_Node: ".$Next_Of_Curernt_Node->getdata()); echo"<br>";
                    echo"<hr>";
                    
                    $currentNode->setLeft($PrevNode->getData());            //  we set the data of the left side to our left side lol
                    $currentNode->setRight($Next_Of_Curernt_Node);          // We Set The Next pointer to the right side

                    $currentNode->setNext(null);        // Removes The  Next for each element so we dont get a lode of elements in each list elemnt
                    $PrevNode->setData($currentNode);
                    
                }
                $currentNode = $currentNode->getRight();     // Iterates over the whole List through the Right Side since we removed the next elements so we just go through the right
            }   
        }
    }
    //------------------------------------------------------------------------------------[Or Filter]------------------------------------------------------------------------------------
    public function Or_Filter($target) 
    {
        if($this->head) 
        {
        $currentNode = $this->head;
        // Finding our target node
        while ($currentNode!= null)         // While the list isnt Over
            {
                while ($currentNode->getData() != $target && $currentNode->getNext() != null) 
                {
                    $PrevNode = $currentNode;
                    $currentNode = $currentNode->getNext();
                    
                    $CloneNode=$currentNode;               // Clone Till Or
                    $PrevNode->setNext(null);                   // Sets the PrevNodes Next To : NULL
                }
               
                if($currentNode->getData() == $target) 
                {
                    $Next_Of_Curernt_Node =  $currentNode->getNext();
                    
                    echo"Or Found"; echo"<br>";
                    $currentNode->setRight($Next_Of_Curernt_Node);          // We Set The Next pointer to the right side

                    $Fake_Node = new Node();
                    $PrevNode->setNext(null);
                  
                    
                    $currentNode->setLeft($PrevNode);  
                    
                    
                    
                    $currentNode->setNext(null);        // Removes The  Next for each element so we dont get a lode of elements in each list elemnt
                    $PrevNode->setData($currentNode);
                    
                }
                $currentNode = $currentNode->getRight();     // Iterates over the whole List through the Right Side since we removed the next elements so we just go through the right
            } 
            echo"<hr>"; echo"Clone";echo"<hr>";
            var_dump($CloneNode);  
            
        }
    }
// ------------------------------------------------------------------------------------ [ Calculate And ] ------------------------------------------------------------------------------------
    public function Calculate_And()
    {
        if($this->head) 
        {
        $currentNode = $this->head; 
        // Finding our target node (And)
        while ($currentNode!= null)         // While the list isnt Over
            {
                while ($currentNode->getData() != "and" && $currentNode->getNext() != null) 
                {
                    $PrevNode = $currentNode;
                    $currentNode = $currentNode->getNext();
                }
                if($currentNode->getData() == "and") 
                {
                    $Next_Of_Curernt_Node =  $currentNode->getNext();

                    $Prev_Array = $PrevNode->getArray();            // We Get The Array Of The Prev Node
                    // ---- We Split Them Into 2 Seperate Arrays [Doc_Id's] | [Reps]
                    $j=0;
                    for($i=0;$i<count($Prev_Array);$i=$i+2)
                    {
                        $Prev_Array_DocID[$j] = $Prev_Array[$i];
                        $j++;
                    }
                    $j=0;
                    for($i=1;$i<count($Prev_Array);$i=$i+2)
                    {
                        $Prev_Array_Rep[$j] = $Prev_Array[$i];
                        $j++;
                    }
                    echo"---Prev_Array---";
                    echo"<br>";
                    for ($i=0;$i<count($Prev_Array_DocID);$i++)
                    {
                        echo($Prev_Array_DocID[$i]."=>".$Prev_Array_Rep[$i]);
                        echo"<br>";
                    }
                    
                    echo"<hr>";


                    $Next_Array = $Next_Of_Curernt_Node->getArray();    // We Get The Array Of The Next Node
                  
                    $j=0;
                    for($i=0;$i<count($Next_Array);$i=$i+2)
                    {
                        $Next_Array_DocID[$j] = $Next_Array[$i];
                        $j++;
                    }
                    $j=0;
                    for($i=1;$i<count($Next_Array);$i=$i+2)
                    {
                        $Next_Array_Rep[$j] = $Next_Array[$i];
                        $j++;
                    }

                    echo"---Next_Array---";
                    echo"<br>";
                    for ($i=0;$i<count($Next_Array_DocID);$i++)
                    {
                        echo($Next_Array_DocID[$i]."=>".$Next_Array_Rep[$i]);
                        echo"<br>";
                    }
                   
                    
                    
                    $Last_Next_Id = $Next_Array_DocID[count($Next_Array_DocID)-1];      // Gets The Last Id In The Id_Array
                    $Last_Prev_Id = $Prev_Array_DocID[count($Prev_Array_DocID)-1];

                     // print_r($Last_Next_Id);
                     // print_r($Last_Prev_Id);
                    
                    
                    
                    // ------------------------------------ [If Array Size Is The Same] ------------------------------------
                        if ($Last_Next_Id == $Last_Prev_Id && count($Next_Array_DocID) == count($Prev_Array_DocID))
                        {
                            $Full_Counter = $Last_Next_Id; // This means both are the same size

                            for($i=0;$i<$Full_Counter;$i++)
                            {
                                $Total_Array[$i] = $Prev_Array_Rep[$i] * $Next_Array_Rep[$i];
                                echo"<br>";
                            
                                echo($Next_Array_DocID[$i]."=>".$Total_Array[$i]);
                                
                            }
                        }
                    // ------------------------- [If Next Size Is Higher (Reverse)] -------------------------
                        else if (count($Next_Array_DocID) < count($Prev_Array_DocID))
                        {
                            $j=1;
                            for($i=0;$i<6;$i++)
                            {
                                $Exists_In_Next = false;
                                if($Prev_Array_DocID[$i] == $j) // If The Id Exists In [Prev]
                                {
                                    for($x=0;$x<count($Next_Array_DocID);$x++)
                                    {
                                        if($Next_Array_DocID[$x] == $j) // And It Also Exists In [Next]
                                        {
                                            $Total_Array_Id[$i] = $j;
                                            $Total_Array_Rep[$i] = $Prev_Array_Rep[$i] * $Next_Array_Rep[$x]; // We Multiply
                                            $Exists_In_Next = true;
                                        }
                                    }
                                    if ($Exists_In_Next == false)       // If It Does'nt Exist In Next Then Add It Alone.
                                    {
                                        $Total_Array_Id[$i] = $j;
                                        $Total_Array_Rep[$i] = $Prev_Array_Rep[$i];
                                    }
                                }
                                $j++;
                            }

                           
                            
                        }
                    // ------------------------- [If Next Size Is Higher (Reverse)] -------------------------
                        else if (count($Next_Array_DocID) > count($Prev_Array_DocID))
                        {
                            $j=1;
                            for($i=0;$i<6;$i++)
                            {
                                $Exists_In_Prev = false;
                                if($Next_Array_DocID[$i] == $j) // If The Id Exists In [Prev]
                                {
                                    for($x=0;$x<count($Prev_Array_DocID);$x++)
                                    {
                                        if($Prev_Array_DocID[$x] == $j) // And It Also Exists In [Next]
                                        {
                                            $Total_Array_Id[$i] = $j;
                                            $Total_Array_Rep[$i] = $Next_Array_Rep[$i] * $Prev_Array_Rep[$x]; // We Multiply
                                            $Exists_In_Prev = true;
                                        }
                                    }
                                    if ($Exists_In_Prev == false)       // If It Does'nt Exist In Next Then Add It Alone.
                                    {
                                        $Total_Array_Id[$i] = $j;
                                        $Total_Array_Rep[$i] = $Next_Array_Rep[$i];
                                    }
                                }
                                $j++;
                            }
                            
                        }
                        echo"<hr>";
                        echo"---Total_Array---";
                        echo"<br>";
                        for ($i=0;$i<count($Total_Array_Id);$i++)
                        {
                            echo($Total_Array_Id[$i]."=>".$Total_Array_Rep[$i]);
                            
                            echo"<br>";
                        }
                        $j=0;
                        for ($i=0;$i<count($Total_Array_Id);$i++)
                        {
                            $Finale_Total_Array[$j] = $Total_Array_Id[$i];
                            $Finale_Total_Array[$j+1] = $Total_Array_Rep[$i];
                            $j=$j+2;
                        }
                        print_r($Finale_Total_Array);
                        echo"<br>";
                        $currentNode->getNext()->setArray($Finale_Total_Array);
      
                /* // This Function Doesn't Work properly
                    for($i=0;$i<$Full_Counter;$i++)
                    {
                        if($i % 2 == 0)  // Check If its the do id [since its in the EVEN indexes of the Array]
                        {
                            if($i<count($Next_Array) && $i<count($Prev_Array))    // if $i doesnt exceed its limit ( if its not bigger than both arrays [so it doesn't surpass it])
                            {
                            if($Prev_Array[$i]==$Next_Array[$i])    // If The Doo_Id Is The Same Then Multiply The Values
                            {
                                $Total_Array[$i] = $Prev_Array[$i];
                                $Total_Array[$i+1] = $Prev_Array[$i+1] * $Next_Array[$i+1];
                            }
                            else            // If Not
                            {
                                if($Prev_Array[$i]<$Next_Array[$i])
                                {
                                    $Total_Array[$i] = $Prev_Array[$i];
                                    $Total_Array[$i+1] = $Prev_Array[$i+1];
                                }
                                else if ($Next_Array[$i]<$Prev_Array[$i])
                                {
                                    $Total_Array[$i] = $Next_Array[$i];
                                    $Total_Array[$i+1] = $Next_Array[$i+1];
                                }
                            }
                            }
                            else if($i>=count($Next_Array) && $i<count($Prev_Array))  // If The Next Array Index's Are done && The Prev Array still have 
                            {
                            $Total_Array[$i] = $Prev_Array[$i];
                            $Total_Array[$i+1] = $Prev_Array[$i+1] * $Next_Array[$i-1] ;    // Honestly No Clue how this works exactly (Too much coffee , Hicham go to sleep m8 )
                            }
                            else if($i>=count($Prev_Array) && $i<count($Next_Array))  // If The Prev Array Index's Are done && The Next Array still have 
                            {
                            $Total_Array[$i] = $Next_Array[$i];
                            $Total_Array[$i+1] = $Next_Array[$i+1] * $Prev_Array[$i-4] ;    // Honestly No Clue how this works exactly (Too much coffee , Hicham go to sleep m8 )
                            } 
                        } // I am a wizard ..... how does this work ?????????

                        
                    }
                    */
                    
                    
                    
                }

                $currentNode = $currentNode->getNext(); 
            }   
        }
    }
// ------------------------------------------------------------------------------------ [ Calculate Or ] ------------------------------------------------------------------------------------
    public function Calculate_Or()
    {
        if($this->head) 
        {
        $currentNode = $this->head; 
        // Finding our target node (And)
        while ($currentNode!= null)         // While the list isnt Over
            {
                while ($currentNode->getData() != "or" && $currentNode->getNext() != null) 
                {
                    $PrevNode = $currentNode;
                    $currentNode = $currentNode->getNext();
                }
                if($currentNode->getData() == "or") 
                {
                    $Next_Of_Curernt_Node =  $currentNode->getNext();

                    $Prev_Array = $PrevNode->getArray();            // We Get The Array Of The Prev Node
                    // ---- We Split Them Into 2 Seperate Arrays [Doc_Id's] | [Reps]
                    $j=0;
                    for($i=0;$i<count($Prev_Array);$i=$i+2)
                    {
                        $Prev_Array_DocID[$j] = $Prev_Array[$i];
                        $j++;
                    }
                    $j=0;
                    for($i=1;$i<count($Prev_Array);$i=$i+2)
                    {
                        $Prev_Array_Rep[$j] = $Prev_Array[$i];
                        $j++;
                    }
                    echo"---Prev_Array---";
                    echo"<br>";
                    for ($i=0;$i<count($Prev_Array_DocID);$i++)
                    {
                        echo($Prev_Array_DocID[$i]."=>".$Prev_Array_Rep[$i]);
                        echo"<br>";
                    }
                    
                    echo"<hr>";


                    $Next_Array = $Next_Of_Curernt_Node->getArray();    // We Get The Array Of The Next Node
                  
                    $j=0;
                    for($i=0;$i<count($Next_Array);$i=$i+2)
                    {
                        $Next_Array_DocID[$j] = $Next_Array[$i];
                        $j++;
                    }
                    $j=0;
                    for($i=1;$i<count($Next_Array);$i=$i+2)
                    {
                        $Next_Array_Rep[$j] = $Next_Array[$i];
                        $j++;
                    }

                    echo"---Next_Array---";
                    echo"<br>";
                    for ($i=0;$i<count($Next_Array_DocID);$i++)
                    {
                        echo($Next_Array_DocID[$i]."=>".$Next_Array_Rep[$i]);
                        echo"<br>";
                    }
                   
                    
                    
                    $Last_Next_Id = $Next_Array_DocID[count($Next_Array_DocID)-1];      // Gets The Last Id In The Id_Array
                    $Last_Prev_Id = $Prev_Array_DocID[count($Prev_Array_DocID)-1];

                     // print_r($Last_Next_Id);
                     // print_r($Last_Prev_Id);
                    
                    
                    
                    // ------------------------------------ [If Array Size Is The Same] ------------------------------------
                        if ($Last_Next_Id == $Last_Prev_Id && count($Next_Array_DocID) == count($Prev_Array_DocID))
                        {
                            $Full_Counter = $Last_Next_Id; // This means both are the same size

                            for($i=0;$i<$Full_Counter;$i++)
                            {
                                $Total_Array[$i] = $Prev_Array_Rep[$i] + $Next_Array_Rep[$i];
                                echo"<br>";
                            
                                echo($Next_Array_DocID[$i]."=>".$Total_Array[$i]);
                                
                            }
                        }
                    // ------------------------- [If Next Size Is Higher (Reverse)] -------------------------
                        else if (count($Next_Array_DocID) < count($Prev_Array_DocID))
                        {
                            $j=1;
                            for($i=0;$i<6;$i++)
                            {
                                $Exists_In_Next = false;
                                if($Prev_Array_DocID[$i] == $j) // If The Id Exists In [Prev]
                                {
                                    for($x=0;$x<count($Next_Array_DocID);$x++)
                                    {
                                        if($Next_Array_DocID[$x] == $j) // And It Also Exists In [Next]
                                        {
                                            $Total_Array_Id[$i] = $j;
                                            $Total_Array_Rep[$i] = $Prev_Array_Rep[$i] + $Next_Array_Rep[$x]; // We Multiply
                                            $Exists_In_Next = true;
                                        }
                                    }
                                    if ($Exists_In_Next == false)       // If It Does'nt Exist In Next Then Add It Alone.
                                    {
                                        $Total_Array_Id[$i] = $j;
                                        $Total_Array_Rep[$i] = $Prev_Array_Rep[$i];
                                    }
                                }
                                $j++;
                            }

                           
                            
                        }
                    // ------------------------- [If Prev Size Is Higher (Reverse)] -------------------------
                        else if (count($Next_Array_DocID) > count($Prev_Array_DocID))
                        {
                            $j=1;
                            for($i=0;$i<6;$i++)
                            {
                                $Exists_In_Prev = false;
                                if($Next_Array_DocID[$i] == $j) // If The Id Exists In [Prev]
                                {
                                    for($x=0;$x<count($Prev_Array_DocID);$x++)
                                    {
                                        if($Prev_Array_DocID[$x] == $j) // And It Also Exists In [Next]
                                        {
                                            $Total_Array_Id[$i] = $j;
                                            $Total_Array_Rep[$i] = $Next_Array_Rep[$i] + $Prev_Array_Rep[$x]; // We Multiply
                                            $Exists_In_Prev = true;
                                        }
                                    }
                                    if ($Exists_In_Prev == false)       // If It Does'nt Exist In Next Then Add It Alone.
                                    {
                                        $Total_Array_Id[$i] = $j;
                                        $Total_Array_Rep[$i] = $Next_Array_Rep[$i];
                                    }
                                }
                                $j++;
                            }
                            
                        }
                        echo"<hr>";
                        echo"---Total_Array---";
                        echo"<br>";
                        for ($i=0;$i<count($Total_Array_Id);$i++)
                        {
                            echo($Total_Array_Id[$i]."=>".$Total_Array_Rep[$i]);
                            
                            echo"<br>";
                        }
                        $j=0;
                        for ($i=0;$i<count($Total_Array_Id);$i++)
                        {
                            $Finale_Total_Array[$j] = $Total_Array_Id[$i];
                            $Finale_Total_Array[$j+1] = $Total_Array_Rep[$i];
                            $j=$j+2;
                        }
                        print_r($Finale_Total_Array);
                        echo"<br>";
                        $currentNode->getNext()->setArray($Finale_Total_Array);
            
                }

                $currentNode = $currentNode->getNext(); 
            }   
        }
    }
// ------------------------------------------------------------------------------------ [ Calculate Not ] ------------------------------------------------------------------------------------
public function Calculate_Not()
    {
        if($this->head) 
        {
        $currentNode = $this->head; 
        // Finding our target node (And)
        while ($currentNode!= null)         // While the list isnt Over
            {
                while ($currentNode->getData() != "not" && $currentNode->getNext() != null) 
                {
                    $PrevNode = $currentNode;
                    $currentNode = $currentNode->getNext();
                }
                if($currentNode->getData() == "not") 
                {
                    $Next_Of_Curernt_Node =  $currentNode->getNext();

                    $Prev_Array = $PrevNode->getArray();            // We Get The Array Of The Prev Node
                    // ---- We Split Them Into 2 Seperate Arrays [Doc_Id's] | [Reps]
                    $j=0;
                    for($i=0;$i<count($Prev_Array);$i=$i+2)
                    {
                        $Prev_Array_DocID[$j] = $Prev_Array[$i];
                        $j++;
                    }
                    $j=0;
                    for($i=1;$i<count($Prev_Array);$i=$i+2)
                    {
                        $Prev_Array_Rep[$j] = $Prev_Array[$i];
                        $j++;
                    }
                    echo"---Prev_Array---";
                    echo"<br>";
                    for ($i=0;$i<count($Prev_Array_DocID);$i++)
                    {
                        echo($Prev_Array_DocID[$i]."=>".$Prev_Array_Rep[$i]);
                        echo"<br>";
                    }
                    
                    echo"<hr>";


                    $Next_Array = $Next_Of_Curernt_Node->getArray();    // We Get The Array Of The Next Node
                  
                    $j=0;
                    for($i=0;$i<count($Next_Array);$i=$i+2)
                    {
                        $Next_Array_DocID[$j] = $Next_Array[$i];
                        $j++;
                    }
                    $j=0;
                    for($i=1;$i<count($Next_Array);$i=$i+2)
                    {
                        $Next_Array_Rep[$j] = $Next_Array[$i];
                        $j++;
                    }

                    echo"---Next_Array---";
                    echo"<br>";
                    for ($i=0;$i<count($Next_Array_DocID);$i++)
                    {
                        echo($Next_Array_DocID[$i]."=>".$Next_Array_Rep[$i]);
                        echo"<br>";
                    }
                   
                    
                    
                    $Last_Next_Id = $Next_Array_DocID[count($Next_Array_DocID)-1];      // Gets The Last Id In The Id_Array
                    $Last_Prev_Id = $Prev_Array_DocID[count($Prev_Array_DocID)-1];

                     // print_r($Last_Next_Id);
                     // print_r($Last_Prev_Id);
                    
                    
                    
                    // ------------------------------------ [If Array Size Is The Same] ------------------------------------
                        if ($Last_Next_Id == $Last_Prev_Id && count($Next_Array_DocID) == count($Prev_Array_DocID))
                        {
                            $Full_Counter = $Last_Next_Id; // This means both are the same size

                            for($i=0;$i<$Full_Counter;$i++)
                            {
                                $Total_Array[$i] = $Prev_Array_Rep[$i] - $Next_Array_Rep[$i];
                                echo"<br>";
                            
                                echo($Next_Array_DocID[$i]."=>".$Total_Array[$i]);
                                
                            }
                        }
                    // ------------------------------------ [If Next Size Is Higher] ------------------------------------
                        else if (count($Next_Array_DocID) < count($Prev_Array_DocID))
                        {
                            $j=1;
                            for($i=0;$i<6;$i++)
                            {
                                $Exists_In_Next = false;
                                if($Prev_Array_DocID[$i] == $j) // If The Id Exists In [Prev]
                                {
                                    for($x=0;$x<count($Next_Array_DocID);$x++)
                                    {
                                        if($Next_Array_DocID[$x] == $j) // And It Also Exists In [Next]
                                        {
                                            $Total_Array_Id[$i] = $j;
                                            $Total_Array_Rep[$i] = $Prev_Array_Rep[$i] - $Next_Array_Rep[$x]; // We Multiply
                                            $Exists_In_Next = true;
                                        }
                                    }
                                    if ($Exists_In_Next == false)       // If It Does'nt Exist In Next Then Add It Alone.
                                    {
                                        $Total_Array_Id[$i] = $j;
                                        $Total_Array_Rep[$i] = $Prev_Array_Rep[$i];
                                    }
                                }
                                $j++;
                            }

                           
                            
                        }
                        // ------------------------- [If Prev Size Is Higher (Reverse)] -------------------------
                        else if (count($Next_Array_DocID) > count($Prev_Array_DocID))
                        {
                            $j=1;
                            for($i=0;$i<6;$i++)
                            {
                                $Exists_In_Prev = false;
                                if($Next_Array_DocID[$i] == $j) // If The Id Exists In [Prev]
                                {
                                    for($x=0;$x<count($Prev_Array_DocID);$x++)
                                    {
                                        if($Prev_Array_DocID[$x] == $j) // And It Also Exists In [Next]
                                        {
                                            $Total_Array_Id[$i] = $j;
                                            $Total_Array_Rep[$i] = $Next_Array_Rep[$i] - $Prev_Array_Rep[$x]; // We Multiply
                                            $Exists_In_Prev = true;
                                        }
                                    }
                                    if ($Exists_In_Prev == false)       // If It Does'nt Exist In Next Then Add It Alone.
                                    {
                                        $Total_Array_Id[$i] = $j;
                                        $Total_Array_Rep[$i] = $Next_Array_Rep[$i];
                                    }
                                }
                                $j++;
                            }
                            
                        }
                        echo"<hr>";
                        echo"---Total_Array---";
                        echo"<br>";
                        for ($i=0;$i<count($Total_Array_Id);$i++)
                        {
                            echo($Total_Array_Id[$i]."=>".$Total_Array_Rep[$i]);
                            
                            echo"<br>";
                        }
                        $j=0;
                        for ($i=0;$i<count($Total_Array_Id);$i++)
                        {
                            $Finale_Total_Array[$j] = $Total_Array_Id[$i];
                            $Finale_Total_Array[$j+1] = $Total_Array_Rep[$i];
                            $j=$j+2;
                        }
                        print_r($Finale_Total_Array);
                        echo"<br>";
                        $currentNode->getNext()->setArray($Finale_Total_Array);
            
                }

                $currentNode = $currentNode->getNext(); 
            }   
        }
    }

}

// ---------------------------------------------------- [Server Side ] ----------------------------------------------------
    $server_name="localhost";
    $username="root";
    $password="";
    $database_name="words_data_base";

  $Search = $_GET["search"];
  $Search = strtolower($Search); 
  echo "<center><h1>$Search</h1></center>";
    /* ---------------------------------------------------- [ Removing Extras And Replacing Spaces With "And" ] ----------------------------------------------------
        $Search = str_replace(" and "," ",$Search); 
        $Search = str_replace(" "," and ",$Search);         // Removes Spaces and replaces them with " and  "
        $Search = str_replace(" not and "," not ",$Search); // Removes the "And" after "Not" according to our rules
        $Search = str_replace(" and not "," not ",$Search); // Removes the "And" after "Not" according to our rules
        $Search = str_replace(" and or "," or ",$Search);
        $Search = str_replace(" or and "," or ",$Search);
    */ 
  $Search = explode(" ",$Search);
 // print_r($Search);
// ------------------------------------------ [SQL] ------------------------------------------
  $conn = new mysqli($server_name, $username, $password, $database_name);

  if ($conn->connect_error) 
  {
    die("Connection failed: " . $conn->connect_error);
  }

$obj = new LinkedList();  // Creates Our List
  for($i=0;$i<count($Search);$i++)
  {
    
    $sql = "SELECT * FROM `words_entry` WHERE word='$Search[$i]' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
        echo "<table>";
        echo "<tr>";
        echo "<th>Doc_Id</th>";
        echo "<th>$Search[$i]</th>";
        echo "<th>Rep</th>";
        echo "</tr>";
        // output data of each row
        $s=0;
        while($row = $result->fetch_assoc()) //fetches a result row as an associative array.
        {
            echo "<tr><td>" . $row["Doc_Id"]. "</td><td>" ."". "</td><td>" . $row["rep"]. "</td></tr>";    
            $Word_Info[$s]=(int)$row["Doc_Id"];  // The First Index Is The [Doc_Id]
            $Word_Info[$s+1]=(int)$row["rep"]; // The Second Index Is The [Rep]
            $s=$s+2;
        }
        
        
        echo "</table>";
        echo"<hr>";
       
        $obj -> insertAtBack($Search[$i],$Word_Info); // Inserts The Phrase In Our List with its respective Array
       
    } 
    unset ($Word_Info); // Resets The Array    | if we dont [if the last array we used had 6 indexes and the current one has 5 , the last one from the previous array is left and will be added to our array]
  }


   $obj -> Calculate_And();
   $obj -> Calculate_Or();
   $obj -> Calculate_Not();
  //$obj -> Not_Filter("not");
  //$obj -> And_Filter("and");
  //$obj -> Or_Filter("or");
  // --------------------------------------- [Our List ] ---------------------------------------
                               // var_dump($obj); // This Show The Search Phrase As A List
  // -------------------------------------------------------------------------------------------
?>
    </body>

</html>