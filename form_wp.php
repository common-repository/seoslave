<?php

/* SeoSlave Link-Exchance Wordpress Plugin
 Copyright (C) 2010 SeoSlave.com
 This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.
 This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>.
 Copyright notice above.
 SEO Research Group, ITT Corporation, UK140-160 St. John Street, London, UK
 E-Mail: mail@itt24.com
 Verbatim copying and distribution of this entire article is permitted in any medium without royalty provided this notice is preserved.*/

function adminForm() {
	echo '<div class="wrap">';
	echo '<h2>SeoSlave Options</h2>';
	echo '<h3>Zugangsdaten zu seoslave.de / Login information for seoslave.com</h3>';

	$seo_password=get_option('seo_password');
	$seo_username=get_option('seo_username');

	echo '<p>Hier finden Sie Ihre Zugangsdaten zu <a href="http://www.seoslave.de" target="_blank">seoslave.de</a></p>';
	echo '<p>Here you can find your login information for <a href="http://www.seoslave.com" target="_blank">seoslave.com</a></p>';

	if (($seo_username===FALSE) || ($seo_password===FALSE))
	{
		echo '<p><b>Es sind noch keine Zugangsdaten verfügbar. Bitte aktivieren Sie das Plugin und laden Sie Ihre Wordpress-Seite mindestens 1x, danach finden Sie hier Ihre Zugangsdaten.</b></p>';
		 
		echo '<p><b>There is no login information available. Please activate the plugin and load your wordpress page once. After that you will find the login information here.</b></p>';
	}
	else
	{
		echo '<p><b>Username:</b> '.$seo_username.'<br />';
		echo '<p><b>Passwort:</b> '.$seo_password.'</p>';
	}


	echo '<p></p><hr size="2">';
	echo '<h3>Einstellungen / Options</h3>';
	echo '<p>Hier können Sie festlegen ob vor und nach den Links ein HTML-Code verwenden werden soll.</p>';
	echo '<p>Here you can enter a optional HTML-Code, wich is placed before and behind the links.</p>';
	echo '<p></p><hr size="2">';
	echo '<h3>Example</h3>';
	echo '<p><strong>Vor den Links / Before:</strong> &lt;p&gt;</p>';
	echo '<p><strong>Nach den Links / Behind:</strong> &lt;p\&gt;</p><hr size="2">';
	echo '<h3>Einstellungen / Options</h3>';
	if ($_REQUEST['submit']) {
		saveForm();
	}
	showForm();
}

function saveForm() {
	update_option('before', $_REQUEST['before']);
	update_option('behind', $_REQUEST['behind']);
}


function showForm() {

	$default = get_option('before');
	$default = str_replace("&","&amp;",$default);
	$default = str_replace("<","&lt;",$default);
	$default = str_replace(">","&gt;",$default);
	$default = str_replace("\"","&quot;",$default);
	$default = str_replace("\\","",$default);

	$default2 = get_option('behind');
	$default2 = str_replace("&","&amp;",$default2);
	$default2 = str_replace("<","&lt;",$default2);
	$default2 = str_replace(">","&gt;",$default2);
	$default2 = str_replace("\"","&quot;",$default2);
	$default2 = str_replace("\\","",$default2);

	echo '<form method="post">';
	echo '<label for="before"><strong>Dieser HTML-Code wird <b>VOR</b> den Links eingebunden / This HTML-Code will be placed before the links:</strong>';
	echo '<input type="text"  name="before" size="122" maxlength="300" value="' . $default . '">';
	echo '</label><br /><p></p>';
	echo '<label for="behind"><strong>Dieser HTML-Code wird <b>NACH</b> den Links eingebunden / This HTML-Code will be placed behind the links:</strong>';
	echo '<input type="text"  name="behind" size="122" maxlength="300" value="' . $default2 . '">';
	echo '</label><br /><p></p>';
	echo '<input type="submit" style="height: 25px; width: 250px" name="submit" value="Sichern / Save">';
	echo '<input type="reset" style="height: 25px; width: 250px" name="reset" value="Reset">';
	echo '</form>';
	echo '<p>Dieses Plugin wurde von Seoslave programmiert.<br />';
	echo 'Weitere Informationen unter <a href="http://www.seoslave.de" target="_blank">www.seoslave.de</a></p>';
	echo '</div>';
}

?>