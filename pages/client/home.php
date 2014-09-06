<div id="header" class="header">
    <a name="id_home"></a>
        <div class="width titul">
            <div class="reg inline">
                <?php
					session_start();
					if(!isset($_SESSION['logged'])){?>
						<div class="bleft inline login"><a id="login-link" class="login-link pointerCursor" ng-click="showPop('#loginPopUp')"><i class="fa fa-sign-in"></i> Login</a></div>
						<div class="bleft bright inline login"><a id="reg-link" class="login-link pointerCursor" ng-click="showPop('#registerPopUp')"><i class="fa fa-plus"></i> Register</a></div>
					<?php }
					else{ ?>
						<div class="bleft inline login"><a id="login-link" class="login-link"><i class="fa fa-user"></i> Hi, <?php echo $_SESSION['loggedInUserName'];?></a></div>
						<div class="bleft bright inline login"><a href="server/authmodule/logout.php" id="reg-link" class="login-link"><i class="fa fa-sign-out"></i> Logout</a></div>
				<?php } ?>
            </div>

            <div class="social inline fright">
                <ul id="social">
                <li class="bleft inline">
                    <ul style="margin-left: 10px">
                        <li><a href="https://www.facebook.com/" target="_blank" original-title="twitter"><img src="images/social/icon_header_face.png" alt=""></a></li>
                        <li><a href="https://plus.google.com/" target="_blank" original-title="googleplus"><img src="images/social/icon_header_g.png" alt=""></a></li>
                    </ul>
                </li>
                </ul>
            </div>
        </div>

        <div class="clear"></div>
        <div class="navigate">
            <div class="width">
                <div class="logo inline">
                    <h1 class="inline fleft">AVNET TOUCH</h1>
                </div>

                <div class="navigation inline">
                    <ul class="nav inline menuleft customNav">
                        <li class="active"><div class="bleft" ng-click="ScrollCtrl('id_home')">HOME</a></li>
                        <li><div class="bleft" ng-click="ScrollCtrl('id_about')">ABOUT</div></li>
                        <li><div class="bleft relativeDiv" ng-click="ScrollCtrl('id_projects')">PROJECTS</div></li>
                        <li><div class="bleft" ng-click="ScrollCtrl('id_cont')">CONTACTS</div></li>
                        <li><div class="bleft last" ng-click="ScrollCtrl('id_partner')">PARTNERS</div></li>
                    </ul>
                </div>
			
            </div>
            <div class="clear"></div>
        </div>


    </div>
<div ng-show="navbar" id="navtop" class="width navigate">
    <div class="navigation">
        <ul class="nav inline menuleft customNav">
            <li class="active"><div class="bleft" ng-click="ScrollCtrl('id_home')">HOME</a></li>
            <li><div class="bleft" ng-click="ScrollCtrl('id_about')">ABOUT</div></li>
            <li><div class="bleft" ng-click="ScrollCtrl('id_projects')">PROJECTS</div></li>
            <li><div class="bleft" ng-click="ScrollCtrl('id_cont')">CONTACTS</div></li>
            <li><div class="bleft last" ng-click="ScrollCtrl('id_partner')">PARTNERS</div></li>
        </ul>
    </div>
</div>
<a name="id_home"></a>
<div class="contentt">
<div class="container-fluid galleryBox line">
    <div class="gallery">
		<div ng-repeat="img in gallery"  class="pictBoxFrame">
			<div class="pictBox pictBox{{img.name}}" style="background-image:url('images/gallery/{{img.name}}.jpg');background-size:100% 100%">
			</div>
			<div class="contentBox contentBox{{img.name}}">{{img.content}}</div>
		</div>
	</div>
</div>

