<?php

  /*****************************************************
  ** Title........: Tell A Friend Script Language File (Arabic)
  ** Filename.....: language.ar.inc.php
  ** Author.......: Ralf Stadtaus
  ** Homepage.....: http://www.stadtaus.com/
  ** Contact......: mailto:info@stadtaus.com
  ** Version......: 0.2
  ** Notes........: If you have translated this language
  **                file we would be happy if you could
  **                send us the file.
  **
  ** Last changed.: 2004-03-03
  ** Last change..:
  ����� >>> translated by ALuNdErtAkEr >>>  MBC902@HOTMAIL.COM
  *****************************************************/
  
  /*******************REMOVE THIS AFTER YOU READING************************************
  ** Notice - if you want to add or change text, make sure you change arabic letters
  ** somewhere out of this file to Arabic(windows) or any other ANSI format, then add 
  ** it here. Also make sure you add this line to form.tpl.html file:
  ** <meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
  **   or
  ** <meta http-equiv="Content-Type" content="text/html; charset={txt_charset}" />
  ********************************************************************************/
  
    /******************* ��� ��� �������� ��� ������� *******************************
  **    ��� ���� �� ������ ��� ������� ������ �� ���� �������
  **    ���� �� ���� ������� ��� ������ ������� ���� ����� �����
  **    <meta http-equiv="Content-Type" content="text/html; charset={txt_charset}" />
  **    ��� �����
  **    <meta http-equiv="Content-Type" content="text/html; charset=windows-1256">
  ********************************************************************************/
  
  /* If you want to keep letters in utf-8 so they are readable here.. be aware
  ** then that characters other than english letters(ex. arabic letters) might not
  ** be readable in emails after being sent through the form. 
  ********************************************************************************/
  



  $txt = array (


                   'txt_content_direction'            => 'rtl',
                   'txt_charset'                      => 'windows-1256',
                   'txt_cannot_lock_file'             => '������ ��� ����� :',
                   'txt_cannot_open_file'             => '������ ��� ����� :',
                   'txt_comment'                      => '�������',
                   'txt_email'                        => '����� ����������',
                   'txt_fill_in'                      => '���� ����� ��������� ������� :',
                   'txt_firstname'                    => '����� �����',
                   'txt_friend_email'                 => '�����&nbsp;����&nbsp;�����',
                   'txt_friend_name'                  => '��� �����',
                   'txt_email_syntax'                 => '���� ������ �� �������� �������� �� ������ ������� :',
                   'txt_empty_referrer'               => '���� ����� ����� :(referring site)����.������ ����� �� ��� ��� ������� ��� ��� ���� ���� ������� ��� �� ������.',
                   'txt_ip_address_expiration'        => '��� ���� ��� ���� ������ �� ������� �������� ����� ����� ������� ���� ��� �������� . ��� ����� ������ ��������� ����� ������ �������.',
                   'txt_lastname'                     => '����� ������',
                   'txt_mandatory_fields'             => '���� ������',
                   'txt_multiple_friend_email_1'      => '���� �����#1',
                   'txt_multiple_friend_email_2'      => '���� �����#2',
                   'txt_multiple_friend_email_3'      => '���� �����#3',
                   'txt_multiple_friend_email_4'      => '���� �����#4',
                   'txt_multiple_friend_name_1'       => '��� �����#1',
                   'txt_multiple_friend_name_2'       => '��� �����#2',
                   'txt_multiple_friend_name_3'       => '��� �����#3',
                   'txt_multiple_friend_name_4'       => '��� �����#4',
                   'txt_no'                           => '��',
                   'txt_popen_error'                  => 'Function popen() error.',
                   'txt_preview'                      => '����',
                   'txt_problems'                     => '<p><strong>����� �� ������ȿ</strong> ���� ������� <a href="./docu/index.html" target="_blank">./docu/index.html</a></p><p> ������ ��� ����� �������<a href="http://www.stadtaus.com/forum/" target="_blank"> ����� ����� ����� </a> �� ������ ������ <a href="http://www.stadtaus.com/en/" target="_blank">Tell A Friend Script on STADTAUS.com</a>.</p>',
                   'txt_receive_information'          => '������ ������ �� ��������ʿ',
                   'txt_recipient_expiration'         => '��� ���� ��� ���� ������ �� ������� ����� ����� ������� ��� ��� ������� �������.',
                   'txt_required_firstname'           => '���� ����� ���� �����',
                   'txt_required_friend_email'        => '���� ����� ����� ���� �����',
                   'txt_required_sender_email'        => '���� ����� ����� �������.',
                   'txt_salutation'                   => 'Salutation',
                   'txt_script_name'                  => '���� ����',
                   'txt_send_homepage'                => '�� �� ���� ����� ������ �������ɿ',
                   'txt_send_referer'                 => '������ ��� ������',
                   'txt_sender_email'                 => '�����&nbsp;�����&nbsp;',
                   'txt_sender_expiration'            => '��� ���� ��� ���� ������ �� ������� ���� ����� ������� ���� ������� �������.',
                   'txt_set_off_note'                 => '<strong>������ :</strong>��� �������� �� ����� ������� ����� ��� ������ off ���� ����� ����� �� �������(index.php - <i>$show_error_messages</i>).',
                   'txt_subject'                      => '�������',
                   'txt_submit'                       => '�������',
                   'txt_subscribe_newsletter'         => '����� �� ������� �������ɿ',
                   'txt_syntax_email'                 => '���� ����� ����� ����� ����.',
                   'txt_system_message'               => '����� ������',
                   'txt_thank_you'                    => '����� ��...�� ����� ������ �����.',
                   'txt_vote'                         => '�� ����� ����� ���� ���޿',
                   'txt_welcome_text'                 => '��� ��� ���� ��� ���� ������� ��� ��� ������ ��� ����� ����� �� ���� ������� ������ ��� ������ ������� ��� ��������.',
                   'txt_wrong_html_template'          => '���� ������ ��� �� ����� index.php (<i>$file[\'default_html\']</i>) �� ��  &lt;input type=&quot;hidden&quot; name=&quot;html_template&quot; value=&quot;&quot; /&gt; ������ ������ ����. ���� ������ �� ����� ��� ����� ���� ����. ���� ����� ������ �� ���� �������.',
                   'txt_wrong_ip_address'             => '��� �������� ����� ������� ���� �� ����� ����� ! ��� ����� �� ������� ��� �������.',
                   'txt_wrong_mail_template'          => '���� ������ ��� �� ����� index.php (<i>$file[\'default_mail\']</i>) or in &lt;input type=&quot;hidden&quot; name=&quot;mail_template&quot; value=&quot;&quot; /&gt;  ������ ������ ����. ���� ������ �� ����� ��� ����� ���� ����. ���� ����� ������ �� ���� �������. ',
                   'txt_wrong_referrer'               => '���� ���� . ������ ����� �� ��� ��� ������� ��� �� ���� ����� ���� ����.',
                   'txt_wrong_referrer_admin'         => '<br /><br />����� ������� : ���� ����� ����� ����� �� ������� referrer �� ����� index.php .',
                   'txt_wrong_template_path'          => '������ ��� ������ ����� ������ ��� ����. ���� ����� ������ ������ �� �������<i>$path[\'templates\']</i> �� ����� index.php',
                   'txt_yes'                          => '���',
                   'txt_your_data'                    => '���� ������ :'



               );



?>
