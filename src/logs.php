<?php
// Initialize the session
session_start();
$username = $_SESSION['username'];// grab the session username
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}

$config['db'] = array(
	'host'			=>'localhost',//'rmorga5180688.ipagemysql.com',
	'username'		=>'rmorga51',
	'password'		=>'',
	'dbname'		=>'accounting'
);

$db = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'], $config['db']['username'], $config['db']['password']); 
$db->setATTRIBUTE(PDO::ATTR_EMULATE_PREPARES, false);
$db->setATTRIBUTE(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$logsQuery = $db->query("SELECT * FROM log_page ORDER BY id DESC");  // 
////////////FILTER FOR USERNAME////////////////
if (isset($_GET['Subject'])) {
if ($logsQuery = $db->prepare("SELECT * FROM log_page WHERE  username = :subject ORDER BY ID DESC"))
{
    $logsQuery->execute(array(':subject' => $_GET['Subject']));
	//$queryMsg = "Results from $_GET[username]";
}
}
/////////////FILTER FOR USER TYPE///////////////
if (isset($_GET['Subject1'])) {
if ($logsQuery = $db->prepare("SELECT * FROM log_page WHERE  usertype = :subject ORDER BY ID DESC"))
{
    $logsQuery->execute(array(':subject' => $_GET['Subject1']));
	//$queryMsg = "Results from $_GET[username]";
}
}
////////////////FILTER BY ACTIVITY/////////////
if (isset($_GET['Subject2'])) {
    if ($logsQuery = $db->prepare("SELECT * FROM log_page WHERE  activity LIKE :subject ORDER BY ID DESC"))
    {
        $logsQuery->execute(array(':subject' => '%' . $_GET['Subject2']. '%'));
        //$queryMsg = "Results from $_GET[username]";
    }
    }


?>
<html lang = en>
    <head>
                <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <!-- CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
            <link rel="stylesheet" href="css/header.css"/>
            <link rel="stylesheet" href="css/Logs.css"/>
            <style>
                        #logs td, #logs th {
                    border: 1px solid #ddd;
                    padding: 8px;
                }

                #logs tr:nth-child(even){background-color: #f2f2f2;}

                #logs tr:hover {background-color: #ddd;}

                #logs th {
                    padding-top: 12px;
                    padding-bottom: 12px;
                    text-align: left;
                    background-color: #4CAF50;
                    color: white;

            
                }

                .table td {
                    text-align: center;

                }
                .table {
                    border-radius: 5px,;
                    width: 50%;
                    margin:auto;

                }
                .row{
                    margin-left:15%;
                }
                legend{
    margin-top:5%;
    margin-bottom:5%;
}
        </style>
                <!---Title -->
            <title>AnyWhere-Logs</title>
    </head>
    <body>
<?php
	//print_r($_SESSION);
?>
      
        
              <!-- Header-->


                      <nav class="navbar navbar-expand navbar-primary">
                <header class="navbar-brand" href="./home.html"><img src="assets/logo.png" alt="bluePrint" height="60"/></header>
                
                <span class="navbar-toggler-icon"></span>
              
            
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link active" href="./home.php">Home<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"href="./COA.php">Charts of Account</a>
                  </li>
                  <?php // to hide 'Manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username ='$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the Manager review link*/
				if($userType != 'Administrator'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./JournalEntry.php">Journal Entry</a>
                </li>';	
				}
				?>
				
				<?php // to hide 'Manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the Manager review link*/
				if($userType == 'Manger'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./ManagerReview.php">Manager Review</a>
                </li>';	
				}
				?>
                  <?php // to hide 'Manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the Manager review link*/
				if($userType != 'Administrator'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./ledgerAccounts.php">Accounts Ledgers</a>
                </li>';	
				}
				?>
                  <?php // to hide 'Manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the Manager review link*/
				if($userType != 'Administrator'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./accounts.php">Accounts</a>
                </li>';	
				}
				?>
                  <?php // to hide 'Manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the Manager review link*/
				if($userType != 'Administrator'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./FinancialStatements.php">Financial Statements</a>
                </li>';	
				}
				?>
                  <?php // to hide 'Manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the Manager review link*/
				if($userType != 'Administrator'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./logs.php">logs</a>
                </li>';	
				}
				?>
      
      
                </ul>
                
              </div>
              <div class="pull-right">
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="navbarDropdown" href="./logout.php"><span class="glyphicon glyphicon-user"></span> <?php echo htmlspecialchars($_SESSION['username']); ?></a>
                  </li>
                  <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="navbarDropdown" href="./help.php"><span class="glyphicon glyphicon-question-sign"></span> Help</a>
                  </li>
                </ul>
              </div>
            </nav>



            <!--Logs-->
            
        <ul class="refresh">

</ul>
<legend class="" align="center" text-size=""><strong>Logs</strong></legend>
<div class="row">
<form method="get" action="logs.php" class="col-lg-4 col-md-6" id="filter1">
<select style="" name="Subject" >
            <option selected="selected" value="" disabled>User</option>
            <?php
                $users = $db->query("SELECT DISTINCT username FROM log_page");
                while($row = $users->fetch(PDO::FETCH_ASSOC)){
                    echo '<option value ="'. $row['username']. '">' . $row['username']. '</option>';
                }
            ?>
</select>
<input type="submit" value="Filter" style="">
</form>
        <form method="get" action="logs.php" class="col-lg-4 col-md-6" id="filter2">
<select style="" name="Subject1" >
	<option selected="selected" value="" disabled>User Type</option>
	<option value="regular">Regular</option>
	<option value="Manager">Manager</option>
	<option value="administrator">Administrator</option>
</select>
<input type="submit" value="Filter" style="">
</form>
        
        </form>
        <form method="get" action="logs.php" class="col-lg-4 col-md-6" id="filter3">
<select style="" name="Subject2" >
	<option selected="selected" value="" disabled>Activity</option>
	<option value="entry was">Journal Entries</option>
    <option value="was approved">Manager Approvals</option>
    <option value="was rejected">Manager Rejections</option>
    <option value="Account Created:">Accounts Created</option>

</select>
<input type="submit" value="Filter" style="">
</form>
            </div>
        
        
        <div><table id="logs" class=" table table-hover text-centered" style=""><tr><td>User</td><td>User Type</td><td>Activity</td><td>Date</td></tr>
        <?php

        while($row = $logsQuery->fetch(PDO::FETCH_ASSOC)){
            echo '<tr><td id="'.$row['username'].'">' .$row['username']. '</td>';
            echo '<td id="">' .$row['usertype']. '</td>';
            echo '<td>' .$row['activity']. '</td>';
            echo '<td>' .$row['date']. '</td></tr>';
        }
        ?>
        </table></div>





    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>
</html>