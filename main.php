<?php

  $GLOBALS['lines'] = 20;
  $GLOBALS['rows'] = 10;  

  $GLOBALS['ROBOT_ARRAY'] = array();
  $GLOBALS['MAP_ARRAY'] = array();

  function randomizeRobotPos() {
    $rand_i = rand(0, $GLOBALS['rows'] - 1);
    $rand_j = rand(0, $GLOBALS['lines'] - 1);

    $GLOBALS['ROBOT_ARRAY'][$rand_i][$rand_j] = 'x';
  }

  function initializeArrays() {
    for($i = 0; $i < $GLOBALS['rows']; $i++) {
      for($j = 0; $j < $GLOBALS['lines']; $j++) {
        $randgen = rand(0, 100);
        
        $GLOBALS['ROBOT_ARRAY'][$i][$j] = '0';

        if($randgen <= 20) {
          $GLOBALS['MAP_ARRAY'][$i][$j] = '#'; 
        } else {
          $GLOBALS['MAP_ARRAY'][$i][$j] = '1'; 
        }
      }
    }

    randomizeRobotPos();
  }

  function printRobot() {
    for($i = 0; $i < $GLOBALS['rows']; $i++) {
      for($j = 0; $j < $GLOBALS['lines']; $j++) {
        echo $GLOBALS['ROBOT_ARRAY'][$i][$j];
      }
      echo "\n";
    }
  }

  function parseInput($navigation) {
    if(!preg_match_all("/\[[^\]]*\]/", $navigation, $matches)) {
      return "Formato incorreto!";
    }

    $parts = explode(' ', $navigation);
    $str = $parts[0][1] . $parts[1][0];
    return $str;
  }

  function getRobotActualPos() {
    for($i = 0; $i < $GLOBALS['rows']; $i++) {
      for($j = 0; $j < $GLOBALS['lines']; $j++) {
        if($GLOBALS['ROBOT_ARRAY'][$i][$j] === 'x') {
          return [$i, $j];
        }
      }
    }
  }

  function compareAndMove($i_pos, $j_pos) {
    if($i_pos >= $GLOBALS['rows'] || $i_pos <= 0 || $j_pos >= $GLOBALS['lines'] || $j_pos < 0) {
      return "FAILED";
    }

    if($GLOBALS['MAP_ARRAY'][$i_pos][$j_pos] === '#') {
      return "FAILED";
    }    

    if($GLOBALS['MAP_ARRAY'][$i_pos][$j_pos] === '1') {
      return "SUCCESS";
    }
  }

  function caseFailed($i, $j) {
    echo "FAILED";

    if($i >= $GLOBALS['rows'] || $i <= 0 || $j >= $GLOBALS['lines'] || $j < 0) {
      return "FAILED";
    }

    $GLOBALS['ROBOT_ARRAY'][$i][$j] = '#';
  }

  function caseSuccess($i, $j, $dir) {
    $GLOBALS['ROBOT_ARRAY'][$i][$j] = '1';

    if($dir === 'N') {
      $GLOBALS['ROBOT_ARRAY'][$i - 1][$j]  = 'x';
    } else if($dir === 'S') {
      $GLOBALS['ROBOT_ARRAY'][$i + 1][$j]  = 'x';
    } else if($dir === 'L') {
      $GLOBALS['ROBOT_ARRAY'][$i][$j + 1]  = 'x';
    } else if($dir === 'O') {
      $GLOBALS['ROBOT_ARRAY'][$i][$j - 1]  = 'x';
    }
  }

  function moveRobot($control) {
    $amount = intval($control[1]);
    
    $isSuccess = true;
    for($i = 0; $i < $amount; $i++) {
      $robot_pos = getRobotActualPos();

      if($control[0] === 'N') {
        $response = compareAndMove($robot_pos[0] - 1, $robot_pos[1]);

        if($response === "FAILED") {
          caseFailed($robot_pos[0] - 1, $robot_pos[1]);
          $isSuccess = false;
          break;
        }

        if($response === "SUCCESS") {
          caseSuccess($robot_pos[0], $robot_pos[1], $control[0]);
        }
      }

      if($control[0] === 'S') {
        $response = compareAndMove($robot_pos[0] + 1, $robot_pos[1]);

        if($response === "FAILED") {
          caseFailed($robot_pos[0] + 1, $robot_pos[1]);
          $isSuccess = false;
          break;
        }

        if($response === "SUCCESS") {
          caseSuccess($robot_pos[0], $robot_pos[1], $control[0]);
        }
      }

      if($control[0] === 'L') {
        $response = compareAndMove($robot_pos[0], $robot_pos[1] + 1);

        if($response === "FAILED") {
          caseFailed($robot_pos[0], $robot_pos[1] + 1);
          $isSuccess = false;
          break;
        }

        if($response === "SUCCESS") {
          caseSuccess($robot_pos[0], $robot_pos[1], $control[0]);
        }
      }

      if($control[0] === 'O') {
        $response = compareAndMove($robot_pos[0], $robot_pos[1] - 1);

        if($response === "FAILED") {
          caseFailed($robot_pos[0], $robot_pos[1] - 1);
          $isSuccess = false;
          break;
        }

        if($response === "SUCCESS") {
          caseSuccess($robot_pos[0], $robot_pos[1], $control[0]);
        }
      }
    }
    
    if($isSuccess) {
      echo "SUCCESS";
    }
  }

  initializeArrays();
  $escolha = "";

  while($escolha !== "SAIR") {
    echo "\n";
    $escolha = readline("ENTRE UM COMANDO NO FORMATO\n<abre_colchete>ORIENTAÇÃO<espaço em branco>TOTAL_MOV<fecha_colchete>\nou SAIR para encerrar o programa\n  -> ");
    
    $control = parseInput($escolha);
    if($control === '00') {
      printRobot();
    } else {
      moveRobot($control);
    }
  }
  
?>