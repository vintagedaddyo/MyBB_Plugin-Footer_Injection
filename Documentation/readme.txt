Footer Injection for MyBB
Version 1.0.1
---

Version History:

Updated to version 1.0.1 for usage with MyBB 1.8.x by Vintagedaddyo
- added language file
- plugin localization
- minor changes
- minor changes to dist pkg directory structure
- fixed to allow to load in all global pages as the plugin claimed but actually only loaded on index

Footer Injection for MyBB
Version 1.0.0
---
With help from http://mybbsource.com/thread-4003.html and http://www.astigtayo.com/Thread-How-to-Develop-a-MYBB-Plugin
Tested using http://www.icosaedro.it/phplint/phplint-on-line.html

Version History:  
1.0.0 - created

License:
This plugin is released under the GPL. See http://www.gnu.org/licenses/gpl.html

What it Does
------------
This plugin allows you to insert code in the footer of every page of your forum. For example, you may want to display a message or advertisement at the bottom of each page. Instead of having to manually edit the theme (and remember to do it each time you change or update themes), this plugin inserts the code regardless of what theme you are using.

How to Install
--------------
Open the archive and upload the plugin file (FooterInjectionForMyBB.php) to inc\plugins in your forum folder (via FTP or your web host's control panel). Ex: If your forum folder is http://www.yoursite.com/forum, then the plugin file should be uploaded to http://www.yoursite.com/forum/inc/plugins.

Go to Configuration >> Plugins and look for the "Footer Injection For MyBB" entry. Click "Activate."

Go to Configuration >> Settings and look for the "Footer Injection For MyBB" entry. Enter the code you want to insert in the footer section of your forum. For example, ad code, a message box or list of links. No PHP or MyBB template codes.

How to Uninstall
----------------
Go to Configuration >> Plugins and look for the "Footer Injection For MyBB" entry. Click "Deactivate." Then delete the plugin file from the inc\plugins folder. If you deactivate or uninstall the plugin, all settings will be removed. If you reactivate or reinstall the plugin, you will need to re-enter all settings.