<?php

  /*****************************************************
  ** Title........: Tell A Friend Script
  ** Filename.....: index.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.4 
  ** Notes........: This file contains the configuration 
  ** Last changed.: 
  ** Last change..:
  *****************************************************/

  /*****************************************************
  **
  ** THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY
  ** OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
  ** LIMITED   TO  THE WARRANTIES  OF  MERCHANTABILITY,
  ** FITNESS    FOR    A    PARTICULAR    PURPOSE   AND
  ** NONINFRINGEMENT.  IN NO EVENT SHALL THE AUTHORS OR
  ** COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES
  ** OR  OTHER  LIABILITY,  WHETHER  IN  AN  ACTION  OF
  ** CONTRACT,  TORT OR OTHERWISE, ARISING FROM, OUT OF
  ** OR  IN  CONNECTION WITH THE SOFTWARE OR THE USE OR
  ** OTHER DEALINGS IN THE SOFTWARE.
  **
  *****************************************************/





  /*****************************************************
  ** Script configuration - for a documentation of the
  ** following variables please take a look at the
  ** documentation file in the 'docu' directory.
  *****************************************************/
          $script_root           = './';

          $referring_server      = 'www.getdemocracy.com';
          $allow_empty_referer   = 'yes';       // (yes, no)

          $language              = 'en';       // (see folder 'languages')

          $ip_banlist            = '';


          $sender_count          = '0';
          $sender_duration       = '24';

          $recipient_count       = '0';
          $recipient_duration    = '48';

          $ip_address_count      = '0';
          $ip_address_duration   = '48';

          $show_limit_errors     = 'yes';     // (yes, no)

          $log_messages          = 'no';     // (yes, no)

          $text_wrap             = '65';

          $show_error_messages   = 'yes';     // (yes, no)

          $path['logfile']       = $script_root . 'log/logfile.txt';
          $path['templates']     = $script_root . 'templates/';

          $file['default_html']  = 'form.tpl.html';
          $file['default_mail']  = 'mail.tpl.txt';


  /*****************************************************
  ** Add further words, text, variables and stuff
  ** that you want to appear in the template here.
  *****************************************************/
          $add_text = array(

                              'txt_additional' => 'Additional', //  {txt_additional}
                              'txt_more'       => 'More'        //  {txt_more}

                            );




  /*****************************************************
  ** Do not edit below this line - Ende der Einstellungen
  *****************************************************/









  

  
  
  
  /*****************************************************
  ** Send safety signal to included files
  *****************************************************/
          define('IN_SCRIPT', 'true');




  /*****************************************************
  ** Load tell a friend script code
  *****************************************************/
          include $script_root . 'inc/tell_a_friend.inc.php';




?>