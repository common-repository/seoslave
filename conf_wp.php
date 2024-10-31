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

include 'form_wp.php';

function save() {
	adminForm();
}

function SeoSl() {
	add_options_page('Seoslave', 'Seoslave', 1, 'SeoSl', 'save');
}

add_action('admin_menu', 'SeoSl');

?>