<?php   
    if($_POST){  
        $number = $_POST['number'];   
        function sum_of_digits($number){
            $sum = 0;
            for ($i = 0; $i < strlen($number); $i++){
               $sum += $number[$i];
            }
            return $sum;
         }

         echo "Sum of digits of $number is: " . sum_of_digits($number);
    }  

?> 

<html>  
<body>  
<form method="post">  
    Enter a number:  
    <input type="number" name="number">  
    <input type="submit" value="Submit">  
</form>  
</body>  
</html>  
 