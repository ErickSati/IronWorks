<?
if (isset($_POST["Submit"]) ) {
   // send email
      ob_start();
?>
   <table border="0" cellspacing="3" cellpadding="0" >
    <tr>
      <td width="150" align="left" valign="middle">
        <i><font face="Arial" size="2">Name:</font></i>
      </td>
      <td width="200" align="left">
        <?php echo htmlentities(trim($_POST["Name"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
    <tr>
      <td width="150" align="left" valign="middle">
        <i><font face="Arial" size="2">Company:</font></i>
      </td>
      <td width="200" align="left">
        <?php echo htmlentities(trim($_POST["Company"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
    <tr>
      <td width="150" align="left" valign="left">
        <i><font face="Arial" size="2">Street:</font></i>
      </td>
      <td width="200" align="left">
        <?php echo htmlentities(trim($_POST["Street"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
    <tr>
      <td width="150" align="left" valign="left">
        <i><font face="Arial" size="2">City:</font></i>
      </td>
      <td width="200" align="left">
        <?php echo htmlentities(trim($_POST["City"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
    <tr>
      <td width="150" align="left" valign="left">
        <i><font face="Arial" size="2">State:</font></i>
      </td>
      <td width="200" align="left">
        <?php echo htmlentities(trim($_POST["State"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
    <tr>
      <td width="150" align="left" valign="left">
        <i><font face="Arial" size="2">Zip:</font></i>
      </td>
      <td width="200" align="left">
        <?php echo htmlentities(trim($_POST["Zip"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
    <tr>
      <td width="150" height="2" class="body1" align="left" valign="middle">
        <i><font face="Arial" size="2">Phone:</font></i>
      </td>
      <td width="200" align="left">
        <?php echo htmlentities(trim($_POST["Phone"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
      </tr>
      <tr>
         <td width="150" align="left" valign="middle" height="2">
           <i><font face="Arial" size="2">Email:</font></i>
         </td>
         <td width="200" align="left">
           <?php echo htmlentities(trim($_POST["Email"]), ENT_COMPAT, "UTF-8"); ?>
         </td>
       </tr>
      <tr>
         <td width="150" align="left" valign="middle" height="2">
           <i><font face="Arial" size="2">Contact About:</font></i>
         </td>
         <td width="200" align="left">
           <?php echo htmlentities(trim(implode(",", $_POST["contact"])), ENT_COMPAT, "UTF-8"); ?>
         </td>
       </tr>
      <tr>
         <td width="150" align="left" valign="middle" height="2">
           <i><font face="Arial" size="2">Contact Via:</font></i>
         </td>
         <td width="200" align="left">
           <?php echo htmlentities(trim($_POST["contacthow"]), ENT_COMPAT, "UTF-8"); ?>
         </td>
       </tr>
       <tr>
          <td width="150" align="left" valign="middle" height="2">
            <i><font face="Arial" size="2">Comments:</font></i>
          </td>
          <td width="200" align="left">
            <?php echo htmlentities(trim($_POST["comments"]), ENT_COMPAT, "UTF-8"); ?>
          </td>
       </tr>
      </table>
<?
   $body = ob_get_contents();
   ob_end_clean();

   //Customer Emails
   //mail("aaronf@intellisoftmn.com","Contact Request from Edwards MFG",$body,"From: website@edwardsironworkers.com\r\nContent-Type: text/html; charset=\"us-ascii\"");
   mail("charlesk@netgaintechnology.com","Contact Request from Edwards MFG",$body,"From: website@edwardsironworkers.com\r\nContent-Type: text/html; charset=\"us-ascii\"");
   mail("sales@edwardsmfg.us","Contact Request from Edwards MFG",$body,"From: website@edwardsironworkers.com\r\nContent-Type: text/html; charset=\"us-ascii\"");
   header("Location: /thankyou.html");
   exit();
} else {
   header("Location: /");
   exit();
}
?>