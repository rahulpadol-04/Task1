<?php   
    if($_POST){  
        $number = $_POST['number'];   
        function checkEvenOrOdd($number) {
            if($number % 2 == 0) {
                echo "$number is even.";
            } else {
                echo "$number is odd.";
            }
        } 
    }  
    checkEvenOrOdd($number);
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
 