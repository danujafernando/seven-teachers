<?php
/**
 * Created by PhpStorm.
 * User: Danuja Fernando
 * Date: 5/21/2018
 * Time: 9:53 PM
 */

namespace App\Http\Controllers;


trait Breadcrumbs
{
    public static $breadcrumb = array(array('Home','admin.home'));
}