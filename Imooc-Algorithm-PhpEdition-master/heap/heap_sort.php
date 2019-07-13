<?php
include_once("max_heap.php");
include_once("../disorderly_array.php");

/**
 * 堆排序一，将未排序数组元素一一添加入堆中
 *
 * @param array $init_array
 * @return void
 */
function heap_sort_one($init_array){
    $max_heap = new MaxHeap();
    foreach($init_array as $v){
        $max_heap->insert($v);
    }
    $count = $max_heap->size();
    for($i=0; $i < $count; $i++){
        $init_array[$i] = $max_heap->extract_max();
    }
    return $init_array;
}

/**
 * 堆排序二，将未排序数组一次添加入堆中
 *
 * @param array $init_array
 * @return void
 */
function heap_sort_two($init_array){
    $max_heap = new MaxHeap();
    $max_heap->all_insert_heap($init_array);
    $count = $max_heap->size();
    for($i=0; $i < $count; $i++){
        $init_array[$i] = $max_heap->extract_max();
    }
    return $init_array;
}

$init_array = disorderly_array(100, 0, 100);
$s_time = time();
heap_sort_two($init_array);
$e_time = time();
print_r("运行时间：". ($e_time - $s_time). 's');