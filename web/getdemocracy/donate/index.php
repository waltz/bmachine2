<?php
include ("../include/base.php");
include ("../include/start.php");
?>
		<div id="content">
			<div id="content-1col">
				<img src="<?= $base ?>/images/img_roadtolarge.jpg" />
				<h4>Help Us Build an Independent Internet TV System</h4>
				<p>We think it is crucial that there be a strong, open platform for people to watch, share, and broadcast video to each other. Democracy can be that technology-- we are open-source, not-for-profit, and 100% focused on supporting viewers and creators. The internet creates the best opportunity ever for independent broadcasting that everyone can participate in. But developing world-class software takes time and money.</p>

				<h4>What does your donation support?</h4>
				<p>We are working to make Democracy Player the best internet video tool in the world. We have a foundation in place and we're moving towards version 1.0. Our work is focusing on things like speed and reliability, the ability for publishers to offer one-click subscription on their website, the ability to open and play video files from your desktop, integrated publishing ability inside Democracy Player, fullscreen controls and a fullscreen remote-controllable interface.</p>

				<h4>Consider a Recurring Donation</h4>
				<p>Every donation we get provides a measurable boost to the project. But recurring donations (automatic monthly contributions) are especially helpful because they provide a predictable and reliable source of income. For example, we can only hire a new programmer if we can predict whether we will be able to afford that salary on an ongoing basis. Recurring donations make that planning possible, and as we move towards Democracy Player 1.0, we need those resources urgently.</p>

				<div>
				To donate with a credit card, use the form below.  To donate with PayPal, click here:
				<form style="display: inline; vertical-align: bottom;" action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="business" value="donate@pculture.org">
				<input type="hidden" name="item_name" value="Donation to Democracy Platform">
				<input type="hidden" name="item_number" value="111">
				<input type="hidden" name="no_shipping" value="1">
				<input type="hidden" name="return" value="<?= $base ?>/">
				<input type="hidden" name="cancel_return" value="<?= $base ?>/donate">
				<input type="hidden" name="no_note" value="1">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="tax" value="0">
				<input type="hidden" name="bn" value="PP-DonationsBF">
				<input type="submit" value="PayPal >>" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
				</form>
				<br style="clear: both;" />
				</div>

				<div id="donation_zone">
				<script src="https://secure.democracyinaction.org/dia/include/validateData.js" language="Javascript"></script>
				<form name="data" action="https://secure.democracyinaction.org/dia/shop/processDonate.jsp" method="POST">
				<INPUT class='inputStyle'  type=hidden name="table" value="supporter">
				<dt><strong>Yes</strong>, I would like to donate </dt>
				<dd>
				<input value="1" type="radio"  name="recurring"  checked="checked" /><span class="dia_field_name"I want to make a recurring donation</span>
				<select name="PAYPERIOD" id="donation_pay_periods">
					<option class="donation_pay_period" value="MONT">Once a Month</option>
					<option class="donation_pay_period" value="QTER">Every 3 months</option>
					<option class="donation_pay_period" value="SMYR">Every 6 months</option>
					<option class="donation_pay_period" value="YEAR">Every Year</option>
				</select>
				</dd>
				<dt>&nbsp;</dt>
				<dd>
				<input value="0" type="radio" name="recurring" />
				One-time donation. <script>
				function helpopen(){
				 window.open('http://demaction.org/dia/recurringInfo.html', 'win','width=500,height=300');
				}</script>
				<a href="javascript:helpopen();">help</a>
				</dd>
				<div style="height: 13px;">
				&nbsp;
				</div>
				<dt>Donation Amount</dt>
				<dd>
				<input type="radio" class="radio" value="5" name="amount"><span class="dia_field_name">$5</span>
				<input type="radio" class="radio" value="10" name="amount"><span class="dia_field_name">$10</span>
				<input type="radio" class="radio" value="25" name="amount"><span class="dia_field_name">$25</span>
				<input type="radio" class="radio" value="50" name="amount"><span class="dia_field_name">$50</span>
				&nbsp;&nbsp;
				<input type="radio" class="radio" name="amount" value="">Other:&nbsp;&nbsp;<input class="inputStyle" name="amountOther" size=5>
				</dd>
				<div class="divider">
				&nbsp;
				</div>
				<strong>Your Info</strong><br /><br />
				<INPUT class='inputStyle' type=hidden name="key" value="0">
				<dt>First Name</dt>
				<dd><INPUT class='inputStyle'    size=24 maxlength=32 id="dataFirst_Name" NAME="First_Name" VALUE=""></INPUT></dd>
				<dt>Last Name</dt>
				<dd><INPUT class='inputStyle'    size=24 maxlength=64 id="dataLast_Name" NAME="Last_Name" VALUE=""></INPUT>
				</dd>
				<dt>Email</dt>
				<dd>
				<INPUT class='inputStyle'    size=24 maxlength=64 id="dataEmail" NAME="Email" VALUE=""></INPUT>
				</dd>
				<dt>Street</dt>
				<dd>
				<INPUT class='inputStyle' size=24 maxlength=64 id="dataStreet" NAME="Street" VALUE=""></INPUT>
				</dd>
				<dt>
				Street 2
				</dt>
				<dd>
				<INPUT class='inputStyle'    size=24 maxlength=64 id="dataStreet_2" NAME="Street_2" VALUE=""></INPUT>
				</dd>
				<dt>City
				</dt>
				<dd>
				<INPUT class='inputStyle'    size=24 maxlength=32 id="dataCity" NAME="City" VALUE=""></INPUT>
				</dd>
				<dt>
				State/Region
				</dt>
				<dd>
				<select id="dataState" name="State" size="1">
							<OPTION VALUE="">Select...</option>
								<OPTION VALUE="AL" >Alabama</OPTION>
					<OPTION VALUE="AK" >Alaska</OPTION>
					<OPTION VALUE="AZ" >Arizona</OPTION>
					<OPTION VALUE="AR" >Arkansas</OPTION>
					<OPTION VALUE="CA" >California</OPTION>
					<OPTION VALUE="CO" >Colorado</OPTION>
					<OPTION VALUE="CT" >Connecticut</OPTION>
					<OPTION VALUE="DE" >Delaware</OPTION>
					<OPTION VALUE="DC" >D.C.</OPTION>
					<OPTION VALUE="FL" >Florida</OPTION>
					<OPTION VALUE="GA" >Georgia</OPTION>
					<OPTION VALUE="HI" >Hawaii</OPTION>
					<OPTION VALUE="ID" >Idaho</OPTION>
					<OPTION VALUE="IL" >Illinois</OPTION>
					<OPTION VALUE="IN" >Indiana</OPTION>
					<OPTION VALUE="IA" >Iowa</OPTION>
					<OPTION VALUE="KS" >Kansas</OPTION>
					<OPTION VALUE="KY" >Kentucky</OPTION>
					<OPTION VALUE="LA" >Louisiana</OPTION>
					<OPTION VALUE="ME" >Maine</OPTION>
					<OPTION VALUE="MD" >Maryland</OPTION>
					<OPTION VALUE="MA" >Massachusetts</OPTION>
					<OPTION VALUE="MI" >Michigan</OPTION>
					<OPTION VALUE="MN" >Minnesota</OPTION>
					<OPTION VALUE="MS" >Mississippi</OPTION>
					<OPTION VALUE="MO" >Missouri</OPTION>
					<OPTION VALUE="MT" >Montana</OPTION>
					<OPTION VALUE="NE" >Nebraska</OPTION>
					<OPTION VALUE="NV" >Nevada</OPTION>
					<OPTION VALUE="NH" >New Hampshire</OPTION>
					<OPTION VALUE="NJ" >New Jersey</OPTION>
					<OPTION VALUE="NM" >New Mexico</OPTION>
					<OPTION VALUE="NY" >New York</OPTION>
					<OPTION VALUE="NC" >North Carolina</OPTION>
					<OPTION VALUE="ND" >North Dakota</OPTION>
					<OPTION VALUE="OH" >Ohio</OPTION>
					<OPTION VALUE="OK" >Oklahoma</OPTION>
					<OPTION VALUE="OR" >Oregon</OPTION>
					<OPTION VALUE="PA" >Pennsylvania</OPTION>
					<OPTION VALUE="PR" >Puerto Rico</OPTION>
					<OPTION VALUE="RI" >Rhode Island</OPTION>
					<OPTION VALUE="SC" >South Carolina</OPTION>
					<OPTION VALUE="SD" >South Dakota</OPTION>
					<OPTION VALUE="TN" >Tennessee</OPTION>
					<OPTION VALUE="TX" >Texas</OPTION>
					<OPTION VALUE="UT" >Utah</OPTION>
					<OPTION VALUE="VT" >Vermont</OPTION>
					<OPTION VALUE="VA" >Virginia</OPTION>
					<OPTION VALUE="WA" >Washington</OPTION>
					<OPTION VALUE="WV" >West Virginia</OPTION>
					<OPTION VALUE="WI" >Wisconsin</OPTION>
					<OPTION VALUE="WY" >Wyoming</OPTION>
					<OPTION VALUE="AB">Alberta</OPTION>
					<OPTION VALUE="BC">British Columbia</OPTION>
					<OPTION VALUE="MB">Manitoba</OPTION>
					<OPTION VALUE="NF">Newfoundland</OPTION>
					<OPTION VALUE="NB">New Brunswick</OPTION>
					<OPTION VALUE="NS">Nova Scotia</OPTION>
					<OPTION VALUE="NT">Northwest Territories</OPTION>
					<OPTION VALUE="NU">Nunavut</OPTION>
					<OPTION VALUE="ON">Ontario</OPTION>
					<OPTION VALUE="PE">Prince Edward Island</OPTION>
					<OPTION VALUE="QC">Quebec</OPTION>
					<OPTION VALUE="SK">Saskatchewan</OPTION>
					<OPTION VALUE="YT">Yukon Territory</OPTION>
					<OPTION VALUE="ot">Other</OPTION>
							</SELECT>
							<SCRIPT>
								//Set the value of the option box
								var i;
								var field=document.getElementById('dataState');
								for (i=0; i<field.options.length;i++){
									if (field.options[i].value==''){
										field.options[i].selected=true;
										break;
									}
								}
							</SCRIPT>
				</dd>
				<dt>
				Zip/Postal Code
				</dt>
				<dd>
				<INPUT class='inputStyle' id="dataZip"  type="number" size=10 maxlength=10 NAME="Zip"  VALUE=""></INPUT>
				<INPUT class='inputStyle' id="PRIVATE_Zip_Plus_4"  type="number" size=4 maxlength=4 NAME="PRIVATE_Zip_Plus_4" VALUE=""></dd>
				<dt>Country</dt>
				<dd>
				<select id="dataCountry" name="Country" size="1">
							<OPTION VALUE="">Select...</option>
							<option value="United States">United States
				<option value="Afghanistan">Afghanistan
				<option value="Albania">Albania
				<option value="Algeria">Algeria
				<option value="Andorra">Andorra
				<option value="Angola">Angola
				<option value="Antigua and Barbuda">Antigua and Barbuda
				<option value="Argentina">Argentina
				<option value="Armenia">Armenia
				<option value="Australia">Australia
				<option value="Austria">Austria
				<option value="Azerbaijan">Azerbaijan
				<option value="Bahamas">Bahamas
				<option value="Bahrain">Bahrain
				<option value="Bangladesh">Bangladesh
				<option value="Barbados">Barbados
				<option value="Belarus">Belarus
				<option value="Belgium">Belgium
				<option value="Belize">Belize
				<option value="Benin">Benin
				<option value="Bhutan">Bhutan
				<option value="Bolivia">Bolivia
				<option value="Bosnia and Herzegovina">Bosnia and Herzegovina
				<option value="Botswana">Botswana
				<option value="Brazil">Brazil
				<option value="Brunei">Brunei
				<option value="Bulgaria">Bulgaria
				<option value="Burkina Faso">Burkina Faso
				<option value="Burundi">Burundi
				<option value="Cambodia">Cambodia
				<option value="Cameroon">Cameroon
				<option value="Canada">Canada
				<option value="Cape Verde">Cape Verde
				<option value="Central African Republic">Central African Republic
				<option value="Chad">Chad
				<option value="Chile">Chile
				<option value="China">China
				<option value="Colombia">Colombia
				<option value="Comoros">Comoros
				<option value="Congo">Congo
				<option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the
				<option value="Costa Rica">Costa Rica
				<option value="Croatia">Croatia
				<option value="Cuba">Cuba
				<option value="Cyprus">Cyprus
				<option value="Czech Republic">Czech Republic
				<option value="Ivory Coast">Ivory Coast
				<option value="Denmark">Denmark
				<option value="Djibouti">Djibouti
				<option value="Dominica">Dominica
				<option value="Dominican Republic">Dominican Republic
				<option value="East Timor">East Timor
				<option value="Ecuador">Ecuador
				<option value="Egypt">Egypt
				<option value="El Salvador">El Salvador
				<option value="Equatorial Guinea">Equatorial Guinea
				<option value="Eritrea">Eritrea
				<option value="Estonia">Estonia
				<option value="Ethiopia">Ethiopia
				<option value="Fiji">Fiji
				<option value="Finland">Finland
				<option value="France">France
				<option value="Gabon">Gabon
				<option value="Gambia, The">Gambia, The
				<option value="Georgia">Georgia
				<option value="Germany">Germany
				<option value="Ghana">Ghana
				<option value="Greece">Greece
				<option value="Grenada">Grenada
				<option value="Guatemala">Guatemala
				<option value="Guinea">Guinea
				<option value="Guinea-Bissau">Guinea-Bissau
				<option value="Guyana">Guyana
				<option value="Haiti">Haiti
				<option value="Honduras">Honduras
				<option value="Hungary">Hungary
				<option value="Iceland">Iceland
				<option value="India">India
				<option value="Indonesia">Indonesia
				<option value="Iran">Iran
				<option value="Iraq">Iraq
				<option value="Ireland">Ireland
				<option value="Israel">Israel
				<option value="Italy">Italy
				<option value="Jamaica">Jamaica
				<option value="Japan">Japan
				<option value="Jordan">Jordan
				<option value="Kazakhstan">Kazakhstan
				<option value="Kenya">Kenya
				<option value="Kiribati">Kiribati
				<option value="Korea, North">Korea, North
				<option value="Korea, South">Korea, South
				<option value="Kuwait">Kuwait
				<option value="Kyrgyzstan">Kyrgyzstan
				<option value="Laos">Laos
				<option value="Latvia">Latvia
				<option value="Lebanon">Lebanon
				<option value="Lesotho">Lesotho
				<option value="Liberia">Liberia
				<option value="Libya">Libya
				<option value="Liechtenstein">Liechtenstein
				<option value="Lithuania">Lithuania
				<option value="Luxembourg">Luxembourg
				<option value="Macedonia, Former Yugoslav Republic of">Macedonia, Former Yugoslav Republic of
				<option value="Madagascar">Madagascar
				<option value="Malawi">Malawi
				<option value="Malaysia">Malaysia
				<option value="Maldives">Maldives
				<option value="Mali">Mali
				<option value="Malta">Malta
				<option value="Marshall Islands">Marshall Islands
				<option value="Mauritania">Mauritania
				<option value="Mauritius">Mauritius
				<option value="Mexico">Mexico
				<option value="Micronesia, Federated States of">Micronesia, Federated States of
				<option value="Moldova">Moldova
				<option value="Monaco">Monaco
				<option value="Mongolia">Mongolia
				<option value="Morocco">Morocco
				<option value="Mozambique">Mozambique
				<option value="Myanmar">Myanmar
				<option value="Namibia">Namibia
				<option value="Nauru">Nauru
				<option value="Nepal">Nepal
				<option value="Netherlands">Netherlands
				<option value="New Zealand">New Zealand
				<option value="Nicaragua">Nicaragua
				<option value="Niger">Niger
				<option value="Nigeria">Nigeria
				<option value="Norway">Norway
				<option value="Oman">Oman
				<option value="Pakistan">Pakistan
				<option value="Palau">Palau
				<option value="Panama">Panama
				<option value="Papua New Guinea">Papua New Guinea
				<option value="Paraguay">Paraguay
				<option value="Palestine">Palestine
				<option value="Peru">Peru
				<option value="Philippines">Philippines
				<option value="Poland">Poland
				<option value="Portugal">Portugal
				<option value="Qatar">Qatar
				<option value="Romania">Romania
				<option value="Russia">Russia
				<option value="Rwanda">Rwanda
				<option value="Saint Kitts and Nevis">Saint Kitts and Nevis
				<option value="Saint Lucia">Saint Lucia
				<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines
				<option value="Samoa">Samoa
				<option value="San Marino">San Marino
				<option value="Sao Tome and Principe">Sao Tome and Principe
				<option value="Saudi Arabia">Saudi Arabia
				<option value="Senegal">Senegal
				<option value="Serbia and Montenegro">Serbia and Montenegro
				<option value="Seychelles">Seychelles
				<option value="Sierra Leone">Sierra Leone
				<option value="Singapore">Singapore
				<option value="Slovakia">Slovakia
				<option value="Slovenia">Slovenia
				<option value="Solomon Islands">Solomon Islands
				<option value="Somalia">Somalia
				<option value="South Africa">South Africa
				<option value="Spain">Spain
				<option value="Sri Lanka">Sri Lanka
				<option value="Sudan">Sudan
				<option value="Suriname">Suriname
				<option value="Swaziland">Swaziland
				<option value="Sweden">Sweden
				<option value="Switzerland">Switzerland
				<option value="Syria">Syria
				<option value="Taiwan">Taiwan
				<option value="Tajikistan">Tajikistan
				<option value="Tanzania">Tanzania
				<option value="Thailand">Thailand
				<option value="Togo">Togo
				<option value="Tonga">Tonga
				<option value="Trinidad and Tobago">Trinidad and Tobago
				<option value="Tunisia">Tunisia
				<option value="Turkey">Turkey
				<option value="Turkmenistan">Turkmenistan
				<option value="Tuvalu">Tuvalu
				<option value="Uganda">Uganda
				<option value="Ukraine">Ukraine
				<option value="United Arab Emirates">United Arab Emirates
				<option value="United Kingdom">United Kingdom
				<option value="Uruguay">Uruguay
				<option value="Uzbekistan">Uzbekistan
				<option value="Vanuatu">Vanuatu
				<option value="Vatican City">Vatican City
				<option value="Venezuela">Venezuela
				<option value="Vietnam">Vietnam
				<option value="Western Sahara">Western Sahara
				<option value="Yemen">Yemen
				<option value="Zambia">Zambia
				<option value="Zimbabwe">Zimbabwe
							</SELECT>
							<SCRIPT>
								//Set the value of the option box
								var i;
								var field=document.getElementById('dataCountry');
								for (i=0; i<field.options.length;i++){
									if (field.options[i].value==''){
										field.options[i].selected=true;
										break;
									}
								}
							</SCRIPT>
				</dd>
				<INPUT class='inputStyle'  type=hidden name="required" value="0,Email,Country,First_Name,Last_Name,Street,City,State,Zip,">
				<input type="hidden" name="updateRowValues" value="true">
				<input type="hidden" name="merchant_account_KEY" value="98">
				<input type="hidden" name="Tax_Status" value="Unknown">
				<input type="hidden" name="Status" value="Donation_Only">
				<input type="hidden" name="amountLimit" value="100000.0">
				<div class="divider">
				&nbsp;
				</div>
				<strong>Credit Card Info</strong>
				<dt>Card Type</dt>
				<dd>
				<input type="radio" class="donation_cc_type" name="cc_type" value="visa" checked="checked"  /><span class="dia_field_name">VISA</span>
				<br />
				<input type="radio" class="donation_cc_type" name="cc_type" value="mastercard"  /><span class="dia_field_name">MASTERCARD</span><br>
				</dd>
				<dt>
				Card Number
				</dt>
				<dd>
				<input name="cc" type="text" maxlength="16" class="inputStyle" value="">
				</dd>
				<dt>
				Expires
				</dt>
				<dd>
				<select style="width:65px" name="ccExpMonth" class="input">
				<option value="">Month</option>
				<option value="01" >01</option>
				<option value="02" >02</option>
				<option value="03" >03</option>
				<option value="04" >04</option>
				<option value="05" >05</option>
				<option value="06" >06</option>
				<option value="07" >07</option>
				<option value="08" >08</option>
				<option value="09" >09</option>
				<option value="10" >10</option>
				<option value="11" >11</option>
				<option value="12" >12</option>
				</select>
				<select style="width:65px" name="ccExpYear" class="input">
				<option value="">Year</option>
				<option value="06" >2006</option>
				<option value="07" >2007</option>
				<option value="08" >2008</option>
				<option value="09" >2009</option>
				<option value="10" >2010</option>
				<option value="11" >2011</option>
				<option value="12" >2012</option>
				</select>
				</dd>
				    <input type="hidden" name="eligibility" value="1" />
				<input type="hidden" name="redirect" value="thankYou.jsp?donate_page_KEY=1283&donation_KEY=[[donation_KEY]]&recurring_donation_KEY=[[recurring_donation_KEY]]">
				<input type="hidden" name="email_trigger_KEYS" value="0,974">
				<input type="hidden" name="errorPage" value="error.jsp?t=" />
				<input type="hidden" name="organization_KEY" value="1042">
				<input type="hidden" name="Transaction_Type" value="Donation">
				<input type="hidden" name="Tracking_Code" value="">
				<dt>
				&nbsp;
				</dt>
				<dd>
				&nbsp;
				</dd>
				<dt>
				&nbsp;
				</dt>
				<div style="float: right;">
				<script src=https://seal.verisign.com/getseal?host_name=secure.democracyinaction.org&size=S&use_flash=YES&use_transparent=YES></script>
				</div>
				<dd>
				<input style="font-size:20px;" type="submit" name="submit" id="submit" value="Submit Donation >>" />
				</dd>
				<dt>
				&nbsp;
				</dt>
				<dd style="font-size: 12px; color: #777">
				<i>Note: only click this button once.</i>
				</dd>
				</form>
				<div style="display: none;">
				<!--
				<script src="https://secure.democracyinaction.org/dia/include/validateData.js" language="Javascript"></script>
				<form name="data" action="https://secure.democracyinaction.org/dia/shop/processDonate.jsp" method="POST">
				<table border="0" id="donation_table">
				<tr>
				<td valign="top">
				<link rel="stylesheet" href="/dia/api/dia.css" type="text/css" />
				<INPUT type=hidden name="table" value="supporter">
				<TABLE class="dia_field">
				<INPUT type=hidden name="key" value="0">
				<tr valign="top"><td valign="top" align="right" class="dia_field_name" id="dia_field_name_data_First_Name">First Name</td><td valign="top"><INPUT class='inputStyle'    size=24 maxlength=32 id="dataFirst_Name" NAME="First_Name" VALUE=""></INPUT></td><td class="dia_required"> <B>*</B></td>
						</TR><TR><td valign="top" align="right" class="dia_field_name" id="dia_field_name_data_Last_Name">Last Name</td><td valign="top"><INPUT class='inputStyle'    size=24 maxlength=64 id="dataLast_Name" NAME="Last_Name" VALUE=""></INPUT></td><td class="dia_required"> <B>*</B></td>
						</TR><TR><td valign="top" align="right" class="dia_field_name" id="dia_field_name_data_Street">Street</td><td valign="top"><INPUT class='inputStyle'    size=24 maxlength=64 id="dataStreet" NAME="Street" VALUE=""></INPUT></td><td class="dia_required"> <B>*</B></td>
						</TR><TR><td valign="top" align="right" class="dia_field_name" id="dia_field_name_data_Street_2">Street 2</td><td valign="top"><INPUT class='inputStyle'    size=24 maxlength=64 id="dataStreet_2" NAME="Street_2" VALUE=""></INPUT></td><td class="dia_required"></td>
						</TR><TR><td valign="top" align="right" class="dia_field_name" id="dia_field_name_data_City">City</td><td valign="top"><INPUT class='inputStyle'    size=24 maxlength=32 id="dataCity" NAME="City" VALUE=""></INPUT></td><td class="dia_required"> <B>*</B></td>
						</TR><TR><td valign="top" align="right" class="dia_field_name">State/Region</td><td><select id="dataState" name="State" size="1">
							<OPTION VALUE="">Select One...</option>
								<OPTION VALUE="AL" >Alabama</OPTION>
					<OPTION VALUE="AK" >Alaska</OPTION>
					<OPTION VALUE="AZ" >Arizona</OPTION>
					<OPTION VALUE="AR" >Arkansas</OPTION>
					<OPTION VALUE="CA" >California</OPTION>
					<OPTION VALUE="CO" >Colorado</OPTION>
					<OPTION VALUE="CT" >Connecticut</OPTION>
					<OPTION VALUE="DE" >Delaware</OPTION>
					<OPTION VALUE="DC" >D.C.</OPTION>
					<OPTION VALUE="FL" >Florida</OPTION>
					<OPTION VALUE="GA" >Georgia</OPTION>
					<OPTION VALUE="HI" >Hawaii</OPTION>
					<OPTION VALUE="ID" >Idaho</OPTION>
					<OPTION VALUE="IL" >Illinois</OPTION>
					<OPTION VALUE="IN" >Indiana</OPTION>
					<OPTION VALUE="IA" >Iowa</OPTION>
					<OPTION VALUE="KS" >Kansas</OPTION>
					<OPTION VALUE="KY" >Kentucky</OPTION>
					<OPTION VALUE="LA" >Louisiana</OPTION>
					<OPTION VALUE="ME" >Maine</OPTION>
					<OPTION VALUE="MD" >Maryland</OPTION>
					<OPTION VALUE="MA" >Massachusetts</OPTION>
					<OPTION VALUE="MI" >Michigan</OPTION>
					<OPTION VALUE="MN" >Minnesota</OPTION>
					<OPTION VALUE="MS" >Mississippi</OPTION>
					<OPTION VALUE="MO" >Missouri</OPTION>
					<OPTION VALUE="MT" >Montana</OPTION>
					<OPTION VALUE="NE" >Nebraska</OPTION>
					<OPTION VALUE="NV" >Nevada</OPTION>
					<OPTION VALUE="NH" >New Hampshire</OPTION>
					<OPTION VALUE="NJ" >New Jersey</OPTION>
					<OPTION VALUE="NM" >New Mexico</OPTION>
					<OPTION VALUE="NY" >New York</OPTION>
					<OPTION VALUE="NC" >North Carolina</OPTION>
					<OPTION VALUE="ND" >North Dakota</OPTION>
					<OPTION VALUE="OH" >Ohio</OPTION>
					<OPTION VALUE="OK" >Oklahoma</OPTION>
					<OPTION VALUE="OR" >Oregon</OPTION>
					<OPTION VALUE="PA" >Pennsylvania</OPTION>
					<OPTION VALUE="PR" >Puerto Rico</OPTION>
					<OPTION VALUE="RI" >Rhode Island</OPTION>
					<OPTION VALUE="SC" >South Carolina</OPTION>
					<OPTION VALUE="SD" >South Dakota</OPTION>
					<OPTION VALUE="TN" >Tennessee</OPTION>
					<OPTION VALUE="TX" >Texas</OPTION>
					<OPTION VALUE="UT" >Utah</OPTION>
					<OPTION VALUE="VT" >Vermont</OPTION>
					<OPTION VALUE="VA" >Virginia</OPTION>
					<OPTION VALUE="WA" >Washington</OPTION>
					<OPTION VALUE="WV" >West Virginia</OPTION>
					<OPTION VALUE="WI" >Wisconsin</OPTION>
					<OPTION VALUE="WY" >Wyoming</OPTION>
					<OPTION VALUE="AB">Alberta</OPTION>
					<OPTION VALUE="BC">British Columbia</OPTION>
					<OPTION VALUE="MB">Manitoba</OPTION>
					<OPTION VALUE="NF">Newfoundland</OPTION>
					<OPTION VALUE="NB">New Brunswick</OPTION>
					<OPTION VALUE="NS">Nova Scotia</OPTION>
					<OPTION VALUE="NT">Northwest Territories</OPTION>
					<OPTION VALUE="NU">Nunavut</OPTION>
					<OPTION VALUE="ON">Ontario</OPTION>
					<OPTION VALUE="PE">Prince Edward Island</OPTION>
					<OPTION VALUE="QC">Quebec</OPTION>
					<OPTION VALUE="SK">Saskatchewan</OPTION>
					<OPTION VALUE="YT">Yukon Territory</OPTION>
					<OPTION VALUE="ot">Other</OPTION>
							</SELECT>
							<SCRIPT>
								//Set the value of the option box
								var i;
								var field=document.getElementById('dataState');
								for (i=0; i<field.options.length;i++){
									if (field.options[i].value==''){
										field.options[i].selected=true;
										break;
									}
								}
							</SCRIPT>
							</td>
							<td class="dia_required"> <B>*</B></td>
							</TR><TR><td align="right" class="dia_field_name">Zip/Postal Code</td><td><INPUT class='inputStyle' id="dataZip"  type="number" size=10 maxlength=10 NAME="Zip"  VALUE=""></INPUT>
							&nbsp;&nbsp;
							<INPUT class='inputStyle' id="PRIVATE_Zip_Plus_4"  type="number" size=4 maxlength=4 NAME="PRIVATE_Zip_Plus_4" VALUE=""></INPUT>
							</td>
							<td class="dia_required">
							 <B>*</B>
							</td></TR><TR>
				</TR></TABLE>
				<INPUT type=hidden name="required" value="0,First_Name,Last_Name,Street,City,State,Zip,">
				<input type="hidden" name="updateRowValues" value="true">
				<input type="hidden" name="merchant_account_KEY" value="0">
				<input type="hidden" name="Tax_Status" value="Unknown">
				<input type="hidden" name="Status" value="Donation_Only">
				<input type="hidden" name="amountLimit" value="100000.0">
				<table><tr><td>
				<script src=https://seal.verisign.com/getseal?host_name=secure.democracyinaction.org&size=S&use_flash=YES&use_transparent=YES></script>
				</td></tr></table>
				  </TD>
				  <TD valign=top>
				    <table cellpadding="0" cellspacing="0" border="0">
				    <tr>
				    	<td colspan="2">
				   <div class="errorText"></div>
					   <table border="0"><tr>
					   <td nowrap><input type="radio" class="radio" value="10" name="amount"><span class="dia_field_name">$10</span></td><td nowrap><input type="radio" class="radio" value="25" name="amount"><span class="dia_field_name">$25</span></td><td nowrap><input type="radio" class="radio" value="50" name="amount"><span class="dia_field_name">$50</span></td><td nowrap><input type="radio" class="radio" value="100" name="amount"><span class="dia_field_name">$100</span></td></tr><tr><td nowrap><input type="radio" class="radio" value="500" name="amount"><span class="dia_field_name">$500</span></td><td nowrap><input type="radio" class="radio" value="1000" name="amount"><span class="dia_field_name">$1000</span></td><td nowrap><input type="radio" class="radio" value="2500" name="amount"><span class="dia_field_name">$2500</span></td><td nowrap><input type="radio" class="radio" value="5000" name="amount"><span class="dia_field_name">$5000</span></td></tr><tr>
					    </td></tr>
					    </table>
					    <table id="donation_amount_other" border="0">
					    <tr><td colspan=2><input type="radio" class="radio" name="amount" value="">Other:&nbsp;&nbsp;<input class="inputStyle" name="amountOther" size=5></td></tr>
					     </table>
				<table id="donation_cc_types">
				    <tr>
				      <td valign="middle" class="formcell" colspan="2">
				      <hr />
				<input type="radio" class="donation_cc_type" name="cc_type" value="visa" checked="checked"  /><span class="dia_field_name">VISA</span>
				<input type="radio" class="donation_cc_type" name="cc_type" value="mastercard"  /><span class="dia_field_name">MASTERCARD</span><br>
				<input type="radio" class="donation_cc_type" name="cc_type" value="american express"  /><span class="dia_field_name">AMEX</span>
				<input type="radio" class="donation_cc_type" name="cc_type" value="discover"  /><span class="dia_field_name">DISCOVER</span>
				</td>
				    </tr>
				    <tr>
				      <td class="formcell">
				      <div class="errorText"></div>
				      <span class="dia_field_name">credit card number</span><br>
				      <input name="cc" type="text" maxlength="16" class="inputStyle" value=""></td>
				      <td class="formcell">
				      <table cellspacing="0" cellpadding="0" border="0">
				      <tr><td class="dia_field_name">
				      <div class="errorText"></div>
				      <div class="errorText"></div>
				      &nbsp;expires&nbsp;
				</td></tr>
				<tr><td>
				<select style="width:65px" name="ccExpMonth" class="input">
				<option value="">Month</option>
				<option value="01" >01</option>
				<option value="02" >02</option>
				<option value="03" >03</option>
				<option value="04" >04</option>
				<option value="05" >05</option>
				<option value="06" >06</option>
				<option value="07" >07</option>
				<option value="08" >08</option>
				<option value="09" >09</option>
				<option value="10" >10</option>
				<option value="11" >11</option>
				<option value="12" >12</option>
				</select>
				</td></tr><tr><td>
				<select style="width:65px" name="ccExpYear" class="input">
				<option value="">Year</option>
				<option value="06" >2006</option>
				<option value="07" >2007</option>
				<option value="08" >2008</option>
				<option value="09" >2009</option>
				<option value="10" >2010</option>
				<option value="11" >2011</option>
				<option value="12" >2012</option>
				</select>
				<br>
				</td></tr></table>
				  </td>
				</tr>
				    </table>
				  <input type="hidden" name="eligibility" value="1" />
				<input type="hidden" name="redirect" value="thankYou.jsp?donate_page_KEY=1454&donation_KEY=[[donation_KEY]]&recurring_donation_KEY=[[recurring_donation_KEY]]">
					<input type="hidden" name="trigger" value="On Donation">
				<input type="hidden" name="errorPage" value="" />
				</td></tr></table>
				<input type="hidden" name="organization_KEY" value="1042">
				<input type="hidden" name="Transaction_Type" value="Donation">
				</td></tr></table>
				<input type="hidden" name="Tracking_Code" value="">
				<p align=center>
				<input type="submit" name="submit" id="submit" value="Submit" />
				<br /><i>Note: Only click this button once, otherwise your donation may be processed twice</i>
				<br />
				Participatory Culture Foundation has partnered with a third-party provider to facilitate your online credit card transaction.
				</form>

			<div class="clearer"></div>
			</div>
		</div>-->
<?php include "../include/end.php"; ?>