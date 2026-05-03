<?php
session_start();

if (isset($_POST['reset'])) {
    $_SESSION['board'] = array_fill(0, 9, '');
    $_SESSION['turn'] = 'X';
    $_SESSION['winner'] = null;
}

if (!isset($_SESSION['board'])) {
    $_SESSION['board'] = array_fill(0, 9, '');
    $_SESSION['turn'] = 'X';
    $_SESSION['winner'] = null;
}

if (isset($_POST['move']) && !$_SESSION['winner']) {
    $pos = $_POST['move'];
    if ($_SESSION['board'][$pos] == '') {
        $_SESSION['board'][$pos] = $_SESSION['turn'];
        
        // Check winner
        $wins = [[0,1,2], [3,4,5], [6,7,8], [0,3,6], [1,4,7], [2,5,8], [0,4,8], [2,4,6]];
        foreach ($wins as $w) {
            if ($_SESSION['board'][$w[0]] != '' && 
                $_SESSION['board'][$w[0]] == $_SESSION['board'][$w[1]] && 
                $_SESSION['board'][$w[1]] == $_SESSION['board'][$w[2]]) {
                $_SESSION['winner'] = $_SESSION['board'][$w[0]];
                break;
            }
        }
        
        // Check draw
        if (!$_SESSION['winner'] && !in_array('', $_SESSION['board'])) {
            $_SESSION['winner'] = 'Draw';
        }
        
        $_SESSION['turn'] = $_SESSION['turn'] == 'X' ? 'O' : 'X';
    }
}

$board = $_SESSION['board'];
$turn = $_SESSION['turn'];
$winner = $_SESSION['winner'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tic-Tac-Toe</title>
    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            text-align: center;
        }
        
        h1 {
            color: #333;
            margin: 0 0 20px 0;
        }
        
        .board {
            display: grid;
            grid-template-columns: repeat(3, 100px);
            gap: 10px;
            margin: 20px auto;
        }
        
        .cell {
            width: 100px;
            height: 100px;
            background: #f0f0f0;
            border: 3px solid #ddd;
            border-radius: 10px;
            font-size: 48px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }
        
        .cell:hover {
            background: #e0e0e0;
            transform: scale(1.05);
        }
        
        .cell.x {
            color: #2196F3;
        }
        
        .cell.o {
            color: #f44336;
        }
        
        .info {
            margin: 20px 0;
            font-size: 18px;
            color: #555;
        }
        
        .winner {
            background: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            font-size: 20px;
        }
        
        button {
            padding: 12px 30px;
            background: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        
        button:hover {
            background: #0b7dda;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎮 Tic-Tac-Toe</h1>
        
        <?php if ($winner): ?>
            <div class="winner">
                <?php echo $winner == 'Draw' ? "It's a Draw!" : "Player $winner Wins!"; ?>
            </div>
        <?php else: ?>
            <div class="info">Current Turn: <strong>Player <?php echo $turn; ?></strong></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="board">
                <?php for ($i = 0; $i < 9; $i++): ?>
                    <?php if ($board[$i] == '' && !$winner): ?>
                        <button type="submit" name="move" value="<?php echo $i; ?>" class="cell">
                            <?php echo $board[$i]; ?>
                        </button>
                    <?php else: ?>
                        <div class="cell <?php echo strtolower($board[$i]); ?>">
                            <?php echo $board[$i]; ?>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
            <button type="submit" name="reset">New Game</button>
        </form>
    </div>
</body>
</html>