<!-- Write a function solution that, given two integers A and B, returns a string containing exactly A letters 'a' and exactly B letters 'b' with no three consecutive letters being the same (in other words, neither "aaa" nor "bbb" may occur in the returned string).

Examples:

1. Given A = 5 and B = 3, your function may return "aabaabab". Note that "abaabbaa" would also be a correct answer. Your function may return any correct answer.

2. Given A = 3 and B = 3, your function should return "ababab", "aababb", "abaabb" or any of several other strings.

3. Given A = 1 and B = 4, your function should return "bbabb", which is the only correct answer in this case.

Assume that:

A and B are integers within the range [0..100];
at least one solution exists for the given A and B.
In your solution, focus on correctness. The performance of your solution will not be the focus of the assessment. -->
<div style="">
<?php
    // $setA = rand(0,20);
    // $setB = rand(0,20);

    $setA = 57;
    $setB = 32;
    if($setA>=$setB) { $a=$setA;$b=$setB; } else { $a=$setB;$b=$setA; }
    echo 'Random numbers:<br>';
    echo 'a=' .$a ;
    echo '<br>';
    echo 'b=' .$b ;
    echo '<br>';

    $string = '';

    $i=1;
    if ($b==0 && $a>3) {
        echo 'no poss';
        exit();
    }
    if ($b%2!=0) {
        $string = 'b';
        $b--;
    }
    if ($a>=$b && $a<=2*($b+1)) {
        do {
            echo 'TEST<br>';    
            if ($a/2>=$b) {
                $string = $string . 'aabb';
                $a=$a-2;
                $b=$b-2;
                echo 'a: ' .$a;
                echo '<br>';
                echo 'b: ' .$b;
                echo '<br>';
                echo $string . ' dalej robię<br>';
            }
            else {
                $string = $string . 'aab';
                $a=$a-2;
                $b=$b-1;
                echo $i . ': ' . $string;
                echo '<br>';
                $i++;
                
                echo 'a: ' .$a;
                echo '<br>';
                echo 'b: ' .$b;
                echo '<br>';
                if($a==2*($b+1)) {
                    if ($b==1 && $a==4) { $string = $string . 'aabaa'; break; }
                    if ($b==1 && $a==3) { $string = $string . 'aaba'; break;}
                    if ($b==1 && $a==2) { $string = $string . 'aab'; break;}
                    if ($b==1 && $a==1) { $string = $string . 'ab'; break;}
                }
            echo "kolejna pętla<br>";
            }
        }
        while ($b>1);
    }

    else { echo 'no poss'; die; }

    // echo cut($strA, $str);
    // echo '<br>';

    // echo cut($strB, $str);
    // echo '<br>';
    // echo '<hr>';


    echo '<hr>';
    echo $string;

