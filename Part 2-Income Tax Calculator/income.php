<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{
                background-color: #94b4a4;
                font-family: arial;
            }
            .incomeinfo{
                background-color: #d2f5e3;
                margin: 30px auto;
                width: 90%;
                border-radius: 20px;
                padding-top: 30px;
                padding-left: 50px;
                padding-bottom: 30px;
                font-size: 20px;
                color: #213e3b;
            }
            .input{
                font-size: 20px;
                width: 60%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            .button{
                background-color: #41aea9;
                border: none;
                border-radius: 4px;
                color: #213e3b;
                padding: 16px 32px;
                text-decoration: none;
                margin: 4px 2px;
                cursor: pointer;
                font-size: 18px;
            }
            .error{
                color: #FF0000;
            }
            h1{
                color: #ffa5a5;
            }
            table {
                border-collapse: collapse;
                width: 80%;
                margin-left: 10%;
                font-size: 20px;
            }

            th, td {
                text-align: left;
                padding: 8px;
            }
            td:nth-child(1){
                color: white;
                font-weight: bold;
            }

            tr{
                background-color: #f4d9c6;
            }

            th {
                background-color: #e5c5b5;
                color: white;
            }
        </style>
        <title>Income Tax Calculator</title>
    </head>
    <body>
        <?php
            $salary = $type = $allowance = "";
            $salaryErr = $typeErr = $allowanceErr = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["salary"])) {
                    $salaryErr = "Salary is required";
                } else {
                    $salary = test_input($_POST["salary"]);
                    if(!is_numeric($salary)){
                        $salaryErr = "Please enter a number";
                    }
                }
                if (empty($_POST["type"])) {
                    $typeErr = "Type is required";
                } else {
                    $type = test_input($_POST["type"]);
                }
                if (empty($_POST["allowance"])) {
                    $allowanceErr = "Tax Free Allowance is required";
                } else {
                    $allowance = test_input($_POST["allowance"]);
                    if(!is_numeric($allowance)){
                        $allowanceErr = "Please enter a number";
                    }
                }
            
                $salarytax = $salaryssf = $totalsalary = $allowanceperyear = $salaryperyear = 0;
                if (isset($type) && $type=="Yearly"){
                    $salaryperyear = $salary;
                    $allowanceperyear = $allowance;
                    if ($salaryperyear < 10000){
                        $totalsalary = $salaryperyear + $allowanceperyear;
                    }
                    elseif($salaryperyear > 10000 && $salaryperyear < 25000){
                        $salarytax = $salaryperyear * (11 / 100);
                        $salaryssf = $salaryperyear * (4 / 100);
                        $totalsalary = ($salaryperyear - ($salarytax + $salaryssf)) + $allowanceperyear;
                    }
                    elseif($salaryperyear > 25000 && $salaryperyear < 50000){
                        $salarytax = $salaryperyear * (30 / 100);
                        $salaryssf = $salaryperyear * (4 / 100);
                        $totalsalary = ($salaryperyear - ($salarytax + $salaryssf)) + $allowanceperyear;
                    }
                    else{
                        $salarytax = $salaryperyear * (45 / 100);
                        $salaryssf = $salaryperyear * (4 / 100);
                        $totalsalary = ($salaryperyear - ($salarytax + $salaryssf)) + $allowanceperyear;
                    }
                }
                elseif(isset($type) && $type=="Monthly"){
                    $salaryperyear = $salary * 12;
                    $allowanceperyear = $allowance * 12;
                    if ($salaryperyear < 10000){
                        $totalsalary = $salaryperyear + $allowanceperyear;
                    }
                    elseif($salaryperyear > 10000 && $salaryperyear < 25000){
                        $salarytax = $salaryperyear * (11 / 100);
                        $salaryssf = $salaryperyear * (4 / 100);
                        $totalsalary = ($salaryperyear - ($salarytax + $salaryssf)) + $allowanceperyear;
                    }
                    elseif($salaryperyear > 25000 && $salaryperyear < 50000){
                        $salarytax = $salaryperyear * (30 / 100);
                        $salaryssf = $salaryperyear * (4 / 100);
                        $totalsalary = ($salaryperyear - ($salarytax + $salaryssf)) + $allowanceperyear;
                    }
                    else{
                        $salarytax = $salaryperyear * (45 / 100);
                        $salaryssf = $salaryperyear * (4 / 100);
                        $totalsalary = ($salaryperyear - ($salarytax + $salaryssf)) + $allowanceperyear;
                    }
                }
                $salarymonthly = $salarytaxmonthly = $salaryssfmonthly= $totalsalarymonthly  = 0;
                $salarymonthly = $salaryperyear / 12;
                $salarytaxmonthly = $salarytax / 12;
                $salaryssfmonthly = $salaryssf / 12;
                $totalsalarymonthly = $totalsalary / 12;

                
            }
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
        <div class="incomeinfo">
        <h1> Please enter your salary information</h1>
        <p><span class="error">* required field</span></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label>Salary in USD:<br>
            <input class="input" type = "text" name = "salary" value = "<?php echo $salary ?>">
            <span class="error">* <?php echo $salaryErr;?></span>
            </label>
            <br><br>
            This is your salary: 
            <span class="error">* <?php echo $typeErr;?></span>
            <br><br>
            <input type="checkbox" name="type" <?php if (isset($type) && $type=="Monthly") echo "checked";?>
            value="Monthly">Monthly
            <input type="checkbox" name="type" <?php if (isset($type) && $type=="Yearly") echo "checked";?>
            value="Yearly">Yearly
            <br><br>
            <label>Tax Free Allowance in USD: <br>
            <input class = "input" type = "text" name ="allowance" value = "<?php echo $allowance ?>">
            <span class="error">* <?php echo $allowanceErr;?></span>
            </label>
            <br><br>
            <input class ="button" type="submit" name="submit" value="Calculate">
        </form>
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($salaryErr == "" && $typeErr == "" && $allowanceErr == ""){
            echo "<table>
            <tr>
                <th>Income with Taxes</th>
                <th>Monthly</th>
                <th>Yearly</th>
            </tr>
            <tr>
                <td>Total Salary</td>
                <td>$salarymonthly$</td>
                <td>$salaryperyear$</td>
            </tr>
            <tr>
                <td>Tax Amount</td>
                <td>$salarytaxmonthly$</td>
                <td>$salarytax$</td>
            </tr>
            <tr>
                <td>Social Security Fee</td>
                <td>$salaryssfmonthly$</td>
                <td>$salaryssf$</td>
            </tr>
            <tr>
                <td>Salary After Tax</td>
                <td>$totalsalarymonthly$</td>
                <td>$totalsalary$</td>
            </tr>
            </table>";
            }
        }
        ?>

    </body>
</html>