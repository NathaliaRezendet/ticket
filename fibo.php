<?php
    function fibo($n){
        if($n <= 2){
            return 1;
        }
        
        $sum = 0;
        $num1 = 0;
        $num2 = 1;

        for($i = 0; $i < $n; $i++){
            $sum =  $num1 + $num2;
            $num1 = $num2;
            $num2 = $sum;
        }

        return $sum;
    }

   
    if(isset($_GET['numero'])){
        $input_numero = $_GET['numero'];
        $resultado = fibo($input_numero);
        echo "<div class='alert alert-success'  style='width:50%; font-size: 25px; margin-left: 450px;' role='alert'>
                Resultado de FIBO ($input_numero): $resultado
              </div>";
    }
    ?>