<?php

// my 'dd' function a little differente
function dd($sentArray = null){
    
    if(!is_array($sentArray)){
    	$sentArray = [$sentArray];
    }
    $counterOfElements = count($sentArray);
    for($i = 0; $i < $counterOfElements; $i++){
        $results = $sentArray[$i];
	    
	    echo '<div style="background: lightgray; padding:10px;">';
	    echo '<h4> ' . gettype($results) . ' :</h4>';
	    
	    if(is_object($results)){
	        echo print_r($results, true);
	    }
	    
	    if(!is_array($results) && !is_object($results)){
	        
	        if(is_null($results)){
	            $message = 'null';
	        }else if($results){
	            $message = 'true';
	            if(is_numeric($results) || is_string($results)){
	                $message = $results;
	            }
	        }else if(!$results){
	            $message = 'false';
	        }
	        
	        echo $message;
	    }
	    
	    if(is_array($results)){
	        $indexed = $this->verifyArray($results);
	        
	        if(!$indexed){
	            $count = 0;
	            foreach($results as $result){
	                echo '[' . $count . ']=>' . $result . '<br>';
	                $count++;
	            }
	        }else if($indexed == 2){
	            $toReturn = [];
	            $position = 0;
	            foreach($results as $result){
	                
	                echo '<p>[' . $position . ']</p>';
	                foreach($result as $key => $value){
	                    echo '[ ' . $key . ' ] => ' . $value . '<br>';
	                }
	                echo '<br>';
	                $position ++;
	            }
	        }else{
	            echo '<p style="text-decoration:underline;">' . gettype($results[0]) . ' inside an indexed array</p>';
	            echo 'can not display object';
	        }
	    }
	    
	    echo '</div>';
    
    }
    die();
}

// Verify if array is indexed or no
function verifyArray($array){
    if(is_object($array[0])){
        return 1;
    }
    
    foreach($array as $arr =>$key){
        if(is_array($key)){
            return 2;
        }else{
            return false;
        }
    }
}

?>