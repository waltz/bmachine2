<?php

  /*****************************************************
  ** Title........: Function Collection
  ** Filename.....: functions.inc.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: mailto:info@stadtaus.com
  ** Version......: 0.3
  ** Notes........:
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
  ** Print debug messages
  *****************************************************/
          function debug_mode($msg, $desc = '') {
              global $debug_mode;

              if ($debug_mode == 'on' and !empty($msg)) {
                  if (!is_array($msg)) {
                      $msg = (array) $msg;
                  }

                  for($i = 0; $i < count($msg); $i++)
                  {
                      echo '<pre><strong>' . $desc . '</strong>' . "\n\n" . htmlspecialchars($msg[$i]) . '</pre>.............................................................................<br />';
                  }
              }
          }



          
  /*****************************************************
  ** Display server info
  *****************************************************/
          function get_phpinfo($msg = '', $param = '')
          {
              if (isset ($param['ap']) and $param['ap'] == 'phpinfo') {
                  $additional_content = '';
                  if (!empty($msg)) {
                      if (!is_array($msg)) {
                          $msg = (array) $msg;
                      }

                      while(list($key, $val) = each($msg))
                      {
                          $dots = '';

                          for($i = 1; $i <= 35 - strlen($key); $i++)
                          {
                              $dots .= '.';
                          }
                          $additional_content .= $key . $dots . $val . "\n";
                      }
                  }

                  ob_start();
                  phpinfo();
                  $php_information = ob_get_contents();
                  ob_end_clean();
                  echo preg_replace("/<body(.*?)>/i", '<body' . "$1" . '><pre style="color:#CFCFCF;">' . $additional_content . '</pre><br /><br />', $php_information);

                  exit;
              }
          }




  /*****************************************************
  ** Output script runtime
  *****************************************************/
          function script_runtime($runtime_start)
          {
              $runtime_end = explode (' ', microtime ());
              $runtime_difference = $runtime_end[1]     - $runtime_start[1];
              $runtime_summe      = $runtime_difference + $runtime_end[0];
              $runtime            = $runtime_summe      - $runtime_start[0];

              return $runtime;
          }




  /*****************************************************
  ** Print Array
  *****************************************************/
          function print_a($ar)
          {
              echo '<pre>';

              print_r($ar);

              echo '</pre>';
          }




/**
 * Get md5 hash of a file
 *
 */
function get_hash($get = '', $hash = '') 
{
    if (is_array($hash) and is_array($get)) {
        if (isset($get['ap']) and isset($hash[$get['ap']])) {
            echo md5(str_replace("\n", '', str_replace("\r", '', join('', file($hash[$get['ap']])))));
        }
    }
}





?>