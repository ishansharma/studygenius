<?php
/**
 * Plugin Name: Study Genius Login Redirect
 * Plugin URI: http://studygeni.us
 * Description: Handles login for Study Genius.
 * Version: 1.0
 * Author: Ishan
 * Author URI: http://ishan.co
 */

/*  Copyright 2014  Ishan Sharma  (email : contact@ishansharma.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_filter('login_redirect', 'sg_handle_login');

function sg_handle_login($redirect_to, $request, $user) {
	// Calling global variable to access current user info
	global $user;
	// Check if user roles are defined and array is set
	if (isset($user->roles) && is_array($user->roles)) {
		// Check if user is a student
		if (in_array("student", $user->roles)) {
			$student_redirect_url = home_url() . '/welcome-student';
			return $student_redirect_url; 
		}
		// Checking for teachers
		else if (in_array("teacher", $user->roles)) {
			$teacher_redirect_url = home_url() . '/welcome-teacher';
			return $teacher_redirect_url;
		}
		// Everyone else goes to admin panel, default action
		else {
			return $redirect_to;
		}
	}
	// If no condition matches (some problem?), let WP handle it. 
	else {
		return $redirect_to;
	}
}

?>