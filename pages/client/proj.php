<div id="header" class="header">
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

            <div class="navigation inline fright">
                <ul class="nav inline menuleft">
                    <li><a class="bleft" href="#/">HOME</a></li>
                    <li><a class="bleft" href="#/#id_about">ABOUT</a></li>
                    <li class="active"><a class="bleft" href="#/#id3">PROJECTS</a></li>
                    <li><a class="bleft" href="#/#id_cont">CONTACTS</a></li>
                    <li><a class="bleft last" href="#/#id_partn">PARTNERS</a></li>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
        <div id="header_select">
            <select id="dynamic_select">
                <option value="" selected="">Select A Page</option>
                <option value="#/#id_about">About</option>
                <option value="#/#id3">Projects</option>
                <option value="#/#id_cont">Contacts</option>
                <option value="#/#id_partn">Partners</option>
            </select>
        </div>
    </div>
</div>



<!-- Actual Content -->
<div class="line avnetItems">
	<div class="projSection">
		<div class="projSectionLeft"></div>
		
		<div class="projSectionRight">
			<div class="projectHeading">{{projectName}}</div>
			<div class="projRow">
				<div class="projIcon"><i class="fa fa-gift"></i></div>
				<div class="projCount">{{projectWishesCount}}</div>
				<div class="projCountDesc">total number of wishes</div>
			</div>
			<div class="projRow">
				<div class="projIcon"><i class="fa fa-bullhorn"></i></div>
				<div class="projCount">{{projectWishesGrant}}</div>
				<div class="projCountDesc">pledged to give gifts</div>
			</div>
			<div class="projRow">
				<div class="projIcon"><i class="fa fa-thumbs-up"></i></div>
				<div class="projCount">{{projectWishesGrantByMe}}</div>
				<div class="projCountDesc">items you have contributed</div>
			</div>
			<div class="projRow">
				<div class="projIcon"><i class="fa fa-calendar"></i></div>
				<div class="projCount">{{projectCounter}}</div>
				<div class="projCountDesc">days to go</div>
			</div>
		</div>
		<div class="clear:both"></div>
	</div>

	
	<div class="wishListSection">
		<h1 class="decoration text-center conts"><span class="nobacgr">Wish Items</span></h1>
		<div class="itemBlock" ng-repeat="item in wishListItems" ng-mouseover="">
			<div class="itemPict"><img src="images/wishes/{{item.url}}.jpg" width="100%" height="100%"/></div>
			<div class="itemName">
				<div class="line_1">{{item.name}}</div>
				<div class="line_2">{{item.qty}}</div>
				<div class="line_3">{{item.oth}}</div>
			</div>
			<div class="contributer contributer{{item.isGrant}} contributer{{item.isDel}}">
				<div ng-show="item.isGrant == 'YES'" >
					<div class="smallHeading">Contributed by</div>
					<span class="contributerName">{{item.contName}}</span>
				</div>
				<div ng-show="item.isGrant != 'YES'" >
					<div class="smallHeading">You can contribute </div>
					<span class="smallHeading">this item for Avnet Touch</span>
				</div>
			</div>
			<?php
			if(!isset($_SESSION['logged'])){?>
                <div ng-show="item.isGrant!='YES'" class="contributeButton" ng-click="showPop('#loginPopUp')"></div>
            <?php }
            else{ ?>
                <div ng-show="item.isGrant!='YES'" class="contributeButton" ng-click="contributeItem(item.id)"></div>
				<div ng-show="item.isGrant=='YES' && item.isDel=='true'" class="cancelButton" ng-click="cancelItem(item.id)"></div>
            <?php } ?>
                
		</div>
	</div>
</div>
<div id="loginPopUp" class="popUp">
	<span class="heading">Login</span><hr/>
	<form action="server/authmodule/login.php" method="POST">
		<div class="popUpContent">
			Username <input type="text" name="username" ng-model="username"/>
			Password <input type="password" name="password" ng-model="password"/>
			<input type="hidden" name="projId" value="{{projectId}}"/>
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