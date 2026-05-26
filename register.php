$mail = new PHPMailer(true);

try{

    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';

    $mail->SMTPAuth = true;

    $mail->Username = 'vishalmunu2006@gmail.com';

    $mail->Password = 'abcdefghijklmnop';

    $mail->SMTPSecure = 'tls';

    $mail->Port = 587;


    $mail->setFrom(
        'vishalmunu2006@gmail.com',
        'Wheels India Limited'
    );

    $mail->addAddress($email);


    $mail->isHTML(true);

    $mail->Subject =
    'Registration Successful';


    $mail->Body = "

    <div style='font-family:Arial;
                padding:20px;'>

    <h2 style='color:#007bff;'>

    Wheels India Limited

    </h2>

    <p>

    Hello <b>$full_name</b>,

    </p>

    <p>

    Your registration has been
    completed successfully.

    </p>

    <p>

    Username:
    <b>$username</b>

    </p>

    <p>

    Welcome to Travel Management
    System.

    </p>

    </div>

    ";


    $mail->send();

}
catch(Exception $e){

    echo $mail->ErrorInfo;

}