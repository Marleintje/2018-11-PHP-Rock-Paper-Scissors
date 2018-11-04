<!-- game.php MARLEIN -->
<!-- MODEL -->

<?php

// Demand a GET parameter
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing');
}

// If the user requested logout go back to index.php
if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}

// Set up the values for the game...
// 0 is Rock, 1 is Paper, and 2 is Scissors
$names = array('Rock', 'Paper', 'Scissors');
$human = isset($_POST["human"]) ? $_POST['human']+0 : -1;
$computer = rand(0,2);

// I realise that nested 'if' loops could have been an option, but for this easy game I preferred short syntax.
function check($computer, $human) {
  if ($human == $computer) {
    return "Tie";
  } else if ( $human == 0 && $computer == 2 || 
              $human == 1 && $computer == 0 ||
              $human == 2 && $computer == 1) {
    return "You Win";
  } else if ( $computer == 0 && $human == 2 || 
              $computer == 1 && $human == 0 ||
              $computer == 2 && $human == 1) {
    return "You Lose";
  }
}

// Check to see how the play happenned
$result = check($computer, $human);

?>

<!-- VIEW -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" media="screen" href="game.css" />
    <title>Marlein Rusch | Rock, Paper, Scissors Game - eff2afaf</title>
  </head>
  <body>
    <div class="game-container">
      <h1>Rock Paper Scissors</h1>
      <?php
      if ( isset($_REQUEST['name']) ) {
          echo "<p>Welcome: ";
          echo htmlentities($_REQUEST['name']);
          echo "</p>\n";
      }
      ?>
      <form method="post">
        <select name="human">
          <option value="-1">Select</option>
          <option value="0">Rock</option>
          <option value="1">Paper</option>
          <option value="2">Scissors</option>
          <option value="3">Test</option>
        </select>
          <input type="submit" value="Play">
          <input type="submit" name="logout" value="Logout">
      </form>

      <!-- <pre> -->
      <div>
      <br/>
        <?php
        if ( $human == -1 ) {
            print "Please select a strategy and press Play.\n";
        } else if ( $human == 3 ) {
            for($c=0;$c<3;$c++) {
                for($h=0;$h<3;$h++) {
                    $r = check($c, $h);
                    print "Human=$names[$h] Computer=$names[$c] Result=$r\n<br/>";
                }
            }
        } else {
            print "Your Play=$names[$human] Computer Play=$names[$computer] Result=$result\n<br/>";
        }
        ?>
      </div>
      <!-- </pre> -->
    </div>
  </body>
</html>
