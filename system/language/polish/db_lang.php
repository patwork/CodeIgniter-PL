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

$lang['db_invalid_connection_str']     = 'Nie można określić ustawień bazy danych na podstawie podanego "connection string".';
$lang['db_unable_to_connect']          = 'Nie można połączyć się z bazą danych używając podanych ustawień.';
$lang['db_unable_to_select']           = 'Nie można wybrać bazy danych: %s';
$lang['db_unable_to_create']           = 'Nie można utworzyć bazy danych: %s';
$lang['db_invalid_query']              = 'Zapytanie jest niepoprawne.';
$lang['db_must_set_table']             = 'Należy określić tabelę, której ma dotyczyć zapytanie.';
$lang['db_must_use_set']               = 'Należy użyć metody "set" do zaktualizowania wpisu.';
$lang['db_must_use_index']             = 'Należy określić indeks do operacji seryjnych.';
$lang['db_batch_missing_index']        = 'Jeden lub więcej rekordów przekazanych do operacji seryjnej nie posiada wymaganego indeksu.';
$lang['db_must_use_where']             = 'Operacja "update" musi zawierać klauzulę "where".';
$lang['db_del_must_use_where']         = 'Operacja "delete" musi zawierać klauzulę "where" lub "like".';
$lang['db_field_param_missing']        = 'Pobieranie danych wymaga podania nazwy tabeli jako parametru.';
$lang['db_unsupported_function']       = 'Funkcja nie jest obsługiwana przez używaną bazę danych.';
$lang['db_transaction_failure']        = 'Transakcja nieudana: wykonano rollback.';
$lang['db_unable_to_drop']             = 'Nie można usunąć wybranej bazy danych.';
$lang['db_unsupported_feature']        = 'Właściwość nie jest obsługiwana przez używaną bazę danych.';
$lang['db_unsupported_compression']    = 'Wybrany format kompresji pliku nie jest obsługiwany przez serwer.';
$lang['db_filepath_error']             = 'Nie można zapisać danych w podanej ścieżce do pliku';
$lang['db_invalid_cache_path']         = 'Ścieżka cache jest niepoprawna lub brak prawa zapisu.';
$lang['db_table_name_required']        = 'Nazwa tabeli jest wymagana aby wykonać tę operację.';
$lang['db_column_name_required']       = 'Nazwa kolumny jest wymagana aby wykonać tę operację.';
$lang['db_column_definition_required'] = 'Definicja kolumny jest wymagana aby wykonać tę operację.';
$lang['db_unable_to_set_charset']      = 'Nie można ustawić kodowania znaków połączenia klienta: %s';
$lang['db_error_heading']              = 'Wystąpił błąd bazy danych';

/* End of file db_lang.php */
/* Location: ./system/language/polish/db_lang.php */
