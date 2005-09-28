<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Contains the Pager class
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   HTML
 * @package    Pager
 * @author     Lorenzo Alberton <l dot alberton at quipo dot it>
 * @author     Richard Heyes <richard@phpguru.org>
 * @copyright  2003-2005 Lorenzo Alberton, Richard Heyes
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    CVS: $Id: pager.php,v 1.3 2005/08/31 17:55:02 mitchc2 Exp $
 * @link       http://pear.php.net/package/Pager
 */

/**
 * Pager - Wrapper class for [Sliding|Jumping]-window Pager
 * Usage examples can be found in the PEAR manual
 *
 * @category   HTML
 * @package    Pager
 * @author     Lorenzo Alberton <l dot alberton at quipo dot it>
 * @author     Richard Heyes <richard@phpguru.org>,
 * @copyright  2003-2005 Lorenzo Alberton, Richard Heyes
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @link       http://pear.php.net/package/Pager
 */
class Pager
{
    // {{{ Pager()

    /**
     * Constructor
     *
     * -------------------------------------------------------------------------
     * VALID options are (default values are set some lines before):
     *  - mode       (string): "Jumping" or "Sliding"  -window - It determines
     *                         pager behaviour. See the manual for more details
     *  - totalItems (int):    # of items to page.
     *  - perPage    (int):    # of items per page.
     *  - delta      (int):    # of page #s to show before and after the current
     *                         one
     *  - linkClass  (string): name of CSS class used for link styling.
     *  - append     (bool):   if true pageID is appended as GET value to the
     *                         URL - if false it is embedded in the URL
     *                         according to "fileName" specs
     *  - httpMethod (string): Specifies the HTTP method to use. Valid values
     *                         are 'GET' or 'POST'
     *                         according to "fileName" specs
     *  - importQuery (bool):  if true (default behaviour), variables and
     *                         values are imported from the submitted data
     *                         (query string) and used in the generated links
     *                         otherwise they're ignored completely
     *  - path       (string): complete path to the page (without the page name)
     *  - fileName   (string): name of the page, with a %d if append=true
     *  - urlVar     (string): name of pageNumber URL var, for example "pageID"
     *  - altPrev    (string): alt text to display for prev page, on prev link.
     *  - altNext    (string): alt text to display for next page, on next link.
     *  - altPage    (string): alt text to display before the page number.
     *  - prevImg    (string): sth (it can be text such as "<< PREV" or an
     *                         <img/> as well...) to display instead of "<<".
     *  - nextImg    (string): same as prevImg, used for NEXT link, instead of
     *                         the default value, which is ">>".
     *  - separator  (string): what to use to separate numbers (can be an
     *                         <img/>, a comma, an hyphen, or whatever.
     *  - spacesBeforeSeparator
     *               (int):    number of spaces before the separator.
     *  - firstPagePre (string):
     *                         string used before first page number (can be an
     *                         <img/>, a "{", an empty string, or whatever.
     *  - firstPageText (string):
     *                         string used in place of first page number
     *  - firstPagePost (string):
     *                         string used after first page number (can be an
     *                         <img/>, a "}", an empty string, or whatever.
     *  - lastPagePre (string):
     *                         similar to firstPagePre.
     *  - lastPageText (string):
     *                         similar to firstPageText.
     *  - lastPagePost (string):
     *                         similar to firstPagePost.
     *  - spacesAfterSeparator
     *               (int):    number of spaces after the separator.
     *  - firstLinkTitle (string):
     *                          string used as title in <link rel="first"> tag
     *  - lastLinkTitle (string):
     *                          string used as title in <link rel="last"> tag
     *  - prevLinkTitle (string):
     *                          string used as title in <link rel="prev"> tag
     *  - nextLinkTitle (string):
     *                          string used as title in <link rel="next"> tag
     *  - curPageLinkClassName
     *               (string): name of CSS class used for current page link.
     *  - clearIfVoid(bool):   if there's only one page, don't display pager.
     *  - extraVars (array):   additional URL vars to be added to the querystring
     *  - excludeVars (array): URL vars to be excluded in the querystring
     *  - itemData   (array):  array of items to page.
     *  - useSessions (bool):  if true, number of items to display per page is
     *                         stored in the $_SESSION[$_sessionVar] var.
     *  - closeSession (bool): if true, the session is closed just after R/W.
     *  - sessionVar (string): name of the session var for perPage value.
     *                         A value != from default can be useful when
     *                         using more than one Pager istance in the page.
     *  - pearErrorMode (constant):
     *                         PEAR_ERROR mode for raiseError().
     *                         Default is PEAR_ERROR_RETURN.
     * -------------------------------------------------------------------------
     * REQUIRED options are:
     *  - fileName IF append==false (default is true)
     *  - itemData OR totalItems (if itemData is set, totalItems is overwritten)
     * -------------------------------------------------------------------------
     *
     * @param mixed $options    An associative array of option names and
     *                          their values.
     * @access public
     */
    function Pager($options = array())
    {
        //this check evaluates to true on 5.0.0RC-dev,
        //so i'm using another one, for now...
        //if (version_compare(phpversion(), '5.0.0') == -1) {
        if (get_class($this) == 'pager') { //php4 lowers class names
            // assign factoried method to this for PHP 4
            eval('$this = Pager::factory($options);');
        } else { //php5 is case sensitive
            $msg = 'Pager constructor is deprecated.'
                  .' You must use the "Pager::factory($params)" method'
                  .' instead of "new Pager($params)"';
            trigger_error($msg, E_USER_ERROR);
        }
    }

    // }}}
    // {{{ factory()

    /**
     * Return a pager based on $mode and $options
     *
     * @param  array $options Optional parameters for the storage class
     * @return object Object   Storage object
     * @static
     * @access public
     */
    function &factory($options = array())
    {
        $mode = (isset($options['mode']) ? ucfirst($options['mode']) : 'Jumping');
        $classname = 'Pager_' . $mode;

	//        $classfile = 'Pager' . DIRECTORY_SEPARATOR . $mode . '.php';

				// cjm - this is a hack until we can get away from this upper/lowercase issue
				if ( file_exists("Sliding.php") ) {
					require_once "Sliding.php";
	        $classfile = 'Sliding.php';
				}
				else {
					require_once "sliding.php";				
	        $classfile = 'sliding.php';
				}

//        $classfile = $mode . '.php';
//        require_once $classfile;

        $pager =& new $classname($options);
        return $pager;
    }

    // }}}
}
?>