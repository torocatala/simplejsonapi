A recursive solution that iterates and swaps elements, tracking 'seen' numbers to avoid duplicates in each permutation path. The recursion continues until each permutation reaches full length, storing each unique combination in a results array, efficiently handling duplicates in the input.


Mermaid diagram illustrating an execution:


graph TD
    A("permute([1, 1, 2], 0)")
    B("permute([1, 1, 2], 1)")
    C("permute([1, 1, 2], 2) - Result [1, 1, 2]")
    D("permute([1, 2, 1], 1)")
    E("permute([1, 2, 1], 2) - Result [1, 2, 1]")
    F("permute([2, 1, 1], 0)")
    G("permute([2, 1, 1], 1)")
    H("permute([2, 1, 1], 2) - Result [2, 1, 1]")

    A -->|"No swap (duplicate)"| B
    B -->|"No swap (duplicate)"| C
    A -->|"Swap 1 & 3"| F
    F -->|"No swap (duplicate)"| G
    G -->|"Swap 2 & 3"| H
    B -->|"Swap 2 & 3"| D
    D -->|"No swap (duplicate)"| E