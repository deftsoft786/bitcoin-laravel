<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your Email Address</h2>

        <div>
            Thanks for creating an account with the verification ecex.io.
            Please follow the link below to verify your email address
            {{url('verify/'.$confirmation_code) }}.<br/>
            <p> Your Unique Account_id :  {{$address}} </p>
            <p> Your Password :  {{$visible_password}} </p>
            <br/>
            ecex.io Account Id & Password are important and use for Login!
            <p style="color:red;">Dont share and keep it secret</p>

        </div>
   <h2>Best Regards</h2></br>
        ecex.io     
    </body>
</html>