<div class="clear"></div>
<a name="id_about"></a>
<div class="content">
    <h1 class="decoration text-center about"><span class="nobacgr">About</span></h1>
    <div class="about_block">
        <p class="about_cont">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate egestas sem, eu cursus ligula ullamcorper non. Curabitur tristique velit eu mauris venenatis egestas. Phasellus bibendum placerat metus, sed molestie magna semper eget. Sed sit amet dui felis, tempus porttitor justo.</p>
        <div class="row-fluid folders">
            <div class="span4">
                <div class="folder_bordered">
                    <div class="folder"><img src="images/folder1.png" alt=""></div>
                    <div class="folder"><h3 class="nomarg text-center">Step 1</h3></div>
                    <div class="folder"><p class="green text-center"><strong>Choose a project</strong></p></div>
                </div>
                <div class="folder"><img src="images/folder_n.png" alt=""></div>
            </div>
            <div class="span4">
                <div class="folder_bordered">
                    <div class="folder"><img src="images/folder2.png" alt=""></div>
                    <div class="folder"><h3 class="nomarg text-center">Step 2</h3></div>
                    <div class="folder"><p class="green text-center"><strong>Choose Wishes</strong></p></div>
                </div>
                <div class="folder"><img src="images/folder_n.png" alt=""></div>
            </div>
            <div class="span4">
                <div class="folder_bordered">
                    <div class="folder"><img src="images/folder3.png" alt=""></div>
                    <div class="folder"><h3 class="nomarg text-center">Step 3</h3></div> <a name="id3"></a>
                    <div class="folder"><p class="green strong text-center"><strong>Contribute gifts</strong></p></div>

                </div>
                <div class="folder"><img src="images/folder_n.png" alt=""></div>
            </div>

        </div>
    </div>
<a name="id_projects"></a>
<h1 class="decoration text-center proj"><span class="nobacgr">Projects</span></h1>
    <section class="section content" id="portfolio-list">

        <div class="wrapper row-fluid projects font_p" id="contentWrapper">
            <div class="zone-content clearfix">
                <div class="portfolio-container">
                    <div class="portfolio-listing creative development block" style="display: block;">

                        <div class="span4 bordered" ng-repeat="proj in projects">
                            <div class="folder">
                                <h4 class="text-center title"><a href="#/proj?projId={{proj.id}}">{{proj.name}}</a></h4>
                            </div>
                           
                            <div class="folder border" style="background:url(images/defaults/project.png) no-repeat center;background-size:100% 100%">
                                <a href="#/proj?projId={{proj.id}}">
                                    <div class="author_proj proj_1"></div>
                                </a>
                            </div>
                            
                            <p class="descr">{{proj.desc}}</p>

                            <div class="folder price topbordered">
                                <div class="span4">
                                    <strong>
                                        <span class="project_value"><i class="fa fa-gift"></i> {{proj.wishCount}}</span>
                                    </strong>
                                    <p>pledged</p>
                                </div>
                                <div class="span4 bleft">
                                    <strong><i class="fa fa-bullhorn"></i> {{proj.wishGrant}}</strong>
                                    <p>grant</p>
                                </div>
                                <div class="span4 bleft">
                                    <strong><i class="fa fa-calendar"></i> {{proj.countTimer}}</strong>
                                    <p>days to go</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div><!-- end of .zone-content -->
        </div><!-- end of .content-wrapper -->

    </section>

<a name="id_cont"></a>
<h1 class="decoration text-center conts"><span class="nobacgr">Your Contacts</span></h1>

<div class="contacts">
	<h3>Are you aware of any organization which needs help? Tell us!</h3>
    <div>
		<h4>Organization/Trust Name</h4>
		<input type="text" name="trustName" ng-model="orgName"/>
	</div>
	<div>
		<h4>Organization's Contact Number</h4>
		<input type="text" name="trustName" ng-model="orgPhone"/>
	</div>
	<div>
		<h4>Referer's Contact Number</h4>
		<input type="text" name="trustName" ng-model="orgRef"/>
	</div>
	<p>
		<h4>Tell us something about the Organization</h4>
		<textarea name="suggestions" ng-model="orgSugg"></textarea>
	</p>
	<input type="button" value="Submit" ng-click="submitSuggestion()"/>
	<p class="errorMsg" ng-show="validateSugg">* All fields are mandatory</p>
	<h4 class="successMsg" ng-show="successSugg">Your Suggestion has been recorded. We will contact you soon!</h4>
</div>

</div>
<a name="id_partner"></a>
<div class="partner_bott">
    <div class="partners">
        <h5 class="decoration text-center"><span class="nobacgr_whit">OUR PARTNERS</span></h5>
        <div class="partn_pics">
            <img ng-repeat="img in partners" src="images/partners/{{img.logo}}" width="{{img.width}}" height="{{img.height}}"/>
         </div>
        </div>
    </div>
