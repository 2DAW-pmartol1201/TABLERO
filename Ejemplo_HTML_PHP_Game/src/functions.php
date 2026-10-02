<?php

function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

function getBoardFromCsv(String $rutaCSV)
{
    $stream = fopen($rutaCSV, 'r');
    $tablero = [];


    if ($stream !== false) {

        while (($fila = fgetcsv($stream)) !== false) {
            $tablero[] = array_map('trim',$fila);
        }

        fclose($stream);
    }

    return $tablero;
}

function getBoardMarkup($board_data, $posPersonaje){

    $cont = 0;
    $output = '<div class="board-container">';
    foreach($board_data as $fila){
        foreach ($fila as $tile_value){
            $cont++;
            if ( $cont === $posPersonaje ){
                $output .= '<div class="tile '.$tile_value.'-tile"><div class="personaje"></div></div>';
                $output .= '';
            }else{
                $output .= '<div class="tile '.$tile_value.'-tile"></div>';
            }
            
        }
    
    }
            
    $output .= '</div>';
    if($posPersonaje === 0){
        $output .= '<p>Esa posicion del personaje no es válida</p>';
    }

    return $output;
}

function posicionX(){

  $a = filter_input(INPUT_GET, 'link_pos_x');
  return $a;
}


function posicionY(){
$a = filter_input(INPUT_GET, 'link_pos_y');
  return $a;
}

function calcularPosicion($posX, $posY, $num_rows, $num_columns){
    $pos = 0;
    if( $posX > 0 && $posX <= $num_columns){
        $pos += $posX;
        if(  $posY > 0 && $posX <= $num_rows ){
            $pos += ($num_columns * $posY) - $num_columns;
        } else{
            $pos = 0;
        }
    }else{
        $pos = 0;
    }

    return $pos;
    
    
}
?>