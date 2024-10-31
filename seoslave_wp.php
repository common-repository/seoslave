<?php
/**
 * @package Seoslave
 * @author Seoslave.com
 * @version 1.12
 */
/*
 Plugin Name: Seoslave Wordpress Plugin
 Plugin URI: http://www.seoslave.com
 Description: This plugin will automatically show links from the <a href="http://www.seoslave.com">SeoSlave.com</a> link exchange system on your web site. The more links you display, the more backlinks you will get back. This is an easy way to increase your search engine keyword ranking by getting many valuable backlinks in minutes. The SeoSlave service is used by many SEO professionals and web site owners who want to increase the ranking of their websites. The links will be shown below the article text in the same textstyle. You can configure all possible options in the SeoSlave user area. Here you can find your <a href="options-general.php?page=SeoSl">login information</a> for seoslave.com / Das ist das Seoslave-Plugin für Wordpress. Hier finden Sie Ihre <a href="options-general.php?page=SeoSl">Zugangsdaten</a> für seoslave.de
 Author: Seoslave
 Version: 1.12
 Author URI: http://www.seoslave.com/
 */

/* SeoSlave Link-Exchance Wordpress Plugin
 Copyright (C) 2010 SeoSlave.com
 This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.
 This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>.
 Copyright notice above.
 SEO Research Group, ITT Corporation, UK140-160 St. John Street, London, UK
 E-Mail: mail@itt24.com
 Verbatim copying and distribution of this entire article is permitted in any medium without royalty provided this notice is preserved.*/

include 'conf_wp.php';

$before = get_option('before');
$behind = get_option('behind');
$seo_user = get_option('seo_user');

function getUserId()
{
	//User-ID ermittelt
	$url="http://www.seoslave.com/seoslave/user_id.php";

	if ( function_exists('curl_init') ) {
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		$html = curl_exec($ch);
		curl_close($ch);
	}
	else{
		if(@fsockopen("localhost",80,$errno,$errstr,1)){
			$html=@implode("",file($url));
		}
	}

	$split=explode(";", $html);

	update_option('seo_username', $split[0]);
	update_option('seo_password', $split[1]);
	update_option('seo_user', $split[2]);

	return $split[2];
}

function seoslave() {

	if (!isset($_GET['seoslave']))
	{

		global $before;
		global $behind;
		global $seo_user;

		if ($seo_user===FALSE)
		{
			$seo_user=getUserId();
		}

		$utf=0; //Bei UTF-Homepages auf "1" setzen, sonst "0". Falls dieser Wert falls gesetzt ist werden Umlaute falsch dargestellt.

		if ((is_numeric($seo_user)) && ($seo_user>=1))
		{
			//DO NOT CHANCE
			$domain=$_SERVER["HTTP_HOST"];
			$url_request=urlencode($_SERVER["REQUEST_URI"]);
			$query_string_windows=urlencode($_SERVER["QUERY_STRING"]);
			$url_redirect=urlencode($_SERVER["REDIRECT_URL"]);
			$ip=urlencode($_SERVER["REMOTE_ADDR"]);
			$links_url="http://www.seoslave.com/seoslave/links.php?user_id=$seo_user&domain=$domain&url_request=$url_request";

			if ( function_exists('curl_init') ) {
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_URL, $links_url);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				$html = curl_exec($ch);
				curl_close($ch);
			}
			else{
				if(@fsockopen("localhost",80,$errno,$errstr,1)){
					$html=@implode("",file($links_url));
				}
			}

			// Output the links
			if (strlen($html)>=5) {
				if ($utf==0) $html=utf8_decode($html);
				echo $before.$html.$behind;
			}
		}
		else
		{
			true;
		}

		$_GET['seoslave']=1;
	}
}

add_action('loop_end', 'seoslave');

?>
