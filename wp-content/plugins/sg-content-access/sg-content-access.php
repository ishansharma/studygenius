<?php
/**
 * Plugin Name: Study Genius Content Access Manager
 * Plugin URI: http://studygeni.us
 * Description: Handles Notes and Subject access for Study Genius.
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

add_filter('the_content', 'verify_user_access');

function verify_user_access($content) {
    // Calling Global user object into scope
    global $user;
    // Calling Global post object into scope
    global $post;
    // Check if user is logged in and has a role
    if (isset($user->roles) && is_array($user->roles)) {
        // Confirm that user is a student
        if(in_array('student', $user->roles)) {
            // At this point, we know that the user is a student.
            $user_type = student;
            // Getting the student's course
            $student_course = get_user_meta($user->ID, 'wpcf-student-course', 'true');
            $student_branch = get_user_meta($user->ID, 'wpcf-student-course-branch', 'true');
        }
        $post_taxonomies = wp_get_post_terms($post->ID, 'course');
        // We have the student course, branch and post taxonomy. If branch and taxonomy match, we are good to go.
        if (in_array($student_branch, $post_taxonomies)) {
            return $content;
        }
        else {
            return 'You are not allowed to access these notes. If this is in error, please contact IT Support';
        }
    }
    else {
        // Let WordPress take care of the access
        return $content;
    }
}

?>