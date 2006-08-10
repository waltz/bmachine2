<?php

  /**
   * Title........: Form Mail Script
   * Filename.....: formmail.class.inc.php
   * Author.......: Ralf Stadtaus
   * Homepage.....: http://www.stadtaus.com/
   * Contact......: http://www.stadtaus.com/forum/
   * Version......: 1.6 
   * Notes........: 
   * Last changed.: 2004-12-30 
   * Last change..:
   */
  
  /**
   * 
   * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY 
   * OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
   * LIMITED   TO  THE WARRANTIES  OF  MERCHANTABILITY,
   * FITNESS    FOR    A    PARTICULAR    PURPOSE   AND 
   * NONINFRINGEMENT.  IN NO EVENT SHALL THE AUTHORS OR 
   * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES 
   * OR  OTHER  LIABILITY,  WHETHER  IN  AN  ACTION  OF 
   * CONTRACT,  TORT OR OTHERWISE, ARISING FROM, OUT OF 
   * OR  IN  CONNECTION WITH THE SOFTWARE OR THE USE OR 
   * OTHER DEALINGS IN THE SOFTWARE.
   * 
   */




  /**
   *
   */
  class Formmail
  {

      var $error_template;
      var $new_html_template;
      var $all_content;
      var $replace_content;
      var $environment;
      var $wrap_content;
      var $mail_content;
      var $mail_headers;
      var $multiple;
      var $selection_content;
      var $control_fields;
      var $table_start;
      var $table_end;
      var $hide_empty_fields;




          /**
           * Initialize some settings
           */
                  function Formmail() 
                  {                              
                      $this->hide_empty_fields  = 'no'; // yes/no                    
                      $this->table_start        = '<table border="0" cellpadding="2" cellspacing="1">';
                      $this->table_end          = '</table>';
                      $this->multiple           = 'multiple';
                      $this->mail_headers   = array(    'From:', 
                                                        'Content-Type:', 
                                                        'Content-Transfer-Encoding:', 
                                                        'Cc:', 
                                                        'Bcc:', 
                                                        'Reply-To:', 
                                                        'X-Mailer:', 
                                                        'MIME-Version:', 
                                                        'User-Agent:', 
                                                        'Sender:', 
                                                        'X-Envelope-From:', 
                                                        'X-Envelope-To:', 
                                                        'Envelope-To:', 
                                                        'X-Sender:', 
                                                        'Content-Return:', 
                                                        'Disposition-Notification-Options:', 
                                                        'Disposition-Notification-To:', 
                                                        'Errors-To:', 
                                                        'Return-Receipt-To:', 
                                                        'Read-Receipt-To:', 
                                                        'X-Confirm-reading-to:', 
                                                        'Followup-To:', 
                                                        'Original-Recipient:', 
                                                        'In-Reply-To:', 
                                                        'Priority:', 
                                                        'Sensitivity:', 
                                                        'Encoding:', 
                                                        'boundary=', 
                                                        'Return-path:');
                      $this->control_fields = array('thanks', 'required_fields', 'email_fields', 'html_template', 'mail_template');                              
                  }




          /**
           * Check referring server(s)
           */
                  function check_referer($referring_server)
                  {
                      global $txt, $allow_empty_referer, $show_error_messages;
                      
                      $referer_string   = getenv('HTTP_REFERER');
                      $referer_content  = parse_url($referer_string);
                      $referers_message = '';
                      
                      if ($allow_empty_referer != 'yes' and empty($referer_string)) {
                          return array('message' => $txt['txt_empty_referrer'], 'fields' => '');
                      }
                      

                      if (isset($referring_server)) {
                          $referers_check = explode (',', $referring_server);
                          $referers_message = '';

                          if (isset($referer_content['host']) and !empty($referer_content['host'])) {

                              for ($i = 0; $i < count ($referers_check); $i++)
                              {
                                  if (strtolower(trim($referers_check[$i])) == strtolower($referer_content['host'])) {
                                      $referers_message = 'true';
                                  }
                              }

                              if ($referers_message != 'true' and isset ($referring_server) and !empty ($referring_server)) {
                                  $error_message = $txt['txt_wrong_referrer'];
                                  
                                  if ($show_error_messages == 'yes') {
                                      $error_message .= ' ' . $txt['txt_wrong_referrer_admin'] . ' ' . $referer_content['host'];
                                  }
                                  
                                  return array('message' => $error_message, 'fields' => '');
                              }
                              
                          }
                      }
                  }




          /**
           * Check template path
           */
                  function check_template_path($path)
                  {
                      global $txt;

                      if (!is_dir($path)) {
                          return array('message' => $txt['txt_wrong_template_path']);
                      }
                  }




          /**
           * Check required fields
           */
                  function check_required_fields($required_fields, $data)
                  {
                      global $txt;

                      $check_required_fields = explode(',', $required_fields);
                      reset ($check_required_fields);
                      $err_msg = '';

                      while (list ($key, $val) = each ($check_required_fields))
                      {
                          $val = trim($val);

                          if (empty($txt['txt_' . $val])) {
                              $txt['txt_' . $val] = $val;
                          }

                          if (empty ($data[$val])) {
                              $err_msg .= $txt['txt_' . $val] . '<br />';
                          }
                      }

                      if (!empty($err_msg)) {
                          return $err_msg;
                      }
                  }
                  
                  
                  function check_required_fields_array($required_fields, $data)
                  {

                      $check_required_fields = explode(',', $required_fields);
                      reset ($check_required_fields);

                      while (list ($key, $val) = each ($check_required_fields))
                      {
                          $val = trim($val);

                          if (empty ($data[$val])) {
                              $fields[] = $val;
                          }
                      }

                      if (!empty($fields)) {
                          return $fields;
                      }
                  }




          /**
           * Check required fields
           */
                  function check_email_fields($email_fields, $data)
                  {
                      global $txt;

                      $check_email_fields = explode(',', $email_fields);
                      reset ($check_email_fields);
                      $err_msg = '';

                      while (list ($key, $val) = each ($check_email_fields))
                      {
                          $val = trim($val);

                          if (!empty ($data[$val]) and !preg_match("/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@([0-9a-z][0-9a-z-]*[0-9a-z]\.)+([a-z]{2,4}|museum)$/i", $data[$val])) {
                              if (empty($txt['txt_' . $val])) {
                                  $txt['txt_' . $val] = $val;
                              }
                              $err_msg .= $txt['txt_' . $val] . '<br />';
                          }
                      }

                      if (!empty($err_msg)) {
                          return $err_msg;
                      }
                  }
                  
                  
                  function check_email_fields_array($email_fields, $data)
                  {
                      global $txt;

                      $check_email_fields = explode(',', $email_fields);
                      reset ($check_email_fields);

                      while (list ($key, $val) = each ($check_email_fields))
                      {
                          $val = trim($val);

                          if (isset($data[$val]) and !empty($data[$val]) and !preg_match("/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@([0-9a-z][0-9a-z-]*[0-9a-z]\.)+([a-z]{2,4}|museum)$/i", $data[$val])) {
                              $fields[] = $val;
                          }
                      }

                      if (!empty($fields)) {
                          return $fields;
                      }
                  }




          /**
           * Check whether the user is allowed to send e-mails
           * based on the sender or recipient e-mail address
           */
                  function check_value_limit($check_value, $count, $duration, $field, $err_msg)
                  {
                      global $path;

                      if (!empty($count) and $count > 0) {
                          if (is_file ($path['logfile'])) {

                              $check  = '';
                              $limit_errors_flag = '';

                              $read_logfile = fopen ($path['logfile'], "r");

                              while ($line = fgets($read_logfile, 4096))
                              {
                                  $data = explode('%%', $line);

                                  if ($check_value == trim($data[$field]) and $data[1] > mktime()-$duration*60*60) {
                                      $check++;
                                  }
                              }
                              fclose ($read_logfile);


                              if ($count > 0 and !empty ($count) and $check >= $count) {
                                  return $err_msg;
                              }
                          }
                      }
                  }




          /**
           * Generate array that contains all form data except
           * the control fields (hidden form fields).
           */
                  function generate_all_content($data)
                  {
                      $match_content  = implode('|', $this->control_fields);
                      $match_content  = "/$match_content/i";
                              $all_content          = array();                              
                      $all_content_table[] = $this->table_start;

                      while(list($key, $val) = each($data))
                      {
                                  if (preg_match($match_content, $key) > 0) {
                                      continue;
                                  }
                                  
                                  if ($this->hide_empty_fields == 'yes' and $val == '') {
									  continue;
                                  }
                                  
                                  $all_content[]       = $key . ': ' . $val;
                                  $all_content_table[] = '<tr><td>' . $key . '</td><td>' . nl2br($val) . '</td></tr>';
                              }
                      
                      $all_content_table[] = $this->table_end;
                      
                      $content = array('all_content'       => join("\n", $all_content),
                                       'all_content_table' => join("\n", $all_content_table));

                      return $content;
                  }




          /**
           * Generate array that contains all form data field
           * names and their counterpart variables ({...}).
           */
                  function generate_form_variables($data, $txt)
                  {
                      $match_content  = implode('|', $this->control_fields);
                      $match_content  = "/$match_content/i";
                      $form_variables = '';

                      while(list($key, $val) = each($data))
                      {
                          if (!preg_match($match_content, $key)) {
                              
                              if (isset($txt['txt_' . $key])) {
                                  $my_key = $txt['txt_' . $key];
                              } else {
                                  $my_key = $key;
                              }
                              
                              $form_variables .= $my_key . ': {' . $key . "}\n";
                          }
                      }

                      return $form_variables;
                  }




          /**
           * Replace placeholders with string or array values
           * replace_values( string subject, mixed replacement 
           * variable name)
           */
          function replace_values($content, $values)
          {
              global ${$values};

              $this->replace_content = $content;

              if (is_array(${$values})) {
                  reset(${$values});

                  while (list ($key, $val) = each(${$values}))
                  {
                      $this->replace_content = preg_replace('#\{(checkbox:|select:|radiobutton:|)' . preg_quote($key, '#') . '\}#', preg_quote($val, '#'), $this->replace_content);
                  }

              } else if (is_string(${$values})) {
                  $this->replace_content = preg_replace('#\{(checkbox:|select:|radiobutton:|)' . preg_quote($values, '#') . '\}#', preg_quote(${$values}, '#'), $this->replace_content);
              }

              return $this->replace_content;
          }




          /**
           * Remove unselected cheboxes and radio buttons from
           * template.
           */
          function remove_values($content)
          {
              $this->replace_content = preg_replace('#\{(checkbox|select|radiobutton):(.*?)\}#', '', $content);

              return $this->replace_content;
          }




          /**
           * Generate environment variables
           */
                  function get_environment_var($input)
                  {
                      $time = explode(' ', date("Y m d H i s", mktime()));

                      $this->environment = array(

                                              'env_user_agent'     => $input['HTTP_USER_AGENT']
                                             ,'env_remote_address' => $input['REMOTE_ADDR']
                                             ,'env_remote_host'    => @gethostbyaddr($input['REMOTE_ADDR'])

                                             ,'env_year'           => $time[0]
                                             ,'env_month'          => $time[1]
                                             ,'env_day'            => $time[2]
                                             ,'env_hour'           => $time[3]
                                             ,'env_minute'         => $time[4]
                                             ,'env_second'         => $time[5]

                                             ,'env_iso_date'       => $time[0] . '-' . $time[1] . '-' . $time[2] . ' (' . $time[3] . ':' . $time[4] . ':' . $time[5] . ')'


                                           );

                      return $this->environment;
                  }




          /**
           * In case $text_wrap contains a value and that value
           * consists only on numbers wrap the text.
           * text_wrap(string str, int width [, string break])
           */
          function wrap_content($content, $width, $break = "\n")
          {
              $this->wrap_content = $content;

              if (isset($width) and !empty($width) and preg_match("/^[0-9]+$/", $width)) {
                  $this->wrap_content = wordwrap($this->wrap_content, $width, $break);
              }

              return $this->wrap_content;
          }




    /**
     * 
     */
    function validate_to($content)
    {
        $header_info = explode("\n", $content);
    
        for($k = 0; $k < count($header_info); $k++)
        {
            $clean_header = trim($header_info[$k]);
            if (empty($clean_header)) {
                break;
            }
                          
            if (preg_match("/To:/i", $header_info[$k])) {
                $mail_recipient = trim(preg_replace("/To:/i", '', $header_info[$k]));
            }
        }
        
        if (!isset($mail_recipient)) {
            return false;
        }
        
        if (preg_match("/[a-z0-9_-]+(\.[a-z0-9_-]+)*@([0-9a-z][0-9a-z-]*[0-9a-z]\.)+([a-z]{2,10})/i", $mail_recipient)) {
            return true;
        }
        
        return false;
    }




    /**
     * 
     */
    function collect_multiples($fields)
    {
        if (!empty($fields) and is_array($fields)) {
            while (list($key, $val) = each($fields))
            {
                if (preg_match("#^" . $this->multiple . "_(.*?)_([0-9])$#i", $key, $matches) > 0) {
                    if (isset($matches[2]) and is_numeric($matches[2])) {
                        $multiple[$matches[2]][$matches[1]] = $val;
                    }
                }
            }
        }
        
        if (!isset($multiple)) {
            $multiple = array();
        }
        
        return $multiple;
    }




    /**
     * 
     */
    function replace_multiples($content, $values)
    {
        for ($i = 0; $i < count($content); $i++)
        {
            if (is_array($values)) {
                reset($values);
    
                while (list ($key, $val) = each($values))
                {
                    $temp_content = $content[$i];
                    
                    while (list ($k, $v) = each($val))
                    {
                        $temp_content = preg_replace('#\{(checkbox:|select:|radiobutton:|)' . $this->multiple . '_' . $k . '_\?\}#', '{' . $this->multiple . '_' . $k . '_' . $key . '}', $temp_content);
                    }
                    $new_content[] = $temp_content;
                }
            }
        }

        if (isset($new_content)) {
            return $new_content;
        } else {
            return $content;
        }
    }




          /**
           * Replace placeholders in mail templates and send
           * e-mails.
           */
          function send_mail($mail_content, $post_data = '')
          {
              global $text_wrap, $my_sendmail, $send_alternative_mail, $all_content, $debug_mode, $sender_count, $sender_duration, $recipient_count, $recipient_duration, $txt, $remove_tags, $tplt, $all_content_table;

              $multiple     = $this->collect_multiples($post_data);
              $mail_content = $this->replace_multiples($mail_content, $multiple);

              for ($i = 0; $i < count($mail_content); $i++)
              {


                  /**
                   * Replace placeholder with form, text (from language
                   * file) and environment data
                   */
                  $mail_content[$i] = $this->replace_values($mail_content[$i], 'post_data');
                  
                  
                  $mail_content[$i] = $this->replace_values($mail_content[$i], 'txt');
                  
                  
                  $mail_content[$i] = $this->replace_values($mail_content[$i], 'add_text');


                  $mail_content[$i] = $this->replace_values($mail_content[$i], 'environment');


                  $mail_content[$i] = $this->replace_values($mail_content[$i], 'all_content');
                  
                  
                  $mail_content[$i] = $this->replace_values($mail_content[$i], 'all_content_table');


                  $mail_content[$i] = $this->replace_values($mail_content[$i], 'form_variables');


                  $mail_content[$i] = $this->replace_values($mail_content[$i], 'url');




                  /**
                   * Remove unselected value placeholders
                   */
                  $mail_content[$i] = $this->remove_values($mail_content[$i]);




                  /**
                   * Remove tags
                   */
                  // $mail_content[$i] = $this->clean_output($mail_content[$i], $remove_tags);





                  /**
                   * Strip slashes
                   */
                  $final_mail_content = stripslashes($mail_content[$i]);
                  
                  if ($this->validate_to($final_mail_content) == false) {
                    continue;
                  }


                  /**
                   * Check whether the user is allowed to send e-mails
                   * with or to a certain e-mail address.
                   */
                  if ($tplt == 'recom') {
                      $sender    = $this->get_header_info($mail_content[$i], 'From');
                      $recipient = $this->get_header_info($mail_content[$i], 'To');

                      if ($limit = $this->check_value_limit($sender, $sender_count, $sender_duration, 4, $txt['txt_sender_expiration'])) {
                          $message[] = array('message' => $limit, 'fields' => '');
                      }

                      if ($limit = $this->check_value_limit($recipient, $recipient_count, $recipient_duration, 5, $txt['txt_recipient_expiration'])) {
                          $message[] = array('message' => $limit, 'fields' => '');
                      }

                      if (isset($message) and !empty($message)) {
                          return array('status' => 'failed', 'message' => $message);
                      }
                  }




                  /**
                   * Get sendmail path from php ini settings or use the
                   * value of $my_sendmail.
                   */
                  if ($send_alternative_mail != 'yes') {

                      $sendmail = @ini_get('sendmail_path');

                      debug_mode($sendmail, 'ini_get()');


                      if (empty($sendmail)) {
                          $sendmail = "/usr/sbin/sendmail -t ";
                          debug_mode($sendmail, 'empty($sendmail)');
                      }



                      if (isset($my_sendmail) and !empty($my_sendmail)) {
                          $sendmail = $my_sendmail;
                          debug_mode(array('$my_sendmail', $sendmail));
                      }




                      /**
                       * Try to send e-mail by using popen() to access
                       * sendmail.
                       */
                      if ($fd = @popen($sendmail, "w")) {
                          if (!@fputs($fd, $final_mail_content . "\n")) {
                              $send_alternative_mail = 'yes';
                              debug_mode(array($txt['txt_popen_error'] . ' - fputs()', gettype($fd), $fd));
                          }
                          pclose($fd);
                      } else {
                          $send_alternative_mail = 'yes';
                          debug_mode(array($txt['txt_popen_error'] . ' - popen()', gettype($fd), $fd));
                      }

                      debug_mode($final_mail_content, 'Mail Content popen()');
                  }




                  /**
                   * If popen() - or fputs() - fails, extract mail
                   * header from the template and use the PHP  function
                   * mail().
                   */
                  if ($send_alternative_mail == 'yes') {

                      $header_info = explode("\n", $final_mail_content);
                      $mail_subject = '';
                      $mail_header = $this->mail_headers;
                      $mail_header = join($mail_header, '|');
                      
                      unset($additional_headers);


                      for($k = 0; $k < count($header_info); $k++)
                      {
                          $clean_header = trim($header_info[$k]);
                          if (empty($clean_header)) {
                              break;
                          }
                          
                                                  if (preg_match("/^From:/i", $header_info[$k])) {
                                                      $mail_from = trim(preg_replace("/From:/i", '', $header_info[$k]));
                                                  }
                                                  
                                                  if (preg_match("/^To:/i", $header_info[$k])) {
                                                      $mail_recipient = trim(preg_replace("/^To:/i", '', $header_info[$k]));
                              unset($header_info[$k]);
                              continue;
                          }

                                                  if (preg_match("/^Subject:/i", $header_info[$k])) {
                                                      $mail_subject = trim(preg_replace("/^Subject:/i", '', $header_info[$k]));
                              unset($header_info[$k]);
                              continue;
                          }

                                                  if (preg_match("/^" . $mail_header . "/i", $header_info[$k])) {
                              $additional_headers[] = $header_info[$k];
                              unset($header_info[$k]);
                              continue;
                          }
                      }
                      
                      
                      if (isset($header_info) and is_array($header_info)) {
                          $new_mail_content = trim(implode($header_info, "\n"));
                          $new_mail_content = str_replace("\r", '', $new_mail_content);
                      } else {
                          $new_mail_content = '';
                      }
                      
                      
                      if (isset($additional_headers) and is_array($additional_headers)) {
                          $additional_headers = implode($additional_headers, "\n");
                      } else {
                          $additional_headers = '';
                      }


                          
                          
                      /**
                       * Wrap mail content (and only mail content - not
                       * headers).
                       */
                      $new_mail_content = $this->wrap_content($new_mail_content, $text_wrap);
                      

                              
                              
                      if ($debug_mode != 'on' and $mail_recipient != '') {
                          @mail($mail_recipient, $mail_subject, $new_mail_content, $additional_headers);
                      }
                      

                      debug_mode($mail_recipient, 'Mail Recipient mail()');
                      debug_mode($mail_subject, 'Mail Subject mail()');
                      debug_mode($new_mail_content, 'Mail Content mail()');
                      debug_mode($additional_headers, 'Mail Additional Headers mail()');
                      
                  }


              }

              $this->mail_content = $mail_content[0];

              return array('status' => 'ok', 'mail_content' => $this->mail_content);
          }
                
                



          /**
           * Write entry in log file - logfile format: IP - Unix timestamp - date - time - sender - recipient - mail content
           */
                  function log_message($mail_content)
                  {
                      global $log_messages, $ip_address_count, $path, $txt, $tplt, $sender_count, $recipient_count;

                      $message_sender    = $this->get_header_info($mail_content, 'From');
                      $message_recipient = $this->get_header_info($mail_content, 'To');

                      if ($log_messages == 'yes' or $ip_address_count > 0 or ($tplt == 'recom' and ($sender_count > 0 or $recipient_count > 0))) {
                          if ($logfile = @fopen($path['logfile'], 'a')) {
                              @flock($logfile, 2) or debug_mode($txt['txt_cannot_lock_file'] . $path['logfile']);
                              $current_time =  mktime();
                              $logfile_content = array(getenv('REMOTE_ADDR'), $current_time, date ("Y-m-d", $current_time), date("H:i:s", $current_time), $message_sender, $message_recipient, str_replace ("\n", ' ', str_replace ("\r", '', $mail_content)));
                              $logfile_content = join('  %%  ', $logfile_content);
                              @fputs  ($logfile, $logfile_content . "\n");
                              @fclose ($logfile);
                          } else {
                               debug_mode($path['logfile'], $txt['txt_cannot_open_file']);
                          }
                      }
                  }




          /**
           * Get mail header information
           */
                  function get_header_info($mail_content, $header)
                  {
                      preg_match("#" . $header . ":(.*?)<(.*?)>#i", $mail_content, $match);

                      if (!isset($match[2]) or empty($match[2])) {
                          preg_match("#" . $header . ":(.*?)\n#i", $mail_content, $match);
                          $match = $match[1];
                      } else {
                          $match = $match[2];
                      }

                      return trim($match);
                  }




          /**
           * Check selected checkboxes, radio buttons and select
           * menu options and replace values in template.
           */
          function register_selections($content, $data = '')
          {
              if (isset($data) and !empty($data)) {
                  reset($data);
                  
                  while(list($key, $val) = each($data))
                  {
                    
    
                      /**
                       * Check selected checkboxes, radio buttons and select
                       * menu options.
                       */                                      
                      $content = preg_replace("#\{checkbox:" . preg_quote($key, '#') . "=" . preg_quote($val, '#') . "\}#i", 'checked="checked"', $content);
                      $content = preg_replace("#\{radiobutton:" . preg_quote($key, '#') . "=" . preg_quote($val, '#') . "\}#i", 'checked="checked"', $content);
                      $content = preg_replace("#\{select:" . preg_quote($key, '#') . "=" . preg_quote($val, '#') . "\}#i", 'selected="selected"', $content);

    
                      /**
                       * Replace values in template.
                       */                                      
                      $content = preg_replace("#\{checkbox:" . preg_quote($key, '#') . "\}#i", preg_quote($val, '#'), $content);
                      $content = preg_replace("#\{radiobutton:" . preg_quote($key, '#') . "\}#i", preg_quote($val, '#'), $content);
                      $content = preg_replace("#\{select:" . preg_quote($key, '#') . "\}#i", preg_quote($val, '#'), $content);
                            
                              
                  }
              }

              $content = preg_replace("#\{checkbox:(.*?)\}#i", '', $content);
              $content = preg_replace("#\{radiobutton:(.*?)\}#i", '', $content);
              $content = preg_replace("#\{select:(.*?)\}#i", '', $content);

              $selection_content = stripslashes($content);

              return $selection_content;
          }




          /**
           * Check for banned ip addresses
           */
                  function check_banned_ip_addresses($ip_banlist)
                  {
                      global $txt;

                      if (isset($ip_banlist)) {
                          $banned_ip_addresses = explode (',', $ip_banlist);
                          $ip_message = '';

                          $current_user_ip_address = getenv('REMOTE_ADDR');

                          for ($i = 0; $i < count ($banned_ip_addresses); $i++)
                          {
                              if (trim($banned_ip_addresses[$i]) == $current_user_ip_address) {
                                  $ip_message = 'true';
                              }
                          }
                      }


                      if ($ip_message == 'true' and isset($ip_banlist) and !empty ($ip_banlist)) {
                          return $txt['txt_wrong_ip_address'];
                      }

                  }




          /**
           * Clean form output
           */
                  function clean_output($content, $remove_tags)
                  {
                      if (isset($remove_tags[0]) and $remove_tags[0] == 'yes') {
                          if (isset($remove_tags[1])) {
                              $content = str_replace('-', '%%+_+%%', $content);
                              $content = strip_tags($content, $remove_tags[1]);
                              $content = str_replace('%%+_+%%', '-', $content);
                          }
                      }
        
                      return $content;
                  }




          /**
           * Error HTML content
           */
                  function load_error_template()
                  {
                      $this->error_template = '<?xml version="1.0"?>
<!doctype html public "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
                                                          <head>
                                                            <title>{txt_script_name} {txt_script_version}</title>
                                                            <meta http-equiv="Content-Type" content="text/html; {txt_charset}" />
                                                          </head>

                                                          <style type="text/css">
                                                          <!--
                                                            h4 {
                                                                font-family:Courier New,Sans-serif;
                                                                }

                                                            p, td, br, form, div, span {
                                                                font-family:Courier New,Sans-serif;
                                                                font-size:9.5pt;
                                                                }

                                                            .code {
                                                                font-family:Courier New,Sans-serif;
                                                                }

                                                            .code strong {
                                                                color:#FF9F00;
                                                                }

                                                            #poweredby {
                                                                text-align:center;
                                                                }

                                                            #poweredby span {
                                                                font-family:Arial,Helvetica,Sans-serif;
                                                                }


                                                          -->
                                                          </style>

                                                          <body>

                                                          <p class="code"><strong>{txt_system_message}</strong></p>
                                                          <LOOP NAME="system_message">
                                                            <p class="code">{message}<br /><br /><br /></p>
                                                          </LOOP NAME="system_message">



                                                          <p>&nbsp;</p>
                                                          <p>&nbsp;</p>


                                                        </body>
                                                        </html>

                                                  ';

                      return $this->error_template;
                  }


  }




?>