
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Dragonpay Payment Instruction</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="~/images/dragonpay-logo-tiny.jpg" />

<style type="text/css">
	
	body{background-image:url(images/bg.gif)}p,td,th,li{font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;color:#000}a:link{font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;color:#039;text-decoration:underline}h1{font-family:Arial,Helvetica,sans-serif;font-size:18px;color:#339;font-weight:400}h2{font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;font-weight:700;color:#06c;text-transform:uppercase}li{padding-top:3px;padding-bottom:3px}.text{font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;color:#000}.header{font-weight:700;text-align:center}.footer{font-family:Verdana,Arial,Helvetica,sans-serif;font-size:10px;color:#000;padding-left:10px}.footerLeft{font-family:Verdana,Arial,Helvetica,sans-serif;font-size:10px;color:#000;text-align:left;padding-top:10px;padding-bottom:5px;float:left}.footerRight{text-align:left;float:right}.dropdownList{width:300px}.footerlink{font-family:Verdana,Arial,Helvetica,sans-serif;font-size:10px;color:#039}.odd{background-color:#eff3fb}.even{background-color:#fff}.watermarked{color:Gray;font-style:italic}.workarea{background-color:White;border-color:Black;border-style:solid;border-width:1px;padding:10px;width:400px;height:320px;text-align:left;margin-top:50px}.banklogo{margin-top:20px;float:left;vertical-align:bottom}.dragonpaylogo{float:right;vertical-align:bottom}.depositSlipImage{border-style:dashed;width:100%}#EmailInstruction{width:750px;background-color:White;border:1px #000 solid;padding:10px;text-align:left}#EmailInstructionAmount{background-color:red;color:#fff;width:240px;text-align:center;float:right}#EmailInstructionDetails{border:0;width:500px}#ctl00_ContentPlaceHolder1_emailTextBox{width:300px}#ctl00_ContentPlaceHolder1_branchTextBox{width:200px}#ctl00_ContentPlaceHolder1_dateTextBox{width:80px}#ctl00_ContentPlaceHolder1_timeTextBox{width:70px}@media only screen and (max-width:480px),screen and (min-device-width:320px) and (max-device-width:480px){body{-webkit-text-size-adjust:none;font-family:Helvetica,Arial,Verdana,sans-serif;background-image:none;padding:2px}div{clear:both;display:block;width:100%;float:none}.text{font-size:12px}.dropdownList{width:280px}.workarea{border-style:none;width:100%;height:380px;padding:2px;text-align:left;margin-top:1px}.footerLeft{float:left}.footerRight{float:right}.banklogo{margin-top:10px;width:150px;height:40px}.dragonpaylogo{width:135px;height:60px}.depositSlipImage{border-style:none;width:100%}li{margin-top:3px;margin-bottom:3px}#EmailInstructionLogo{float:none;width:135px;height:60px}#EmailInstruction{width:100%;border:0;padding:4px;text-align:left}#EmailInstructionAmount{float:none}#EmailInstructionDetails{width:100%}#ctl00_ContentPlaceHolder1_emailTextBox{width:95%}#ctl00_ContentPlaceHolder1_branchTextBox{width:95%}#ctl00_ContentPlaceHolder1_dateTextBox{width:95%}#ctl00_ContentPlaceHolder1_timeTextBox{width:95%}}@media only screen and (min-device-width:768px) and (max-device-width:1024px) and (orientation:portrait)and (-webkit-min-device-pixel-ratio:1){.text{font-size:14px}#EmailInstruction{width:700px}}@media only screen and (min-device-width:320px) and (max-device-width:568px){}

</style>
</head>
<body>
<center>
<div id="EmailInstruction">
<p><img src="<?= base_url('assets/img/logo-2.png'); ?>" style="width:200px;" id='EmailInstructionLogo' /></p>
<h2>Payment Instructions</h2>
<p></p><div id="EmailInstructionAmount" style='background-color:orange'>Total Due<br /><span style="font-size:28px; font-weight:bold">PHP <?= number_format($amount); ?> </span><br />Status: PENDING<br /><div style='width:100%; background-color:white; padding-top:10px; padding-bottom:10px'></div></div>
<div style="float:left"><table id="EmailInstructionDetails">
<tr><td width="120px">Channel:</td><td><b>Paypanda Bogus Lhuillier</b></td></tr><tr><td width="120px">Reference No:</td><td><span style='font-weight:bold; font-family:"Courier New",Courier,"Lucida Sans Typewriter","Lucida Typewriter",monospace; font-size:18px'><?= $refno; ?></span></td></tr><tr><td width="120px">Biller:</td><td><b>PAYPANDA</b></td></tr><tr><td width="120px">Acct No/Subscriber:</td><td><b>0555024595</b></td></tr><tr><td width="120px">Amount:</td><td><b>PHP <?= number_format($amount); ?> <span style="color:red;">(note: a P25.00 service fee has been added to the original amount)</span></b></td></tr><tr><td width="120px">Description:</td><td><b>Payment for online store retail</b></td></tr><!-- <tr><td width="120px">Deadline:</td><td><span style='color:red; font-weight:bold'>Monday, July 2, 2018</span></td></tr> --></table></div><br clear=both />
<h1>Step 1: Pay</h1>
<ol>
<li>Deposit amount to Paypanda Bogus Bank (089886837889).</li></ol>
<h1>Step 2: Confirmation</h1>
<ol>
<li>Payments are processed at end of day.</li><li>We will send a confirmation email to you once processed. If you do not receive one by noon time of the next day, you may call us at (03)666-6810, email <a href="/cdn-cgi/l/email-protection#6a020f061a2a0e180b0d05041a0b13441a02"><span class="__cf_email__" data-cfemail="056d60697545617764626a6b75647c2b756d">[email&#160;protected]</span></a>, or <a href='https://help.paypanda.ph/chat/'>chat with our Customer Support</a>.
</ol>
<p><b><u>General Rules</u></b></p>
<ul>
<li>Pay the exact amount indicated above. Excess portion of your payment is forfeited. Payments less than the amount due will not be processed.</li>
<li>If you are paying for multiple Paypanda reference numbers, pay separately for each reference number. Do not lump them into a single transaction.</li>
<li>Make sure to get a reference number first before paying. A Dragonpay reference number can only be used once.</li>
<li>If you made a short payment by mistake, do not try to correct it by making another bills payment with the same reference no.
<li>Contact us immediately if you made a mistake in your payment.</li>
<li>For product-specific inquiries or questions regarding the status of your order, please contact the merchant directly.</li>
</ul>
<div>

<p><div style="font-size:x-small"><b><u>DISCLAIMER:</u></b> This payment will be processed by Paypanda, an independent third party payment processor. By using Paypanda, you agree to its <a href="https://www.paypanda.ph/terms-and-conditions">Terms and Conditions</a>. This payment page is intended for instructional purpose and should not be treated as a receipt of a completed payment.</div></p>
</div></center><script data-cfasync="false" src="/cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script></body></html>
