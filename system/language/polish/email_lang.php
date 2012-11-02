<?php
/**
 * CodeIgniter Polish language pack
 *
 * @package		CodeIgniter
 * @author		patwork@gmail.com (originally sin@sinsoft.pl)
 * @license		http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @link		https://github.com/patwork/CodeIgniter-PL
 * @since		Version 1.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['email_must_be_array']         = 'Metoda walidująca adresy email musi być wywołana z parametrem typu array.';
$lang['email_invalid_address']       = 'Niepoprawny adres email: %s';
$lang['email_attachment_missing']    = 'Nie można odnaleźć załącznika wiadomości email: %s';
$lang['email_attachment_unreadable'] = 'Nie można otworzyć załącznika: %s';
$lang['email_no_recipients']         = 'Należy podać odbiorców: To, Cc, or Bcc';
$lang['email_send_failure_phpmail']  = 'Nie można wysłać wiadomości email używając funkcji PHP mail(). Serwer może nie być skonfigurowany do wysyłania maili przy użyciu tej metody.';
$lang['email_send_failure_sendmail'] = 'Nie można wysłać wiadomości email używając PHP Sendmail. Serwer może nie być skonfigurowany do wysyłania maili przy użyciu tej metody.';
$lang['email_send_failure_smtp']     = 'Nie można wysłać wiadomości email używając PHP SMTP. Serwer może nie być skonfigurowany do wysyłania maili przy użyciu tej metody.';
$lang['email_sent']                  = 'Wiadomość została pomyślnie wysłana używając protokołu: %s';
$lang['email_no_socket']             = 'Nie można otworzyć gniazda do Sendmail.';
$lang['email_no_hostname']           = 'Nie podano nazwy hosta SMTP.';
$lang['email_smtp_error']            = 'Wystąpił błąd SMTP: %s';
$lang['email_no_smtp_unpw']          = 'Błąd: należy podać login i hasło SMTP.';
$lang['email_failed_smtp_login']     = 'Błąd podczas wysyłania polecenia AUTH LOGIN. Błąd: %s';
$lang['email_smtp_auth_un']          = 'Błąd uwierzytelniania loginu. Błąd: %s';
$lang['email_smtp_auth_pw']          = 'Błąd uwierzytelniania hasła. Błąd: %s';
$lang['email_smtp_data_failure']     = 'Nie można wysłać danych: %s';
$lang['email_exit_status']           = 'Kod statusu zakończenia: %s';

/* End of file email_lang.php */
/* Location: ./system/language/polish/email_lang.php */
