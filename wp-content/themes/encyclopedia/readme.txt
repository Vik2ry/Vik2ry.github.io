Encyclopedia Wordpress Theme
Author: Denis Sureau - Scriptol.com 
License: GNU GPL 2.0. 
URL: Encyclopedia Theme 
Features
SEO-friendly. 
Flexible width (fluid, liquid). 
Minimum (800 pixels) and maximum (1280 pixels) width. 
Classic layout with two columns and menu to the left. 
Categories in tabs. Limited to 8, but may be changed. 
On the home are displayed the lists of last post by categories. 
List of recent articles below posts. 
Easy to tweak. 
In addition, a 8-page tutorial can help you understand how to modify a Wordpress theme.
Compatibility
The theme has been tested and works under:
All Firefox versions. 
Internet Explorer 8. 
Safari 4. 
Chrome 2. 
Opera 9. 
And more ... 
It should works under older browsers. 
Installing the theme
1. Extract the contents of the archive. 
2. Put your logo at root in the encyclopedia directory. 
3. Copy the encyclopedia directory into: 
wp-content/themes/
4. Go to the administration panel to activate this theme. 
How to replace the textual title by a logo
In this block in header.php: 
<div id="logo"  onclick="location.href='<?php echo home_url(); ?>/';">
  <?php bloginfo('name'); ?> <br>
  <span class="sitedesc"><?php bloginfo('description'); ?></span>  
</div>
Delete:
<?php bloginfo('name'); ?> <br>
<span class="sitedesc"><?php bloginfo('description'); ?></span>   
And in style.css, add thes lines into #logo
background-image: url(logo.jpg);
background-repeat:no-repeat; 
Tweaking the theme 
The theme is deliberately provided with all the possible elements to allow you to choose some.
Remove the elements that you do not want to keep inside sidebar.php, through the theme editor. 
It is advisable for SEO to remove the blogroll, the calendar. 
You can edit the style sheet (style.css) to change the minimum and maximum width, in the body descriptor. 
