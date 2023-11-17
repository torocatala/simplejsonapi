<?php
function isBalanced($str) {
    $stack = [];
    $bracketPairs = [
        ')' => '(',
        ']' => '[',
        '}' => '{'
    ];

    for ($i = 0; $i < strlen($str); $i++) {
        $char = $str[$i];

        if (in_array($char, ['(', '[', '{'])) {
            // If it's an opening bracket, push it onto the stack
            array_push($stack, $char);
        } elseif (in_array($char, [')', ']', '}'])) {
            // If it's a closing bracket, check if it corresponds to the last opening bracket
            if (count($stack) == 0 || array_pop($stack) != $bracketPairs[$char]) {
                // If the stack is empty or the brackets don't match, it's not balanced
                return false;
            }
        }
    }

    // If the stack is empty, all brackets were properly closed
    return count($stack) == 0;
}


// Usage
echo isBalanced("([])[]({})") ? 'true' : 'false';
echo isBalanced("([)]") ? 'true' : 'false';
echo isBalanced("((()") ? 'true' : 'false';
echo isBalanced("((") ? 'true' : 'false';
echo isBalanced("))") ? 'true' : 'false';
echo isBalanced("({[])}") ? 'true' : 'false';