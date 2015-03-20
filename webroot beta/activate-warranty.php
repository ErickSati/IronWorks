<?php
	// Require the form validation logic file
	require_once( dirname(__FILE__) . "/form-validation.inc" );
	
	// Initializations
	$html = array("industry" => array());
	$errors = array();
	
	if ( isset($_POST["submit-warranty"]) )
	{
		// Form validation
		// ----------------------------
		if ( "" == trim($_POST["name"]) )
		{
			$errors["name"] = "Please enter a name.";
		}
		
		if ( "" == trim($_POST["street"]) )
		{
			$errors["street"] = "Please enter a street.";
		}
		
		if ( "" == trim($_POST["city"]) )
		{
			$errors["city"] = "Please enter a city.";
		}
		
		if ( "" == trim($_POST["state"]) )
		{
			$errors["state"] = "Please enter a state.";
		}
		
		if ( "" == trim($_POST["zip"]) )
		{
			$errors["zip"] = "Please enter a zip code.";
		}
		
		if ( FIELD_INVALID == valid_text($_POST["phone"], FIELD_REQUIRED, "+-() ") ) // <== NOTE the last parameter is a list of valid special characters, in addition to letters and numbers
		{
			$errors["phone"] = "Please enter a valid phone number.";
		}
		
		if ( FIELD_INVALID == valid_text($_POST["fax"], FIELD_OPTIONAL, "+-() ") ) // <== NOTE the optional parameter ... the fax may be blank, but if given it must be valid
		{
			$errors["fax"] = "Please enter a valid fax number.";
		}
		
		if ( FIELD_INVALID == valid_email($_POST["email"], FIELD_REQUIRED) )
		{
			$errors["email"] = "Please enter a valid email.";
		}
		
		if ( "" == trim($_POST["purchase"]) )
		{
			$errors["purchase"] = "Please enter a purchase date.";
		}
		else
		{
			$pieces = explode("/", str_replace("-", "/", $_POST["purchase"]));
			if ( true !== checkdate( intval($pieces[0]), intval($pieces[1]), intval($pieces[2]) ) )
			{
				$errors["purchase"] = "Please enter a valid purchase date.";
			}
		}
		
		if ( "" == trim($_POST["dealer"]) )
		{
			$errors["dealer"] = "Please enter a dealer.";
		}
		
		if ( "" == trim($_POST["model"]) )
		{
			$errors["model"] = "Please enter a model.";
		}
		
		if ( "" == trim($_POST["serial"]) )
		{
			$errors["serial"] = "Please enter a serial number.";
		}
		
		if ( "" == trim($_POST["refer"]) )
		{
			$errors["refer"] = "Please select how you heard about Edwards.";
		}
		else
		{
			if ( "Other" == $_POST["refer"]  && "" == trim($_POST["other"]) )
			{
				$errors["other"] = "Please describe how you heard about Edwards (required if Other is chosen).";
			}
		}
		
		if ( "" == trim($_POST["experience"]) )
		{
			$errors["experience"] = "Please select which option best matches your dealer experience.";
		}
		
		if ( false == isset($_POST["industry"]) )
		{
			$errors["industry"] = "Please select at least one applicable industry.";
			$_POST["industry"] = array();
		}
		
		if ( "" == trim($_POST["promos"]) )
		{
			$errors["promos"] = "Please select whether or not you want to be notified of promotions.";
		}
		// ----------------------------
		
		if ( count($errors) == 0 )
		{
			// Start email body HTML text with output buffering
			ob_start();
?>
   <table border="0" cellspacing="3" cellpadding="0" >
    <tr>
      <td align="left" valign="middle">
        <i><font face="Arial" size="2">Name:</font></i>
      </td>
      <td align="left">
        <?php echo htmlentities(trim($_POST["name"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
    <tr>
      <td align="left" valign="left">
        <i><font face="Arial" size="2">Street:</font></i>
      </td>
      <td align="left">
        <?php echo htmlentities(trim($_POST["street"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
    <tr>
      <td align="left" valign="left">
        <i><font face="Arial" size="2">City:</font></i>
      </td>
      <td align="left">
        <?php echo htmlentities(trim($_POST["city"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
    <tr>
      <td align="left" valign="left">
        <i><font face="Arial" size="2">State:</font></i>
      </td>
      <td align="left">
        <?php echo htmlentities(trim($_POST["state"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
    <tr>
      <td align="left" valign="left">
        <i><font face="Arial" size="2">Zip:</font></i>
      </td>
      <td align="left">
        <?php echo htmlentities(trim($_POST["zip"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
    <tr>
      <td align="left" valign="middle">
        <i><font face="Arial" size="2">Phone:</font></i>
      </td>
      <td align="left">
        <?php echo htmlentities(trim($_POST["phone"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
      </tr>
    <tr>
      <td align="left" valign="middle">
        <i><font face="Arial" size="2">Fax:</font></i>
      </td>
      <td align="left">
        <?php echo htmlentities(trim($_POST["fax"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
      <tr>
         <td align="left" valign="middle">
           <i><font face="Arial" size="2">Email:</font></i>
         </td>
         <td align="left">
           <?php echo htmlentities(trim($_POST["email"]), ENT_COMPAT, "UTF-8"); ?>
         </td>
       </tr>
    <tr>
    <tr>
      <td align="left" valign="middle">
        <i><font face="Arial" size="2">Purchase Date:</font></i>
      </td>
      <td align="left">
        <?php echo htmlentities(trim($_POST["purchase"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
      <tr>
         <td align="left" valign="middle">
           <i><font face="Arial" size="2">Dealer:</font></i>
         </td>
         <td align="left">
           <?php echo htmlentities(trim($_POST["dealer"]), ENT_COMPAT, "UTF-8"); ?>
         </td>
       </tr>
    <tr>
      <td align="left" valign="middle">
        <i><font face="Arial" size="2">Model:</font></i>
      </td>
      <td align="left">
        <?php echo htmlentities(trim($_POST["model"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
    <tr>
      <td align="left" valign="middle">
        <i><font face="Arial" size="2">Serial Number:</font></i>
      </td>
      <td align="left">
        <?php echo htmlentities(trim($_POST["serial"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
    <tr>
      <td align="left" valign="middle">
        <i><font face="Arial" size="2">Referred Via:</font></i>
      </td>
      <td align="left">
        <?php echo htmlentities(trim($_POST["refer"]), ENT_COMPAT, "UTF-8"); if ( strtolower($_POST["refer"]) == "other" ) { ?> 
        <div><?php print $_POST["other"]; ?></div>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td align="left" valign="middle">
        <i><font face="Arial" size="2">Dealer Experience:</font></i>
      </td>
      <td align="left">
        <?php echo htmlentities(trim($_POST["experience"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
    <tr>
       <td align="left" valign="middle">
         <i><font face="Arial" size="2">Applicable Industries:</font></i>
       </td>
       <td align="left"><?php echo htmlentities(trim(join(", ", $_POST["industry"])), ENT_COMPAT, "UTF-8"); ?></td>
     </tr>
    <tr>
      <td align="left" valign="middle">
        <i><font face="Arial" size="2">Notify of Promotions/Specials:</font></i>
      </td>
      <td align="left">
        <?php echo htmlentities(trim($_POST["promos"]), ENT_COMPAT, "UTF-8"); ?>
      </td>
    </tr>
    </table>
<?
			$body = ob_get_contents();
			ob_end_clean();
			
			// Send email and redirect to the thank you page
			mail("sales@edwardsmfg.us", "Warranty Activation from Edwards MFG", $body, 'From: website@edwardsironworkers.com'."\r\n".'Content-Type: text/html; charset="us-ascii"');
			header("Location: /thankyou.html");
			exit();
		}
		else
		{
			$html = array_merge($_POST, $html);
			$html["industry"] = array_merge($_POST["industry"], $html["industry"]);
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="description" content = "Edwards Manufacturing has been a family-owned business since 1875.  It is one of the premiere manufacturers of Ironworkers, tooling and hydraulic accessories.">
  <meta name="keywords" content = "Edwards Manufacturing  Ironworkers innovative design robust construction tooling hydraulic accessories Strut Pro Tru-Chek Rain Gauge miaFurnishings indoor outdoor furniture Special Projects">
  <meta name="robots" content = "all, index, follow">

  <link rel="stylesheet" href="edwardsCSS.css"/>

  <!--    	===THIS PAGE IS BEING WRITTEN, FROM SCRATCH, TO NOT ONLY CREATE THE BASIC STRUCTURE OF A PAGE, BUT TO DOCUMENT THE PROCESS IT TOOK TO GET THERE  THE "DON MUSIC" PAGE CAN SERVE AS A TEMPLATE FOR PRODUCT PAGES ACROSS ALL EDWARDS SITES====	-->


  <!--		===so...EDWARDS WEB PAGE, REV. 0, 02/07/12	===	-->

  
  <title>Company Information | Edwards Manufacturing</title>
  
  <!--	===The Edwards favicon.  For each of Edwards' several business entities, a separate favicon "coin" will be created.  Each coin should be used with each separate website; i.e. the "mia" coin for miaFurnishings, etc.===		-->   
  
  <link rel="icon" type="image/gif" href="EDW_favicon1.gif" />
  <link rel="apple-touch-icon" href="EDW_apple.gif" />

  <!--	===Not working at the moment... Figure out later....===		-->

<!--===Related JavaScripts--> 
<script src="js/modernizr.custom.01620.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery.validate.min.js"></script>

<script src="js/tabbedPanel.js"></script>
<script src="js/nav1.1.min.js"></script>
<script src="js/navBar.js"></script>

  <!--	===GOOGLE ANALYTICS SCRIPT===		-->

<style type="text/css">
	.first-tab-warning {
		margin: 0.75em;
	}
	
	.error {
		color: #B6191F;
		font-weight: bold;
	}
	
	.feedback {
		padding: 2px 0;
	}
	
	.required-asterisk {
		color: #B6191F;
		font-weight: bold;
	}
	
	.format-hint {
		color: #666666;
	}
</style>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-40088675-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body>

<header role="banner" class="mast">

<div id="masthead" itemscope itemtype="http://schema.org/LocalBusiness">
  <div id="icon">
    <a href="index.html"><img src = "images/png/EDW_coinLogo.png" id="navImg" itemprop="logo" alt="Edwards Coin Logo" title="Home"></a>
  </div>

  <div id="social">

      <a href="http://www.youtube.com/user/EdwardsMfgCo" target="_blank"><img src = "images/png/yt-brand-standard-logo_47x20.png" class="youTubeImg" alt="YouTube button" title="Check out Edwards Manufacturing on YouTube!"></a>

      <a href="https://twitter.com/#!/EdwardsMfgCo" target="_blank"><img src = "images/png/twitterButtonArt.png" class="socImg" alt="Twitter button" title="Follow @EdwardsMfgCo on Twitter!"></a>

      <a href="https://www.facebook.com/pages/Edwards-Manufacturing-Company/423455224336993" target="_blank"><img src = "images/png/facebookButtonArt.png" class="socImg" alt="Facebook button" title="Follow Edwards on Facebook!"></a>

      <p class="contact"><a href="promotional.html">PROMOTIONAL PARTNERS</a> | <a href="edwContact.html">CONTACT US</a></p>
 
  </div>

</div>

</header>

<div id="enclosure">

<!--		==IN TERMS OF NAVIGATION, THE HEADER - THE SOLID-COLOR BAR - IS TO BE USED FOR PRODUCT-CENTRIC NAVIGATION ON EDWARDS SITES.===		-->

<header id="navBar" role="banner">
  <nav role="navigation">
<ul id="nav" >
	<li><a href="ironworkerHome.html">IRONWORKERS</a>
	  <ul>
	    <li><a href="eliteIronworkers.html">ELITE</a>
	      <ul>
		<li><a href="elite68.html">ELITE 68</a></li>
		<li><a href="elite110.html">ELITE 110</a></li>
		<li><a href="elite110-65.html">ELITE 110|65</a></li>
 	      </ul>
	    </li>
	    <li><a href="jawsIronworkers.html">JAWS</a>
	      <ul>
		<li><a href="25tonIronworker.html">25 TON</a></li>

		<li><a href="40tonIronworker.html">40 TON</a></li>
		<li><a href="50tonIronworker.html">50 TON</a></li>
		<li><a href="55tonIronworker.html">55 TON</a></li>
		<li><a href="60tonIronworker.html">60 TON</a></li>
		<li><a href="65tonIronworker.html">65 TON</a></li>
		<li><a href="75tonIronworker.html">75 TON</a></li>
		<li><a href="100tonIronworker.html">100 TON</a></li>
		<li><a href="100tonDIronworker.html">100 TON DELUXE</a></li>
		<li><a href="120tonIronworker.html">120 TON</a></li>
 	      </ul>
	    </li>
	    <li><a href="features.html">FEATURES</a>
	      <ul>
		<li><a href="punch.html">PUNCH</a></li>
		<li><a href="barShear.html">FLAT BAR SHEAR</a></li>
		<li><a href="angleShear.html">ANGLE SHEAR</a></li>
		<li><a href="coperNotcher.html">COPER NOTCHER</a></li>
 	      </ul>
	    </li>
	    <li><a href="demoUnits.html">DEMO UNITS</a></li>
	  </ul>
	</li>
	<li><a href="hydraulicAccessoryHome.html">HYDRAULIC ACCESSORIES</a>
	  <ul>
	    <li><a href="shopPress.html">SHOP PRESSES</a>
	      <ul>
		<li><a href="20tonShopPress.html">20 TON</a></li>
		<li><a href="40tonShopPress.html">40 TON</a></li>
 	      </ul>
	    </li>
	    <li><a href="10T_tubePipeBender.html">10 TON BENDER</a>
	    <li><a href="hydAccTooling.html">TOOLING</a>
	      <ul>
		<li><a href="pressBrakeTooling.html">PRESS BRAKE TOOLING</a></li>
		<li><a href="6pcPressTooling.html">6 PIECE PRESS TOOLING</a></li>
		<li><a href="tubePipeBenderDies.html">TUBE/PIPE BENDER DIES</a></li>
		<li><a href="bendTech.html">BEND-TECH</a></li>
	      </ul>
	    </li>
	    <li><a href="hydAccPower.html">POWER OPTIONS</a></li>
	  </ul>
	</li>
	<li><a href="toolingAccHome.html">TOOLING ACCESSORIES</a>
	  <ul>
	    <li><a href="punchAcc.html">PUNCH</a>
	      <ul>
  		<li><a href="punchDieStarter.html">PUNCH/DIE STARTER SET</a></li>
		<li><a href="gaugingTableKit.html">GAUGING TABLE KIT</a></li>
	    	<li><a href="hvyGaugingTableKit.html">HEAVY GAUGING TABLE KIT</a></li>
		<li><a href="stripperRedPlate.html">STRIPPER PLATE</a></li>
		<li><a href="urethaneStripper.html">URETHANE STRIPPER</a></li>
		<li><a href="pedestalDieTable.html">PEDESTAL DIE TABLE</a></li>
		<li><a href="oversizePunch.html">OVERSIZE PUNCH</a></li>
	    	<li><a href="241punch.html">241 PUNCH</a></li>
	      </ul>
	    </li>
	    <li><a href="notcherAcc.html">NOTCH</a>
	      <ul>
		<li><a href="angleNotcher.html">ANGLE NOTCHER</a></li>
		<li><a href="optCoperNotcher.html">COPER NOTCHER</a></li>
	    	<li><a href="pipeNotcher.html">PIPE NOTCHER</a></li>
		<li><a href="turretPipeNotch.html">TURRET PIPE NOTCHER</a></li>
	      </ul>
	    </li>
	    
	    <li><a href="shearAcc.html">SHEAR</a>
	      <ul>
	    	<li><a href="multiShear.html">MULTI SHEAR</a></li>
		<li><a href="rodShearHousing.html">ROD SHEAR HOUSING</a></li>
		
	      </ul>
	    </li>
	    <li><a href="brakeTooling.html">BRAKE</a></li>
	    <li><a href="measurementAcc.html">MEASUREMENT</a>
	      <ul>
		<li><a href="48inAutoCut.html">48" AUTO CUT</a></li>
		<li><a href="48inBackGauge.html">48" BACK GAUGE</a></li>
		<li><a href="fabProtractor.html">FAB. PROTRACTOR</a></li>
		<li><a href="pressBrakeBackGauge.html">PRESS BRAKE BA. GAUGE</a></li>
	      </ul>
	    </li>
	    <li><a href="accessoryLight.html">ACCESSORY LIGHT</a></li>
	  </ul>
	</li>
        <li><a href="companyInfo.html">COMPANY INFO</a></li>
    </ul>
  </nav>
</header>

<!--		==THE GREAT MAJORITY OF EDWARDS' SITE PAGES WILL BE PRODUCT INFORMATION.  THE MAJOR (H2) HEADLINE OF THE PRODUCT SECTION IS THE PRODUCT NAME, FOLLOWED BY THE PRICE, FOLLOWED BY AN OH-SO-CLEVER TAGLINE(i.e. "THE WORKHORSE" or "THE SHOP STANDARD."  THAT APPEARS IN THE MAIN SECTION===		-->

<!--		==3/26/12... An experiment in organizing information.  What I want to do is organize the information in tabbed panels.  03/27/12... the experiment has largely been successful; the interface looks good, except for dummy text and lack of video.  But layout looks good.===		-->

<section class= "product">

  
<h1 class="coHead">COMPANY INFORMATION</h1>
<div id="emptyAbout"></div>


<div class = "tabbedPanels">
  <ul class = "tabs">
    <li><a href="#panel1" tabindex="1"<?php if ( isset($_POST) && count($errors) > 0 ) { ?> class=""<?php } ?>>About Edwards</a></li>
    <li><a href="#panel2" tabindex="2">Product Warranty</a></li>
    <li><a href="#panel3" tabindex="3"<?php if ( isset($_POST) && count($errors) > 0 ) { ?> class="active"<?php } ?>>Warranty Registration</a></li>
    <li><a href="#panel4" tabindex="4">Privacy Policy</a></li>
  </ul>

<div class="panelContainer">

<!--		==COMPANY NARRATIVE===		-->

<div id="panel1" class="panel">

<?php
	if ( isset($_POST) && count($errors) > 0 )
	{
?>
<div class="feedback error first-tab-warning">IMPORTANT! You did not complete your warranty form and it has not been submitted. <br />Please click the &quot;Warranty Registration&quot; tab and correct your entries.</div>
<br />
<?php
	}
?>
  
  <div class="narrativeFrame">
    <div class="narrativeSlide">

	<!--	==6/29/12 FOR THE CORRECT PROPORTIONS OF THE PANEL & RELATIONSHIP BETWEEN PICTURE, TEXT, VIDEO AND RELATED PRODUCT SLIDE ET AL, THE WIDTH OF THE DIV, AND HENCE THE IMAGE IS 490px (30.625em).==	-->

	<img src="images/jpg/factoryImg.jpg" class="prodImg" width="490" height="326" alt="Training">

<hr class="pwrRule" />

<p class="coAddress" itemscope itemtype="http://schema.org/LocalBusiness"> <span itemprop = "name"><strong>Edwards Manufacturing Company</strong></span><br/>
    <span itemprop="address">1107 Sykes St.<br/>
    Albert Lea MN 56007</span><br/>
    <span itemprop="telephone"><strong>Phone:</strong> (800) 373-8206</span><br/>
    <span itemprop="faxNumber"><strong>Fax:</strong> (507) 373-9433</span><br/>

</p>

  <div class="contactTable" itemscope itemtype="http://schema.org/LocalBusiness">
  <table class="brakeSpecs">
    <tr>
    <td class="contactType">Machine Sales</td>
    <td class="contactData"><a href="mailto:kevin@edwardsmfg.us"> <span itemprop="email">Kevin@edwardsmfg.us</span></a></td>
    </tr>
    <tr>
    <td class="contactType">Service and Parts</td>
    <td class="contactData"><a href="mailto:danny@edwardsmfg.us"> <span itemprop="email">Danny@edwardsmfg.us</span></a></td>
    </tr>
    <tr>
    <td class="contactType">Dealer Support</td>
    <td class="contactData"><a href="mailto:jordan@edwardsmfg.us"> <span itemprop="email">Jordan@edwardsmfg.us</span></a></td>
    </tr>
    <tr>
    <td class="contactType">General Information</td>
    <td class="contactData"><a href="mailto:karen@edwardsmfg.us"> <span itemprop="email">Karen@edwardsmfg.us</span></a></td>
    </tr>

  </table>
  </div>
    </div>
  </div>
  
<div class="narrative" itemscope itemtype="http://schema.org/LocalBusiness">

<!--	==A PRODUCT DESCRIPTION OF 150 WORDS MAX.  150 WORDS SHOULD PROVIDE A CONCISE DESCRIPTION OF THE PARTICULAR PRODUCT BEING VIEWED.  150 WORDS ALSO WORKS WITH THE CSS TO CREATE A RELATIVE BALANCE BETWEEN THE TEXT AND THE IMAGE.==	-->


<p class="prodNoTag" itemprop="description"><span itemprop="name">Edwards Manufacturing</span> is a family-owned business that has been producing a variety of products since <span itemprop="foundingDate">1875</span>. What began with the manufacture of farm implements, plows and culverts has evolved into one of the premiere manufacturers of ironworking machines, tooling and hydraulic accessory tools in the world.<br>
<br>
Today Edwards Manufacturing is primarily driven by its production of <a href="ironworkerHome.html">Ironworkers</a>. The standard line of Edwards Ironworkers has recently been expanded with the addition of the new Edwards ELITE line. Edwards ELITE Ironworkers boast high-quality design and a host of integrated features. Both lines of Ironworkers are bolstered by our extensive line of <a href="toolingAccHome.html">Tooling Accessories</a>, giving the user the ability to tailor their Ironworker to their specific needs. The Ironworker line is further complemented by a line of innovative <a href="hydraulicAccessoryHome.html">Hydraulic Accessory Tools</a>, powered by an Edwards Ironworker or the Edwards Porta Power, a portable hydraulic power unit. Quickly, easily and economically these tools greatly expand the fabrication capabilities.<br>
<br>
Edwards Manufacturing designs and manufactures more than Ironworkers. The <a href="http://www.edwardsstrutpro.com/" target="_blank">Edwards Strut Pro</a> is an innovative hydraulic tool for cutting commonly branded strut products. The <a href="http://www.tru-chekraingauge.com/" target="_blank">Tru-Chek Rain Gauge</a> is an extremely accurate, heavy-duty rain gauge ideal for a wide range of users. With <a href="http://www.miafurnishings.com/" target="_blank">miaFurnishings</a> Edwards is combining manufacturing capability with design creativity to create beautiful indoor and outdoor furniture for commercial and residential clients. Finally, the <a href="specialProjects.html">Special Projects</a> division of Edwards Manufacturing utilizes the capability of our factory, the quality of our workers and the ingenuity of our designers to offer design consultation and fabricate singular design solutions.
</p>





</div>

</div>


<!--		==WARRANTY===		-->

<div id="panel2" class="panel">

  <div class="narrativeFrame">
    <div class="narrativeSlide">

	<!--	==6/29/12 FOR THE CORRECT PROPORTIONS OF THE PANEL & RELATIONSHIP BETWEEN PICTURE, TEXT, VIDEO AND RELATED PRODUCT SLIDE ET AL, THE WIDTH OF THE DIV, AND HENCE THE IMAGE IS 490px (30.625em).==	-->

	<img src="images/jpg/training.jpg" class="prodImg" width="490" height="490" alt="Training">
    </div>
  </div>
  
<div class="narrative" itemscope itemtype="http://schema.org/LocalBusiness">

<!--	==A PRODUCT DESCRIPTION OF 150 WORDS MAX.  150 WORDS SHOULD PROVIDE A CONCISE DESCRIPTION OF THE PARTICULAR PRODUCT BEING VIEWED.  150 WORDS ALSO WORKS WITH THE CSS TO CREATE A RELATIVE BALANCE BETWEEN THE TEXT AND THE IMAGE.==	-->


<p class="prodNoTag" itemprop="description"><span itemprop="name">Edwards Manufacturing</span> Company will, within one (1) year of date of original purchase (proof of purchase required), replace F.O.B. the factory, any goods, excluding punches, dies and shear blades, which are defective in materials or workmanship provided that the buyer return the defective goods, freight pre-paid, to the seller, which shall be the buyer's sole and exclusive remedy for the defective goods. Hydraulic components are subject to their manufacturer's warranty.<br>
<br>
Edwards Manufacturing Company will, within thirty (30) days of date of original purchase (proof of purchase required), replace F.O.B. the factory, any punches, dies and/or shear blades, which are defective in materials or workmanship.<br>
<br>
This warranty does not apply to machines and/or components which have been altered, changed or modified in any way, or subjected to abusive and abnormal use, inadequate maintenance and lubrication, or subjected to use beyond seller recommended capacities and specifications. Edwards Manufacturing Company shall not be liable for labor costs expended on such goods or consequential damages. Edwards Manufacturing Company shall not be liable to the purchaser or any other person for loss, down-time, or damage directly or indirectly arising from the use of the goods or from any other cause. No officer, employee, or agent of Edwards Manufacturing Company is authorized to make any oral representations or warranty of fitness or to waive any of the foregoing terms and none shall be binding on Edwards Manufacturing Company.</p>


</div>

</div>

<!--		==WARRANTY REGISTRATION===		-->

<div id="panel3" class="panel">
  
<div class="warrantyReg">

<form name = "warranty" method = "post" action= "activate-warranty.php" id="warranty">

<fieldset class="registration">
<?php
	if ( count($errors) > 0 )
	{
		foreach ($errors as $item)
		{
?>
<div class="feedback error"><?php print $item; ?></div>
<?php
		}
?>
<br />
<?php
	}
?>
<p class="warrantyReg"><strong><em>IMPORTANT:</em></strong> Please fill out and return within 10 days of receipt of equipment to activate machinery warranty.
The following information will assist us in servicing you and your equipment effectively.</p>
	
<!--test driving the table -->

<table>

<tr><td colspan="4" align="center">Entries with a red asterisk ( <span class="required-asterisk">*</span> ) are required.</td></tr>

<tr>
<td><label for= "name"> Name <span class="required-asterisk">*</span></label></td>
<td><input type = "text" name = "name" id = "name" class="required" value="<?php print $html["name"]; ?>" /></td>
<td><label for= "street">Street Address <span class="required-asterisk">*</span></label></td>
<td><input type = "text" name = "street" id = "street" class="required" value="<?php print $html["street"]; ?>" /></td>
</tr>

<tr>
<td><label for= "city"> City <span class="required-asterisk">*</span></label></td>
<td><input type = "text" name = "city" id = "city" class="required" value="<?php print $html["city"]; ?>" /></td>
<td><label for= "state"> State|Province <span class="required-asterisk">*</span></label></td>
<td><input type = "text" name = "state" id = "state" class="required" value="<?php print $html["state"]; ?>" /></td>
</tr>

<tr>
<td><label for= "zip">ZIP|Postal Code <span class="required-asterisk">*</span></label></td>
<td><input type = "text" name = "zip" id = "zip" class="required" value="<?php print $html["zip"]; ?>" /></td>
<td><label for= "phone">Phone <span class="required-asterisk">*</span> <span class="format-hint">(xxx-xxx-xxxx)</span></label></td>
<td><input type = "text" name = "phone" id = "phone" class="required" value="<?php print $html["phone"]; ?>" /></td>
</tr>

<tr>
<td><label for= "fax">Fax <span class="format-hint">(xxx-xxx-xxxx)</span></label></td>
<td><input type = "text" name = "fax" id = "fax" value="<?php print $html["fax"]; ?>" /></td>
<td><label for= "email">Email <span class="required-asterisk">*</span></label></td>
<td><input type = "text" name = "email" id = "email" value="<?php print $html["email"]; ?>" /></td>
</tr>

<tr>
<td><label for= "purchase">Date of Purchase or Receipt <span class="required-asterisk">*</span></label></td>
<td><input type = "text" name = "purchase" id = "purchase" class="required" placeholder="month/day/year" value="<?php print $html["purchase"]; ?>" /></td>
<td><label for= "dealer">Purchased From <span class="required-asterisk">*</span></label></td>
<td><input type = "text" name = "dealer" id = "dealer" class="required" placeholder="Dealer Name" value="<?php print $html["dealer"]; ?>" /></td>
</tr>

</table>

</fieldset>

<fieldset class="modelNum">
	
<!--test driving the table -->

<table>

<tr>
<td><label for= "model" >Model <span class="required-asterisk">*</span></label></td>
<td><input type = "text" name = "model" id = "model" class="required" value="<?php print $html["model"]; ?>" /></td>
<td><label for= "serial" >Serial Number <span class="required-asterisk">*</span></label></td>
<td><input type = "text" name = "serial" id = "serial" class="required" value="<?php print $html["serial"]; ?>"></td>
</tr>

</table>

</fieldset>

<fieldset class="registration">


<!-- select box for tracking how users find out about Edwards... -->

<label class="selLabel" for="refer">How did hear about Edwards? <span class="required-asterisk">*</span></label>
<select id="refer" name="refer">
  <option value="Dealer"<?php if ( "Dealer" == $html["refer"] ) { ?> selected="selected"<?php } ?>>Dealer</option>
  <option value="Trade Show"<?php if ( "Trade Show" == $html["refer"] ) { ?> selected="selected"<?php } ?>>Trade Show</option>
  <option value="Web"<?php if ( "Web" == $html["refer"] ) { ?> selected="selected"<?php } ?>>Web Search</option>
  <option value="Trade"<?php if ( "Trade" == $html["refer"] ) { ?> selected="selected"<?php } ?>>Trade Publication</option>
  <option value="Owner"<?php if ( "Owner" == $html["refer"] ) { ?> selected="selected"<?php } ?>>Current Owner</option>
  <option value="Referral"<?php if ( "Referral" == $html["refer"] ) { ?> selected="selected"<?php } ?>>Referral/Recommendation</option>
  <option value="TV"<?php if ( "TV" == $html["refer"] ) { ?> selected="selected"<?php } ?>>TV</option>
  <option value="Other"<?php if ( "Other" == $html["refer"] ) { ?> selected="selected"<?php } ?>>Other</option>
</select>

<br />

<!-- inquiry field -->
<div>If you chose "Other" above, please describe here - leave blank otherwise:</div>
<textarea name= "other" class="regLabelx" cols="60" rows="2"><?php print $html["other"]; ?></textarea>

<h3 class="contact">How was your experience with your dealer? <span class="required-asterisk">*</span></h3>

<label class="formLabel">
<input type= "radio" name= "experience" value= "Excellent" id= "experience_1"<?php if ( "Excellent" == $html["experience"] ) { ?> checked="checked"<?php } ?>>Excellent</label>

<label class="formLabel">
<input type= "radio" name= "experience" value= "Good" id= "experience_2"<?php if ( "Good" == $html["experience"] ) { ?> checked="checked"<?php } ?>>Good</label>

<label class="formLabel">
<input type= "radio" name= "experience" value= "Fair" id= "experience_3"<?php if ( "Fair" == $html["experience"] ) { ?> checked="checked"<?php } ?>>Fair</label>

<label class="formLabel">
<input type= "radio" name= "experience" value= "Poor" id= "experience_4"<?php if ( "Poor" == $html["experience"] ) { ?> checked="checked"<?php } ?>>Poor</label>

</fieldset>

<fieldset class="registration">

<h3 class="contact">What industry will your machinery serve? <span class="required-asterisk">*</span></h3>

<table class= "industry">

  <tr>
    <td class="industry"><label><input type= "checkbox" name= "industry[aerospace]" value= "Aerospace" id= "industry_1"<?php if ( in_array("Aerospace", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Aerospace</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[agriculture]" value= "Agriculture" id= "industry_2"<?php if ( in_array("Agriculture", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Agriculture</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[architectural]" value= "Architectural" id= "industry_3"<?php if ( in_array("Architectural", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Architectural</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[automotive]" value= "Automotive" id= "industry_4"<?php if ( in_array("Automotive", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Automotive</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[communications]" value= "Communications" id= "industry_5"<?php if ( in_array("Communications", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Communications</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[construction]" value= "Construction" id= "industry_6"<?php if ( in_array("Construction", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Construction</label></td>
  </tr>

  <tr>
    <td class="industry"><label><input type= "checkbox" name= "industry[educational]" value= "Educational" id= "industry_7"<?php if ( in_array("Educational", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Educational</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[engineering]" value= "Engineering" id= "industry_8"<?php if ( in_array("Engineering", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Engineering</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[food]" value= "Food Service" id= "industry_9"<?php if ( in_array("Food Service", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Food Service</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[garage]" value= "Garage Shop" id= "industry_10"<?php if ( in_array("Garage Shop", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Garage Shop</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[maintenance]" value= "Maintenance" id= "industry_11"<?php if ( in_array("Maintenance", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Maintenance</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[manufacturing]" value= "Manufacturing" id= "industry_12"<?php if ( in_array("Manufacturing", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Manufacturing</label></td>
  </tr>

  <tr>
    <td class="industry"><label><input type= "checkbox" name= "industry[maritime]" value= "Maritime" id= "industry_13"<?php if ( in_array("Maritime", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Maritime</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[mechanical]" value= "Mechanical" id= "industry_14"<?php if ( in_array("Mechanical", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Mechanical</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[mining]" value= "Mining" id= "industry_15"<?php if ( in_array("Mining", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Mining</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[ornamental]" value= "Ornamental" id= "industry_16"<?php if ( in_array("Ornamental", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Ornamental</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[plumbing]" value= "Plumbing" id= "industry_17"<?php if ( in_array("Plumbing", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Plumbing</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[prototyping]" value= "Prototyping" id= "industry_18"<?php if ( in_array("Prototyping", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Prototyping</label></td>
  </tr>

  <tr>
    <td class="industry"><label><input type= "checkbox" name= "industry[recycling]" value= "Recycling" id= "industry_19"<?php if ( in_array("Recycling", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Recycling</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[structural]" value= "Structural" id= "industry_20"<?php if ( in_array("Structural", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Structural</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[transportation]" value= "Transportation" id= "industry_21"<?php if ( in_array("Transportation", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Transportation</label></td>
    <td class="industry"><label><input type= "checkbox" name= "industry[utilities]" value= "Utilities" id= "industry_22"<?php if ( in_array("Utilities", $html["industry"]) ) { ?> checked="checked"<?php } ?> />Utilities</label></td>
    <td class="industry">&nbsp;</td>
    <td class="industry">&nbsp;</td>
  </tr>

</table>

<h3 class="contact">Would you like to be advised to current promotions and dealer specials? <span class="required-asterisk">*</span></h3>

<label class="formLabel">
<input type= "radio" name= "promos" value= "Yes" id= "yes"<?php if ( "Yes" == $html["promos"] ) { ?> checked="checked"<?php } ?>>Yes</label>

<label class="formLabel">
<input type= "radio" name= "promos" value= "No" id= "no"<?php if ( "No" == $html["promos"] ) { ?> checked="checked"<?php } ?>>No</label>

</fieldset>

<p>
	<button type="submit" name="submit-warranty" class="button">
	<img src = "images/png/goButton.png" width="18" height="18" alt="go" /> Submit </button>

	<button type = "reset" name= "resetButton" class="button">
	<img src = "images/png/stopButton.png" width="18" height="18" alt="start over" /> Start Over </button>


</form>



</div>

</div>


<!--		==PRIVACY POLICY===		-->

<div id="panel4" class="panel">

  <div class="narrativeFrame">
    <div class="narrativeSlide">

	<!--	==6/29/12 FOR THE CORRECT PROPORTIONS OF THE PANEL & RELATIONSHIP BETWEEN PICTURE, TEXT, VIDEO AND RELATED PRODUCT SLIDE ET AL, THE WIDTH OF THE DIV, AND HENCE THE IMAGE IS 490px (30.625em).==	-->

	<img src="images/jpg/elite110_ds_2.jpg" class="prodImg" width="490" height="490" alt="Elite 110 Ironworker" title="Thank you for your interest in Edwards Ironworkers!">
    </div>
  </div>
  
<div class="narrative" itemscope itemtype="http://schema.org/LocalBusiness">

<!--	==A PRODUCT DESCRIPTION OF 150 WORDS MAX.  150 WORDS SHOULD PROVIDE A CONCISE DESCRIPTION OF THE PARTICULAR PRODUCT BEING VIEWED.  150 WORDS ALSO WORKS WITH THE CSS TO CREATE A RELATIVE BALANCE BETWEEN THE TEXT AND THE IMAGE.==	-->

<p class="prodNoTag">Edwards Manufacturing uses Google Analytics on <strong>edwardsironworkers.com</strong>, in order to analyze how users use our site.  Google Analytics is a piece of software that tracks visitor data via <em>first-party cookies</em> - small text files made up of anonymous text or numbers.  These tools do not collect Personally Identifiable Information (PII).  The information generated by the cookie will be transmitted to Google.  It may be used to generate statistical reports on website activity for Edwards Manufacturing.  This data will allow us to understand which pages on our website are receiving the most traffic, and it will guide future decisions about the design and content of our website.  Unless you submit a form via our Contact Page, no personal information will be collected.  All of this activity falls within the <a href="http://www.google.com/analytics/terms/us.html" target="_blank">Google Analytics Terms of Service</a>.<br>
<br>
Google Analytics records:</p>

<ul class="privacyList">

<li>What website you came from to get here.</li>
<li>How long you stay on edwardsironworkers.com.</li>
<li>Which pages are viewed the most.</li>
<li>What kind of computer/device you are using.</li>
<li>Your geographic location.</li>
</ul>

<br>
<p class="prodDesc">You can opt out of Google's advertising tracking cookie <a href="http://www.google.com/policies/technologies/ads/" target="_blank">here</a>, or you can install a browser plugin in order to opt out of all Google Analytics tracking software <a href="https://tools.google.com/dlpage/gaoptout?hl=en" target="_blank">here</a>.</p>


</div>

</div>

</div>

</div>


</section>




<!--		==IN TERMS OF NAVIGATION, THE FOOTER IS TO BE USED FOR COMPANY-CENTRIC (HISTORY, PHILOSOPHY, NEWS) NAVIGATION ON EDWARDS SITES.===		-->

<footer class="other">

<div id="compLinks">

<div class="coLinkImg">
<a href="http://www.specialproject.us/"  target="_blank"><img src="images/png/specialProjects.png" width="172" height="30" alt="Special Projects" id="specialLk" title="Special Projects"></a>
</div>

<div class="coLinkImg">
<a href="http://www.edwardsstrutpro.com/" target="_blank"><img src="images/png/EDWStrutPro_logo.png" width="82" height="40" alt="Edwards Strut Pro" id="espLk" title="Edwards Strut Pro"></a>
</div>

<div class="coLinkImg">
<a href="http://www.tru-chekraingauge.com/" target="_blank"><img src="images/gif/Tru-Chek_link.gif" width="111" height="40" alt="Tru-Chek Rain Gauge" id="truChkLk" title="Tru-Chek Rain Gauges"></a>
</div>

<div class="coLinkImg">
<a href="http://www.miafurnishings.com/" target="_blank"><img src="images/png/miaButtonW.png" width="227" height="30" alt="miaFurnishings" id="miaLk" title="miaFurnishings"></a>
</div>

</div>


<p class="copyright" itemscope itemtype="http://schema.org/LocalBusiness"> Copyright &copy; 2013 Edwards Manufacturing Company | All rights reserved<br/>
 <span itemprop="name">Edwards Manufacturing Company</span>   |   <span itemscope itemtype="http://schema.org/PostalAddress"><span itemprop="streetAddress">1107 Sykes St.</span> <span itemprop="addressLocality">Albert Lea</span> <span itemprop="addressRegion">MN 56007</span>   |   <span itemprop="telephone">phone: (507) 373-8206</span>   |   <span itemprop="telephone">toll free: (800) 373-8206</span>   |   <span itemprop="faxNumber">fax: (507) 373-9433</span></span></p>


</footer>

</div>


</body>

<!--	===PAGE CREATED FROM PREVIOUS 2/6/13===	-->
<!--	===INTERIM VALIDATION 2/8/13===	-->
<!--	===GOOGLE ANALYTICS CODE, FINAL VALIDATION 4/17/13===	-->

</html>