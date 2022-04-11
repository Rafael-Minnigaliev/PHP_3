<?php
function bubbleSort(array $data) {
    $count_elements = count($data); 
    $iterations = $count_elements - 1;
    $countOperations = 0;

    for ($i=0; $i < $count_elements; $i++) {
        $changes = false;
        for ($j=0; $j < $iterations; $j++) {
            if ($data[$j] > $data[($j + 1)]) {
                $changes = true;
                list($data[$j], $data[($j + 1)]) = array($data[($j + 1)], $data[$j]);
                $countOperations++;
            }
        }
        $iterations--;
        if (!$changes) {
            echo "Количество операций: ".$countOperations." --- "; 
            return $data;
        }
    } 
    return $data;
}

function shakerSort($array) {
    $n = count($array);
    $left = 0;
    $right = $n - 1;
    $countOperations = 0;

    do {
        for ($i = $left; $i < $right; $i++) {
            if ($array[$i] > $array[$i + 1]) {
                list($array[$i], $array[$i + 1]) = array(
                    $array[$i + 1],
                    $array[$i]
                );
                $countOperations++;
            }
        }
        $right -= 1;
        for ($i = $right; $i > $left; $i--) {
            if ($array[$i] < $array[$i - 1]) {
                list($array[$i], $array[$i - 1]) = array(
                    $array[$i - 1],
                    $array[$i]
                );
                $countOperations++;
            }
        }
        $left += 1;
    } while ($left <= $right);
    echo "Количество операций: ".$countOperations." --- "; 
    return $array;
}

function quickSort(array $arr) {
    $countOperations = 0;
    $count= count($arr);
    if ($count <= 1) {
        return $arr;
    }

    $first_val = $arr[0];
    $left_arr = array();
    $right_arr = array();

    for ($i = 1; $i < $count; $i++) {
        if ($arr[$i] <= $first_val) {
            $left_arr[] = $arr[$i];
        } else {
            $right_arr[] = $arr[$i];
        }
        $countOperations++;
    }

    $left_arr = quickSort($left_arr);
    $right_arr = quickSort($right_arr);
    
    return [array_merge($left_arr, array($first_val), $right_arr), $countOperations]; 
}

function heapify($arr, $countArr, $i) {
    $largest = $i; 
    $left = 2 * $i + 1; 
    $right = 2 * $i + 2; 
    
    if ($left < $countArr && $arr[$left] > $arr[$largest])
        $largest = $left;

    if ($right < $countArr && $arr[$right] > $arr[$largest])
        $largest = $right;
    
    if ($largest != $i) {
        $swap = $arr[$i];
        $arr[$i] = $arr[$largest];
        $arr[$largest] = $swap;
        heapify($arr, $countArr, $largest);
    }
}
function heapSort($arr) {
    $countArr = count($arr);
    $countOperations = 0;
    for ($i = $countArr / 2 - 1; $i >= 0; $i--){
        $countOperations++;
        heapify($arr, $countArr, $i);
    }
        
    for ($i = $countArr - 1; $i >= 0; $i--) {
        $temp = $arr[0];
        $arr[0] = $arr[$i];
        $arr[$i] = $temp;
        $countOperations++;
        heapify($arr, $i, 0);
    }
    echo "Количество операций: ".$countOperations." --- "; 
    return $arr;
}



$countEl = 10000; 
$array = [];
$arrTime = [];

for ($i = 0; $i < $countEl; $i++){
    $array[$i] = rand(0, $countEl);
}



$time1 = microtime(true);
bubbleSort($array);
echo "bubbl: ".round(microtime(true) - $time1, 5)."<br>";
$arrTime[] =  round(microtime(true) - $time1, 5);

$time1 = microtime(true);
$data = quickSort($array);
echo "Количество операций: ".$data[1]." --- quick: ".round(microtime(true) - $time1, 5)."<br>";
$arrTime[] =  round(microtime(true) - $time1, 5);

$time1 = microtime(true);
shakerSort($array);
echo "shaker: ".round(microtime(true) - $time1, 5)."<br>";
$arrTime[] =  round(microtime(true) - $time1, 5);

$time1 = microtime(true);
heapSort($array);
echo "heap: ".round(microtime(true) - $time1, 5)."<br>";
$arrTime[] =  round(microtime(true) - $time1, 5);

$time1 = microtime(true);
sort($array);
echo "sort: ".round(microtime(true) - $time1, 5)."<br>";
$arrTime[] =  round(microtime(true) - $time1, 5);

$time1 = microtime(true);
rsort($array);
echo "rsort: ".round(microtime(true) - $time1, 5)."<br>";
$arrTime[] =  round(microtime(true) - $time1, 5);


print_r(quickSort($arrTime));
echo "<hr>";

//---------------------------------------------------------------------------------------------------------------

function LinearSearch($myArray, $num) {
    $count = count($myArray);
    $countOperations = [];

    for ($i = 0; $i < $count; $i++) {
        if ($myArray[$i] == $num) {
            $countOperations[] = $i + 1;
            unset($myArray[$i]);
        };
    }
    echo "Количество операций до первого совпадения: ".$countOperations[0]."<br>";
    return $myArray;
}

$countEl = 10;
$array = [];


for ($i = 0; $i < $countEl; $i++) {
    $array[$i] = rand(0, $countEl);
}

print_r($array);
echo "<br>";
print_r(LinearSearch($array, 7));