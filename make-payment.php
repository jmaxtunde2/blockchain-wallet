
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Blockchain Wallet service Implementation</title>

    <!-- Bootstrap core CSS -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sticky-footer/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    
        <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
  </head>
  <body class="d-flex flex-column h-100">
    
<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">
    <p> 
        <a href="index.php">Return to Home Page</a> 
    </p>
    <h1 class="mt-3">Make Outgoing Payment</h1>
    <p class="lead"> Send bitcoin from your wallet to another bitcoin address.</p>
   
        <form action="make-payment.php" method="POST">
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-semibold" for="question">Main Password :</label>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Your Password">
                </div>
            </div>
            <br/>

            

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-semibold" for="question">Send To :</label>
                        <input type="text" class="form-control" id="to" name="to" required placeholder="Recipient Bitcoin Address">
                </div>
            </div>
            <br/>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-semibold" for="question">Amount :</label>
                        <input type="text" class="form-control" id="amount" name="amount" required placeholder="Amount to send">
                </div>
            </div>
            <br/>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-semibold" for="question">Send from :</label>
                        <input type="text" class="form-control" id="from" name="from" required placeholder="Send from a specific Bitcoin Address">
                </div>
            </div>
            <br/>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="font-weight-semibold" for="question">Fee :</label>
                        <input type="text" class="form-control" id="fee" name="fee" required placeholder="Transaction fee value">
                </div>
            </div>
            <br/>

           
            <div class="col-12">
                <input class="btn btn-primary" type="submit" name="payment" value="Make Payment"/>
            </div>
        </form>

        <?php
            if (isset($_POST['payment'])) 
            {
                if(strlen($_POST['password']) >=6)
                {   
                    
                    $password = $_POST['password'];
                    $fee      = $_POST['fee'];
                    $from     = $_POST['from'];
                    $amount   = $_POST['amount'];
                    //$second_password = $_POST['second_password'];
                    $to       = $_POST['to'];
                    $guid     = "9215bd73-32d6-4b9a-9427-e974fb032673";

                    //$url = "http://localhost:3000/merchant/$guid/payment";
                    $url = "https://private-anon-58f5b31942-blockchaininfo.apiary-proxy.com/merchant/".$guid."/payment";
                    //
                   
                    $ch = curl_init();                    
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                    
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,"password=".$password."&to=".$to."&amount=".$amount."&from=".$from."&fee=".$fee);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    $output = json_decode($output, true);
                    var_dump($output);
                }else 
                {
                    echo "Password Must be at least 10 characters in length";
                }
            }
        ?>
  </div>
</main>

<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <span class="text-muted">Wallet service Implementation.</span>
  </div>
</footer>


    
  </body>
</html>
