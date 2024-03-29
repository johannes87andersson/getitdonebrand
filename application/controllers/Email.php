<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email
 *
 * @author ziinloader
 */
class Email {

    private $email;

    /**
     * 
     * @param array<string> $to email address to send to
     * @param string $subject title to email
     * @param string $html_body html body of email
     * @return bool true or false
     */
    public function sendEmail($from, $to = array(), $subject, $html_body) {
        require_once("PHPMailer/PHPMailerAutoload.php");
        $this->email = new PHPMailer();

        $this->SMTPDebug = 3;                               // Enable verbose debug output

        $this->email->isSMTP();                                      // Set mailer to use SMTP
        $this->email->Host = 'mailout.one.com';  // Specify main and backup SMTP servers
        $this->email->SMTPAuth = true;                               // Enable SMTP authentication
        $this->email->Username = 'contact@getitdonebrand.com';                 // SMTP username
        $this->email->Password = 'Marsvin123';                           // SMTP password
        $this->email->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $this->email->Port = 587;                                    // TCP port to connect to

        $this->email->setFrom('contact@getitdonebrand.com', 'Get It Done Brand');
        if (count($to) > 0) {
            for ($i = 0; $i < count($to); $i++) {
                $this->email->addAddress($to[$i]);     // Add a recipient
            }
        } else {
            echo "No recepients";
        }
        //$this->email->addAddress('joe@example.net', 'Joe User');     // Add a recipient
        //$this->email->addAddress('ellen@example.com');               // Name is optional
        //$this->email->addReplyTo('info@example.com', 'Information');
        //$this->email->addCC('cc@example.com');
        //$this->email->addBCC('bcc@example.com');

        $this->email->addAttachment($_SERVER['DOCUMENT_ROOT'] . '/web/images/Get it done logotyp small.png', 'getitdonebrand.png');         // Add attachments
        //$this->email->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $this->email->isHTML(true);                                  // Set email format to HTML

        $this->email->Subject = $subject;
        $this->email->Body = $html_body;
        $this->email->AltBody = strip_tags($html_body);

        if (!$this->email->send()) {
            return 'Message could not be sent. Mailer Error: ' . $this->email->ErrorInfo;
        } else {
            return true;
        }
    }

