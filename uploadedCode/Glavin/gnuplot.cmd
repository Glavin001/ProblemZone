set xrange [0:100]
set yrange [0:100]
unset mouse
set title 'The set of raw points in the set' font 'Arial,12'
set style line 1 pointtype 7 linecolor rgb 'red'
set style line 2 pointtype 7 linecolor rgb 'green'
set style line 3 pointtype 7 linecolor rgb 'black'
plot '-' ls 1 with points notitle
35 17
36 74
98 93
51 97
57 65
4 74
68 91
38 38
51 58
30 40
7 36
66 52
81 97
32 41
18 44
55 20
61 92
94 58
50 44
21 73
e
pause -1 'Hit OK to move to the next state'
set title 'The points partitioned into an upper and lower hull' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 2 with points notitle, '-' ls 3 with linespoints notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
e
51 97
61 92
68 91
81 97
e
4 74
98 93
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
18 44
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
18 44
21 73
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
18 44
21 73
30 40
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: backtracking' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
18 44
30 40
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: backtracking' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
30 40
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
30 40
32 41
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
30 40
32 41
35 17
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: backtracking' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
30 40
35 17
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: backtracking' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
36 74
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
36 74
38 38
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: backtracking' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
38 38
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
38 38
50 44
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: backtracking' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
50 44
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
50 44
51 58
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
50 44
51 58
55 20
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: backtracking' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
50 44
55 20
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: backtracking' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
55 20
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
55 20
57 65
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
55 20
57 65
66 52
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: backtracking' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
55 20
66 52
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
55 20
66 52
94 58
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: backtracking' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
55 20
94 58
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
55 20
94 58
98 93
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
55 20
94 58
98 93
e
51 97
4 74
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
55 20
94 58
98 93
e
61 92
51 97
4 74
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
55 20
94 58
98 93
e
68 91
61 92
51 97
4 74
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: backtracking' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
55 20
94 58
98 93
e
68 91
51 97
4 74
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
55 20
94 58
98 93
e
81 97
68 91
51 97
4 74
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: backtracking' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
55 20
94 58
98 93
e
81 97
51 97
4 74
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: adding a new point' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
55 20
94 58
98 93
e
98 93
81 97
51 97
4 74
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
set title 'The hull in state: complete' font 'Arial,12'
plot '-' ls 1 with points notitle, '-' ls 3 with linespoints notitle, '-' ls 3 with linespoints notitle, '-' ls 2 with points notitle
7 36
18 44
21 73
30 40
32 41
35 17
36 74
38 38
50 44
51 58
55 20
57 65
66 52
94 58
98 93
e
4 74
7 36
35 17
55 20
94 58
98 93
e
98 93
81 97
51 97
4 74
e
51 97
61 92
68 91
81 97
e
pause -1 'Hit OK to move to the next state'