</div>

<div id="loginPopUp" class="popUp">
	<span class="heading">Login</span><hr/>
	<form action="server/authmodule/login.php" method="POST">
		<div class="popUpContent">
			Username <input type="text" name="username" ng-model="username" required/>
			Password <input type="password" name="password" ng-model="password" required/>
			<input type="hidden" name="projId" value="0"/>
		</div>
		<div class="buttons">
			<input type="submit" value="LOG IN"/>
			<input type="button" value="CANCEL" ng-click="hidePop()"/>
		</div>
	</form>
</div>

<div ng-controller="registerController">
	<div id="registerPopUp" class="popUp">
		<span class="heading">Register</span><hr/>
		<form name="regform" method="POST">
			<div class="popUpContent">
				First Name <span class="errorMsg">{{firstNameError}}</span>
				<input type="text" name="firstName" ng-model="firstName"/>
				Last Name <span class="errorMsg">{{lastNameError}}</span>
				<input type="text" name="lastName" ng-model="lastName"/>
				Email <span class="errorMsg">{{emailError}}</span>
				<input type="email" name="email" ng-model="email"/>
				Password <span class="errorMsg">{{passError}}</span>
				<input type="password" name="password" ng-model="password"/>
				Contact Number <span class="errorMsg">{{contactError}}</span>
				<input type="tel" name="contact" ng-model="contact"/>
				<input type="hidden" name="projId" value="{{projectId}}"/>
			</div>
			<div class="buttons">
				<input type="button" value="REGISTER" ng-click="register()"/>
				<input type="button" value="CANCEL" ng-click="hidePop()"/>
			</div>
		</form>
	</div>

	<div id="alertPopUp" class="popUp">
		<span class="heading">Registration</span><hr/>
		<h4>{{alertMsg}}</h4>
		<div class="buttons">
			<input type="button" value="LOGIN Now" ng-click="showPop('#loginPopUp')"/>
			<input type="button" value="REGISTER"  ng-click="showPop('#registerPopUp')"/>
			<input type="button" value="CANCEL" ng-click="hidePop()"/>
		</div>
	</div>
</div>


<ul class="sideMenu">
	<li ng-click="ScrollCtrl('id_home')"><i class="fa fa-home"></i></li>
	<li ng-click="ScrollCtrl('id_about')"><i class="fa fa-info"></i></li>
	<li ng-click="ScrollCtrl('id_projects')"><i class="fa fa-folder-open"></i></li>
	<li ng-click="ScrollCtrl('id_cont')"><i class="fa fa-phone"></i></li>
	<li ng-click="ScrollCtrl('id_partner')"><i class="fa fa-users"></i></li>
</ul>

<div id="footer">
<div class="footer">
	<div class="row-fluid">
		<div class="span3 phoneNo">
			<h2>Contact Us</h2>
			Karunanidhi <h4 class="green">9940447746</h4>
			Divya <h4 class="green">9940447746</h4>
			Sivanadham <h4 class="green">9940447746</h4>
		</div>
		<div class="span3">
			<h2>Address</h2>
			<div>Ascendant Technology</div>
			<div>Sterling Towers</div>
			<div>Teynampet</div>
			<div>Chennai - 600 006</div>
		</div>
		<div class="span6">
			<h2>AVNET TOUCH</h2>
			<div class="roundDiv"></div>
			<div class="aboutDiv">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate egestas sem, eu cursus ligula ullamcorper non. Curabitur tristique velit eu mauris venenapus</div>
		</div>
	</div>
</div>
<div class="footer_bot">
	<div class="footer_bott">
		<div class="fleft">&copy; AVNET TOUCH 2014</div>
		<div class="fright">
			<ul id="social_b" class="socialbott inline">
				<li><a href="https://www.facebook.com/" target="_blank" original-title="twitter"><img src="images/social/icon_header_face.png" alt=""></a></li>
				<li><a href="https://plus.google.com/" target="_blank" original-title="googleplus"><img src="images/social/icon_header_g.png" alt=""></a></li>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>