    public function emailHtml($title, $body, $from) {
        $var = '<!doctype html>
        <html>
          <head>
            <meta name="viewport" content="width=device-width" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Simple Transactional Email</title>
            <style>
              /* -------------------------------------
                  GLOBAL RESETS
              ------------------------------------- */
              img {
                border: none;
                -ms-interpolation-mode: bicubic;
                max-width: 100%; }
              body {
                background-color: #f6f6f6;
                font-family: sans-serif;
                -webkit-font-smoothing: antialiased;
                font-size: 14px;
                line-height: 1.4;
                margin: 0;
                padding: 0; 
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%; }
              table {
                border-collapse: separate;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
                width: 100%; }
                table td {
                  font-family: sans-serif;
                  font-size: 14px;
                  vertical-align: top; }
              /* -------------------------------------
                  BODY & CONTAINER
              ------------------------------------- */
              .body {
                background-color: #f6f6f6;
                width: 100%; }
              /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
              .container {
                display: block;
                Margin: 0 auto !important;
                /* makes it centered */
                max-width: 580px;
                padding: 10px;
                width: auto !important;
                width: 580px; }
              /* This should also be a block element, so that it will fill 100% of the .container */
              .content {
                box-sizing: border-box;
                display: block;
                Margin: 0 auto;
                max-width: 580px;
                padding: 10px; }
              /* -------------------------------------
                  HEADER, FOOTER, MAIN
              ------------------------------------- */
              .main {
                background: #fff;
                border-radius: 3px;
                width: 100%; }
              .wrapper {
                box-sizing: border-box;
                padding: 20px; }
              .footer {
                clear: both;
                padding-top: 10px;
                text-align: center;
                width: 100%; }
                .footer td,
                .footer p,
                .footer span,
                .footer a {
                  color: #999999;
                  font-size: 12px;
                  text-align: center; }
              /* -------------------------------------
                  TYPOGRAPHY
              ------------------------------------- */
              h1,
              h2,
              h3,
              h4 {
                color: #000000;
                font-family: sans-serif;
                font-weight: 400;
                line-height: 1.4;
                margin: 0;
                Margin-bottom: 30px; }
              h1 {
                font-size: 35px;
                font-weight: 300;
                text-align: center;
                text-transform: capitalize; }
              p,
              ul,
              ol {
                font-family: sans-serif;
                font-size: 14px;
                font-weight: normal;
                margin: 0;
                Margin-bottom: 15px; }
                p li,
                ul li,
                ol li {
                  list-style-position: inside;
                  margin-left: 5px; }
              a {
                color: #3498db;
                text-decoration: underline; }
              /* -------------------------------------
                  BUTTONS
              ------------------------------------- */
              .btn {
                box-sizing: border-box;
                width: 100%; }
                .btn > tbody > tr > td {
                  padding-bottom: 15px; }
                .btn table {
                  width: auto; }
                .btn table td {
                  background-color: #ffffff;
                  border-radius: 5px;
                  text-align: center; }
                .btn a {
                  background-color: #ffffff;
                  border: solid 1px #3498db;
                  border-radius: 5px;
                  box-sizing: border-box;
                  color: #3498db;
                  cursor: pointer;
                  display: inline-block;
                  font-size: 14px;
                  font-weight: bold;
                  margin: 0;
                  padding: 12px 25px;
                  text-decoration: none;
                  text-transform: capitalize; }
              .btn-primary table td {
                background-color: #3498db; }
              .btn-primary a {
                background-color: #3498db;
                border-color: #3498db;
                color: #ffffff; }
              /* -------------------------------------
                  OTHER STYLES THAT MIGHT BE USEFUL
              ------------------------------------- */
              .last {
                margin-bottom: 0; }
              .first {
                margin-top: 0; }
              .align-center {
                text-align: center; }
              .align-right {
                text-align: right; }
              .align-left {
                text-align: left; }
              .clear {
                clear: both; }
              .mt0 {
                margin-top: 0; }
              .mb0 {
                margin-bottom: 0; }
              .preheader {
                color: transparent;
                display: none;
                height: 0;
                max-height: 0;
                max-width: 0;
                opacity: 0;
                overflow: hidden;
                mso-hide: all;
                visibility: hidden;
                width: 0; }
              .powered-by a {
                text-decoration: none; }
              hr {
                border: 0;
                border-bottom: 1px solid #f6f6f6;
                Margin: 20px 0; }
              /* -------------------------------------
                  RESPONSIVE AND MOBILE FRIENDLY STYLES
              ------------------------------------- */
              @media only screen and (max-width: 620px) {
                table[class=body] h1 {
                  font-size: 28px !important;
                  margin-bottom: 10px !important; }
                table[class=body] p,
                table[class=body] ul,
                table[class=body] ol,
                table[class=body] td,
                table[class=body] span,
                table[class=body] a {
                  font-size: 16px !important; }
                table[class=body] .wrapper,
                table[class=body] .article {
                  padding: 10px !important; }
                table[class=body] .content {
                  padding: 0 !important; }
                table[class=body] .container {
                  padding: 0 !important;
                  width: 100% !important; }
                table[class=body] .main {
                  border-left-width: 0 !important;
                  border-radius: 0 !important;
                  border-right-width: 0 !important; }
                table[class=body] .btn table {
                  width: 100% !important; }
                table[class=body] .btn a {
                  width: 100% !important; }
                table[class=body] .img-responsive {
                  height: auto !important;
                  max-width: 100% !important;
                  width: auto !important; }}
              /* -------------------------------------
                  PRESERVE THESE STYLES IN THE HEAD
              ------------------------------------- */
              @media all {
                .ExternalClass {
                  width: 100%; }
                .ExternalClass,
                .ExternalClass p,
                .ExternalClass span,
                .ExternalClass font,
                .ExternalClass td,
                .ExternalClass div {
                  line-height: 100%; }
                .apple-link a {
                  color: inherit !important;
                  font-family: inherit !important;
                  font-size: inherit !important;
                  font-weight: inherit !important;
                  line-height: inherit !important;
                  text-decoration: none !important; } 
                .btn-primary table td:hover {
                  background-color: #34495e !important; }
                .btn-primary a:hover {
                  background-color: #34495e !important;
                  border-color: #34495e !important; } }
            </style>
          </head>
          <body class="">
            <table border="0" cellpadding="0" cellspacing="0" class="body">
              <tr>
                <td>&nbsp;</td>
                <td class="container">
                  <div class="content">

                    <!-- START CENTERED WHITE CONTAINER -->
                    <span class="preheader">'.$title.'</span>
                    <table class="main">

                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                        <td class="wrapper">
                          <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>
                                <p>Skickat av '.$from.',</p>
                                <p>'.$body.'</p>
                                <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                  <tbody>
                                    <tr>
                                      <td align="left">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                          <tbody>
                                            <tr>
                                              <td> <a href="mailto:'.$from.'" target="_blank">Svara kunden nu</a> </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                                <!--<p>Text</p>-->
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>

                      <!-- END MAIN CONTENT AREA -->
                      </table>

                    <!-- START FOOTER -->
                    <div class="footer">
                      <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="content-block">
                            <span class="apple-link">GetItDoneBrand, Stockholm</span>
                            <br> <!--Dont like these emails? <a href="http://i.imgur.com/CScmqnj.gif">Unsubscribe</a>.-->
                          </td>
                        </tr>
                        <tr>
                          <td class="content-block powered-by">
                            <!--Powered by <a href="http://htmlemail.io">HTMLemail</a>.-->
                          </td>
                        </tr>
                      </table>
                    </div>

                    <!-- END FOOTER -->

        <!-- END CENTERED WHITE CONTAINER --></div>
                </td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </body>
        </html>';
        return $var;
    }

}
