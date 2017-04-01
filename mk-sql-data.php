#!/usr/bin/php
<?php

error_reporting( E_STRICT );

/*
 *
 *	The app mk-test-data is licensed under the terms of the MIT license
 *	(c) Rainer Stötter 2016-2017
 */


/*
cColorsCLI:: (4 methods):
  __construct()
  ColoredCLI()
  getForegroundColors()
  getBackgroundColors()

cConfigFile:: (9 methods):
  __construct()
  __destruct()
  IsDone()
  GetCh()
  SkipSpaces()
  SkipComment()
  SkipCharsUntilCommand()
  ReadCommand()
  ScanUntilFolgezeichen()

cCommand:: (38 methods):
  CloseExportFile()
  DoTheExport()
  ExecuteCommand()
  GetCh()
  ImportTextData()
  ImportTheTextdata()
  IsDone()
  NextToken()
  OpenExportFile()
  RandomASCII()
  RandomBIC()
  RandomBLZ()
  RandomBool()
  RandomDate()
  RandomDateTime()
  RandomFloat()
  RandomIBAN()
  RandomInt()
  RandomPhone()
  RandomText()
  RandomTime()
  Randomize()
  RandomizeNormalType()
  RandomizeTimeType()
  ResetActions()
  ResetCode()
  ResetData()
  RewindTo()
  ScanNumber()
  ScanToken()
  ScanUntilFolgezeichen()
  SkipSpaces()
  StringFoundIn()
  UnGetCh()
  __construct()
  __destruct()
  is_ctype_identifier()
  is_ctype_identifier_start()

cTestdatenGenerator:: (4 methods):
  __construct()
  __destruct()
  Execute()
  WriteHeader()
*/


class cOracleResultSmall {

    // a basic subset of the oci operations hidden behind a class

    protected $m_id_statement = null;
    protected $m_fetch_mode = null;

    public $num_rows = -1;

    function __construct( $id_statement, $fetch_mode ) {

	assert( is_resource( $id_statement ) );

	$this->m_id_statement = $id_statement;
	$this->m_fetch_mode = $fetch_mode;

	 $this->num_rows = oci_num_rows( $this->m_id_statement );

    }	// function __destruct( )

    function __destruct( ) {

    }	// function __destruct( )

    public function fetch_array( ){
        return oci_fetch_array($this->m_id_statement, $this->m_fetch_mode);
    }

    public function fetch_row( ){
        return oci_fetch_row( $this->m_id_statement );
    }

    public function fetch_assoc( ){
        return oci_fetch_assoc( $this->m_id_statement );
    }

    public function close( ) {

	// nop - no operation

    }  // function close( )

}	// class cOracleResultSmall


class cOracleSmall {

    // a basic subset of the oci operations hidden behind a class

    const CONNECTION_TYPE_DEFAULT = 1;
    const CONNECTION_TYPE_PERSISTENT = 2;
    const CONNECTION_TYPE_NEW = 3;

    protected $m_charset = 'WE8ISO8859P1';

    protected $m_connection_handle = null;

    protected $m_fetch_mode = OCI_BOTH;
    protected $m_is_auto_commit = false;
    protected $m_is_executing = false;

    protected $m_a_statements = array( );

    protected $m_var_max_size = 1000;

    protected $m_last_query = '';

    protected function SetAutoCommit($auto_commit = true){

	// nicht public, da nur im __construct gesetzt werden kann

        $this->m_is_auto_commit = $auto_commit;

    }

    protected function SetFetchMode($fetch_mode = OCI_BOTH){

	// nicht public, da nur im __construct gesetzt werden kann

        $this->m_fetch_mode = $fetch_mode;

    }


   public function GetError(){
        return @oci_error($this->m_connection_handle);
    }

   protected function SetNlsLang($charset = 'WE8ISO8859P1' ){

	// nicht public, da nur im __construct gesetzt werden kann

        $this->m_charset = $charset;
    }

    public function GetExecuteStatus(){
        return $this->m_is_executing;
    }

    private function GetBindingType( $var ){

        if (is_a($var, "OCI-Collection")) {

          $binding_type = SQLT_NTY;
          $this->m_var_max_size = -1;

        } elseif (is_a($var, "OCI-Lob")) {

          $binding_type = SQLT_CLOB;
          $this->m_var_max_size = -1;

        } else {

          $binding_type = SQLT_CHR;

        }

        return $binding_type;
    }

    private function Execute( $sql, & $bind = false ){


	assert( is_resource( $this->m_connection_handle ) );

        if ( ! is_resource( $this->m_connection_handle ) ) {
	    return false;
	}

        $this->m_last_query = $sql;

        $id_statement = @oci_parse( $this->m_connection_handle, $sql );

	if (! $id_statement ) {
	  $oerr = OCIError($stmt);
	  echo "Fetch Code 1:".$oerr["message"];
	  exit;
	}

        $this->m_statements[ ( int ) $id_statement][ 'text' ] = $sql;
        $this->m_statements[ ( int) $id_statement ][ 'bind' ] = $bind;

        if ( $bind && is_array( $bind ) ) {

            foreach($bind as $k=>$v){

                oci_bind_by_name($id_statement, $k, $bind[$k], $this->m_var_max_size, $this->GetBindingType( $bind[ $k ] ) );

            }
        }

        $mode_autocommit = $this->m_is_auto_commit ? OCI_COMMIT_ON_SUCCESS : OCI_DEFAULT;

        $this->m_is_executing = oci_execute( $id_statement, $mode_autocommit );

        return $this->m_is_executing ? $id_statement : false;
    }


    protected function Connect( $connection_string = 'localhost', $user='', $password='', $mode = OCI_DEFAULT, $type = self::CONNECTION_TYPE_DEFAULT ){

    echo "\n before Connect() mit connect = '{$connection_string}'";

      switch ($type) {
          case self::CONNECTION_TYPE_PERSISTENT: {
              $this->m_connection_handle = oci_pconnect($user, $password, $connection_string, $this->m_charset, $mode);
          }; break;
          case self::CONNECTION_TYPE_NEW: {
              $this->m_connection_handle = oci_new_connect($user, $password, $connection_string, $this->m_charset, $mode);
          }; break;
          default:
              $this->m_connection_handle = oci_connect($user, $password, $connection_string, $this->m_charset, $mode);
      }


    if ( $this->m_connection_handle === false ) {
	$e = oci_error();
	var_dump( $e );
	die( "\n error connecting to '{$connection_string}' with user '{$user}'" );
    }


      // var_dump( $this->m_connection_handle );



      return is_resource($this->m_connection_handle) ;
    }

    public function query( $sql, $bind = false ){

	// returns statement id or false

        $id_statement = $this->Execute( $sql, $bind );		// id_statement or false
        return  ( is_resource( $id_statement ) ?  new cOracleResultSmall( $id_statement, $this->m_fetch_mode ) : false );

    }

    public function close( ) {
	if (is_resource($this->m_connection_handle)) {
	    @oci_close($this->m_connection_handle);
	  }
    }

    public function __construct(
			  $host = 'localhost',
			  $user = '',
			  $password = '',
			  $database = 'localhost',
			  $mode = OCI_DEFAULT,
			  $type = self::CONNECTION_TYPE_DEFAULT,
			  $charset = 'WE8ISO8859P1' ) {

	// in $this->m_connection_handle ist der Handle des Datenbank-Connects gespeichert

        $this->SetNlsLang( $charset );	// defaults to western Europe
        $this->SetAutoCommit( false );
        $this->SetFetchMode( OCI_ASSOC );

        $this->Connect( $host, $user, $password, $mode , $type );

    }

    function __destruct( ) {

	$this->close( );

    }	// function __destruct( )

}  // class cOracleSmall

class cCredentialsReader {

    //
    // reads the credentials of the database from the command line
    //

    public $m_host_name = '';
    public $m_schema_name = '';
    public $m_user_name = '';
    public $m_user_password = '';

    protected $m_host_name_org = '';
    protected $m_schema_name_org = '';
    protected $m_user_name_org = '';
    protected $m_user_password_org = '';

    function __construct( $host_name, $schema_name, $user_name, $user_password ) {

	$this->m_host_name = $this->m_host_name_org = $host_name;
	$this->m_schema_name = $this->m_schema_name_org = $schema_name;
	$this->m_user_name = $this->m_user_name_org = $user_name;
	$this->m_user_password = $this->m_user_password_org = $user_password;

	$this->ReadCredentials( );

    }	// function __construct( )

    protected function ReadLine( $prompt = "\n $:" ) {

	// PHP CLI normally is installed witout the readline library!


	if ( PHP_OS == 'WINNT' ) {

	    echo $prompt;

	    $line = stream_get_line( STDIN, 1024, PHP_EOL );

	} else {

	    echo $prompt;

	    $line = stream_get_line( STDIN, 1024, PHP_EOL );

	    //$line = readline( $prompt );

	}

	return $line;

    }	// function ReadLine( )

    function ReadPassword( $prompt = "Enter Password:" ) {

      // from http://stackoverflow.com/questions/187736/command-line-password-prompt-in-php

      if (preg_match('/^win/i', PHP_OS)) {

	$vbscript = sys_get_temp_dir() . 'prompt_password.vbs';

	file_put_contents(
	  $vbscript, 'wscript.echo(InputBox("'
	  . addslashes($prompt)
	  . '", "", "password here"))');

	$command = "cscript //nologo " . escapeshellarg($vbscript);

	$password = rtrim(shell_exec($command));

	unlink($vbscript);

	return $password;

      } else {

	$command = "/usr/bin/env bash -c 'echo OK'";

	if (rtrim(shell_exec($command)) !== 'OK') {
	  trigger_error("Cannot invoke bash");
	  return;
	}

	$command = "/usr/bin/env bash -c 'read -s -p \""
	  . addslashes($prompt)
	  . "\" mypassword && echo \$mypassword'";

	$password = rtrim( shell_exec( $command ) );

	echo "\n";

	return $password;

      }
    }    // function ReadPassword( )

    protected function ReadCredentials( & $host, & $schema, & $user, & $password ) {

	$host = $this->m_host_name_org;
	$schema = $this->m_schema_name_org;
	$user = $this->m_user_name_org;
	$password = $this->m_user_password_org;

	while ( ! strlen( trim( $host ) ) ) {
	    $host = $this->ReadLine( "\n the database host is : " );
	}

	while ( ! strlen( trim( $schema ) ) ) {
	    $schema = $this->ReadLine( "\n the database schema ( database name ) is : " );
	}

	while ( ! strlen( trim( $user ) ) ) {
	    $user = $this->ReadLine( "\n the database user is : " );
	}

	while ( ! strlen( trim( $password ) ) ) {
	    $password = $this->ReadPassword( "\n the password of the database user is : " );
	}

	$this->m_host_name = $host;
	$this->m_schema_name = $schema;
	$this->m_user_name = $user;
	$this->m_user_password = $password;

    }	// function ReadCredentials( )

}	// class cCredentialsReader

 class cColorsCLI {

	// a good idea of agarzon - https://gist.github.com/agarzon - completely rewritten

	private $m_a_fg_colors = array(

	    array( 'black' =>  '0;30'),
	    array( 'dark_gray' =>  '1;30'),
	    array( 'blue' =>  '0;34'),
	    array( 'light_blue' =>  '1;34'),
	    array( 'green' =>  '0;32'),
	    array( 'light_green' =>  '1;32'),
	    array( 'cyan' =>  '0;36'),
	    array( 'light_cyan' =>  '1;36'),
	    array( 'red' =>  '0;31'),
	    array( 'light_red' =>  '1;31'),
	    array( 'purple' =>  '0;35'),
	    array( 'light_purple' =>  '1;35'),
	    array( 'brown' =>  '0;33'),
	    array( 'yellow' =>  '1;33'),
	    array( 'light_gray' =>  '0;37'),
	    array( 'white' =>  '1;37')

	);


	private $m_a_bg_colors = array(

	    array( 'black' => '40' ),
	    array( 'red' => '41' ),
	    array( 'green' => '42' ),
	    array( 'yellow' => '43' ),
	    array( 'blue' => '44' ),
	    array( 'magenta' => '45' ),
	    array( 'cyan' => '46' ),
	    array( 'light_gray' => '47' )
	);

	function __construct() {

	}	// function __construct( )


	public function ColoredCLI(
			    $str_output,
			    $fg_color = null,
			    $bg_color = null
			    ) {

		$str_colored = "";
		$praefix = "\033[";
		$suffix = "\033[0m";


		if ( isset( $this->m_a_fg_colors[ $fg_color ] ) ) {
		    $str_colored .= $praefix . $this->m_a_fg_colors[ $fg_color ] . "m";
		}

		if ( isset( $this->m_a_bg_colors[ $bg_color ] ) ) {
		    $str_colored .= $praefix . $this->m_a_bg_colors[ $bg_color ] . "m";
		}

		$str_colored .=  $str_output . $suffix;

		return $str_colored;


	}	// function ColoredCLI( )

 }	// class cColorsCLI

class cConfigFile {

    protected $m_filehandle = null;
    protected $m_filename = '';
    protected $m_chr = '';

    protected $m_obj_colors = null;		// cColorsCLI

    function __construct( $filename ) {	// cConfigFile

	$this->m_filename = $filename;

	$this->m_obj_colors = new cColorsCLI( );

	$this->m_filehandle = fopen( $this->m_filename, 'r' );
	$this->GetCh( );

    }	// function __construct( )

    function __destruct( ) {		// cConfigFile

	if ( is_resource( $this->m_filehandle ) ) {

	    fclose( $this->m_filehandle );

	}

    }	// function __destruct( )

    public function IsDone( ) {

	return feof( $this->m_filehandle );

    }	// function IsDone( )


    protected function GetCh( ) {

	$chr = '';

	$this->m_chr = fread( $this->m_filehandle, 1 );

// 	echo "" . $this->m_obj_colors->ColoredCLI( $this->m_chr, 'green' );

	return $this->m_chr;

    }	// function GetCh( )

    protected function ActCh( ) {

	$chr = '';

// 	echo "" . $this->m_obj_colors->ColoredCLI( $this->m_chr, 'green' );

	return $this->m_chr;

    }    // function ActCh( )

    protected function SkipSpaces( ) {

    // positioniert auf den näcshten non-blank (space, tab, LF)


	$count = 0;

	if ( ctype_space( $this->m_chr ) ) {

	    while ( ctype_space( $this->m_chr )  && ( $this->m_chr != '' ) )  {
		$chr = $this->GetCh( ) ;
		$count++;

	    }
	}

	return $count;

    }	// function SkipSpaces( )


    protected function SkipComment( ) {

	$count = 0;
	$chr = '';

	if ( $this->m_chr == '#' )  {

	    while ( ( $this->m_chr != chr( 10 )  && ( $this->m_chr != '' )) ) {
		$chr = $this->GetCh( ) ;
		$count++;

	    }

	}

	return $count;

    }	// function SkipComment( )

    protected function SkipCharsUntilCommand( ) {

	while ( $this->SkipComment( ) || $this->SkipSpaces( ) );

    }	// function SkipCharsUntilCommand( )



    public function ReadCommand( ) {

	// liest eine Kommandozeile ein

	$this->SkipCharsUntilCommand( );
	$cmd = $this->m_chr;

	$fertig = false;
	while ( ! $fertig ) {

	    $chr = $this->GetCh( );

	    $cmd .= $chr;
	    if ( $chr == '"' ) {
		$this->GetCh( );
		$cmd .= $this->ScanUntilFolgezeichen( '"' );
		$cmd .= '"';


	    }


	    $chr = $this->m_chr;
	    $fertig = ( feof( $this->m_filehandle ) || ( $chr == '' ) || ( $chr == ';' ) || ( $chr == '#' ) );

	}

	if ( $chr == ';' ) {
	    $this->GetCh( );
	    $cmd .= ';';
	}

	return trim( $cmd );

    }	// function ReadCommand( )


	protected function ScanUntilFolgezeichen( $zeichen ) {

	  // liest samt dem Folgezechen alles ein und positioniert auf das erste Zeichen danach
	  // das Zeichen $zeichen wird NICHT angehängt an das Ergebnis
	  // muss vorher auf ein Zeichen nach dem Startzeichen positioniert worden sein


	    $content = '';

	    assert( strlen( $zeichen ) > 0 );

	    if ( ( strlen( $zeichen ) ) && ( $this->m_chr != '' ) )  {

		while ( ( ( $chr = $this->m_chr) != $zeichen ) && ( $chr != '' ) ) {

		    $content .= $chr;
		    $this->GetCh( );

		}
// 		    $this->GetCh( );	????
// 		$content .= $zeichen;
		if ( $this->m_chr != $zeichen ) echo "\n Warning: cConfigFile::ScanUntilFolgezeichen( ) endet auf '$this->m_chr'";
		$this->GetCh( );
		assert( $this->m_chr != $zeichen );

	    }

	    return $content;

	}	// function ScanUntilFolgezeichen( )

}	// class cConfigFile

class cCommandDatabaseParams {

    protected $m_host_name = '';
    protected $m_schema_name = '';
    protected $m_user_name = '';
    protected $m_user_password = '';
    protected $m_database_provider = '';

    function __construct( $str_params, $database_provider ) {

	// die Parameter als Zeichenkette ohne Delimiter!
	// die Einträge sind kommasepariert

	// HOST, SCHEMA, USER, PASSWORD


	assert( is_string( $str_params ) && ( strlen( trim( $str_params ) ) ) );
	assert( is_string( $database_provider ) && ( strlen( trim( $database_provider ) ) ) );

	$str_params = trim( $str_params );

	$a_params = explode( ',' , $str_params );

	$this->m_host_name = $a_params[ 0 ];
	$this->m_schema_name = $a_params[ 1 ];
	$this->m_user_name = $a_params[ 2 ];
	$this->m_user_password = $a_params[ 3 ];

	$this->m_database_provider = strtoupper( trim( $database_provider ) );

	assert( strlen( trim( $this->m_host_name ) ) );
	assert( strlen( trim( $this->m_schema_name ) ) );
	assert( strlen( trim( $this->m_user_name ) ) );
	assert( strlen( trim( $this->m_user_password ) ) );

    }	// __construct( )

    protected function ReadCredentials( ) {

	$host_name = $this->m_host_name;
	$schema_name = $this->m_schema_name;
	$user_name = $this->m_user_name;
	$user_password = $this->m_user_password;

	$mysqli = null;


	do {

	    $obj_credentials = new cCredentialsReader( $host_name, $schema_name, $user_name, $user_password );

	    echo "\n trying to connect to the database server";

	    if ( $this->m_database_provider == 'MYSQLI' ) {

		echo "\n connecting to MYSQL";

		$mysqli = new mysqli(
		    $obj_credentials->m_host_name,
		    $obj_credentials->m_user_name,
		    $obj_credentials->m_user_password,
		    $obj_credentials->m_schema_name
		);

	    } elseif ( $this->m_database_provider == 'ORACLE' ) {

		echo "\n connecting to ORACLE";

		$mysqli = new cOracleSmall(
		    $obj_credentials->m_host_name,
		    $obj_credentials->m_user_name,
		    $obj_credentials->m_user_password,
		    $obj_credentials->m_schema_name
		);

	    } else {

		die( "\n unknown database provider '{$this->m_database_provider}'" );

	    }

	    echo " .. finished";

	    if ( $mysqli === false ) {

		echo "\n wrong credentials - try again!";

	    } else {

		echo "\n success connecting to database";

	    }

	    if ($mysqli->connect_error) {
		echo('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
	    }

	} while( $mysqli->connect_error );

	// $m_mysqli->close( );

	$this->m_host_name = $host_name;
	$this->m_schema_name = $schema_name;
	$this->m_user_name = $user_name;
	$this->m_user_password = $user_password;

	return $mysqli;

    }	// function ReadCredentials( )


    function __destruct( ) {			// cCommand

    }	// function __destruct( )

    public function GetOpenedDatabase( ) {

	echo "\n preparing to open the database";

	$mysqli = $this->ReadCredentials( );

        if ( $mysqli === false ) {

	    die( "\n could not open the database '{$this->m_schema_name}' - check the credentials!" );

        }

        echo "\n established database connection";

        assert( is_a( $mysqli, 'mysqli' ) );

        return $mysqli;

    }	// function GetOpenedDatabase( )

}	// class cCommandDatabaseParams


class cCommandIncrement {

    public $m_field_name = '';
    public $m_a_increment_vars = array( );
    public $m_database_provider = 'MYSQL';

    function __construct( $field_name, $a_increment_vars, $database_provider ) {	// cCommandIncrement

	assert( is_string( $field_name ) );
	assert( is_array( $a_increment_vars ) );

	$this->m_field_name = $field_name;
	$this->m_a_increment_vars = $a_increment_vars;
	$this->m_database_provider = $database_provider;

    }	// function __construct( )

    public function GetInsertParts( & $str_field_name, & $str_value, & $a_variables, $table_name ) {

	// Teile eines Inserts zusammentragen

	$str_field_name = $this->m_field_name;

	$where = '';

	if ( count( $this->m_a_increment_vars ) ) {

	    $where .= ' where ';

	}

	$was_here = false;
	foreach ( $this->m_a_increment_vars as $var ) {

	    if ( ! isset( $a_variables[ $var ] ) ) die( "\n program crashed: cannot find predefined variable '$var' from INCREMENT" );

	    if ( $was_here ) {
		$where .= ' AND ';
	    }

	    $was_here = true;

	    $where .= $var . ' = ' . "'" . $a_variables[ $var ] . "'";

	}

	if ( $this->m_database_provider == 'ORACLE' ) {
	    // $str_value = "( SELECT CASE WHEN ISNULL( MAX( {$str_field_name} ) ) THEN 1 ELSE MAX( {$str_field_name} ) + 1 ) FROM {$table_name} XXX {$where} )";
	    $str_value = "( SELECT NVL( MAX( {$str_field_name} ), 0 ) + 1 FROM {$table_name} XXX {$where} )";
	} else {
	    $str_value = "( SELECT IF( ISNULL( MAX( {$str_field_name} ) ), 1, MAX( {$str_field_name} ) + 1 ) FROM {$table_name} AS _XXX_ {$where} )";
	}

    }	// function GetInsertParts( )



    function __destruct( ) {			// cCommandIncrement

    }	// function __destruct( )


}	// class cCommandIncrement

class cCommandFetch {

    protected $m_mysqli = null;

    protected $m_sql = '';			// Das SQL, welches die Daten für die Feldnamen liefert
    protected $m_sql_original = '';		// Das originale SQL, - eventuell mit Platzhaltern
    protected $m_a_field_names = array( );	// Die mittels des SQL einzulesenden Feldnamen

    protected $m_a_field_values = array( );	// Die mittels des SQL eingelesenen Werte, die in Arrays gehalten werden

    protected $m_a_increment_vars = array( );	// Eindimensionales Feld mit den Feldnamen im INCREMENT-Part

    protected $m_a_increment_relations = array();  	// Mehrdimensionales Feld :
							// { {values of increment vars}, value for result  }


    function __construct( $mysqli, $a_field_names, $str_sql, $a_vars ) {

	// $a_vars enthält die bisherigen berechneten Variablen mit ihren Werten zum substituieren

	  assert( is_array( $a_field_names ) );
	  assert( is_string( $str_sql ) );
	  assert( is_a( $mysqli, 'mysqli' ) );

	  $this->m_mysqli = $mysqli;
	  $this->m_a_field_names = $a_field_names;

	  $this->m_sql_original = $str_sql;

	  //

	  $str_sql = $this->m_sql_original;

	  foreach ( $a_vars as $key => $value ) {

	      $str_sql = str_replace( ':' . $key, $value, $str_sql );

	  }

	  $this->m_sql = $str_sql;

	  $this->FetchData( );

    }	// function __construct( )

    private function FetchData( ) {

	assert( $this->m_mysqli !== false );

	$result = $this->m_mysqli->query( $this->m_sql );

	if ( $result === false ) {

	    printf("\nFetchData: \n Errormessage: %s \n SQL: %s", $this->m_mysqli->error, $this->m_sql );
	    die( "\n Abbruch wegen Datenbankfehler" );

	} else {

 	   while ( $row = $result->fetch_row( ) ) {

		$this->m_a_field_values[] = $row;;

	    }

	}


    }	// function FetchData( )

    public function ReplaceFieldVars( & $sql ) {

	// Feldvariablen ( Feldnamen mit vorangestelltem Doppelpunkt ) austauschen gegen Werte

	$a_field_names = array( );
	$a_field_values = array( );

	$this->GetRandomizedFetchData( $a_field_names, $a_field_values );

	for ( $i = 0; $i < count( $a_field_names ); $i++ ) {

	    $sql = str_replace( ':' . $a_field_names[ $i ], $a_field_values[ $i ], $sql  );

	}

    }	// function ReplaceFieldVars( )

    public function GetRandomizedFetchData( & $field_names, & $values ) {

// 	if ( ! count( $this->m_a_field_values ) ) return;

	$index = rand( 0 , count( $this->m_a_field_values ) - 1  );

	$field_names = $this->m_a_field_names;
/*
	$ary = array();
	for ( $i = 0; $i < count( $this->m_a_field_names ) - 1; $i++ ) {
	      $ary[] = $this->m_a_field_values[ $index ][ $i ];
	}
*/

	$values = $this->m_a_field_values[ $index ];



// array_walk(debug_backtrace(),create_function('$a,$b','print "{$a[\'function\']}()(".basename($a[\'file\']).":{$a[\'line\']}); ";'));

	if ( count( $values ) < count( $field_names )  ) {

	    die( "\n program crashed: sql returns no rows! \n {$this->m_sql}" );

	}


    }	// function GetRandomizedFetchData( )

    public function GetInsertParts( & $str_field_names, & $str_values, & $a_variables ) {

	// Teile eines Inserts zusammentragen

	$str_field_names = '';
	$str_values = '';

	$was_active = false;

	$this->GetRandomizedFetchData( $a_field_names, $a_values );


	for ( $i = 0; $i < count( $a_field_names ); $i++ ) {

	    if ( $was_active ) {
		$str_field_names .= ',';
		$str_values .= ',';
	    }

	    $str_field_names .= $a_field_names[ $i ];

	    $str_values .= "'" . trim( $a_values[ $i ] ) . "'";

	    $a_variables[ $a_field_names[ $i ] ] = trim( $a_values[ $i ] );

	    $was_active = true;

	}

    }	// function GetInsertParts( )


    function __destruct( ) {			// cCommandFetch

    }	// function __destruct( )


}	// class cCommandFetch






class cCommand {

    //
    // liest das Konfigurationsskript ein und führt es aus.
    //
    // manche Befehle werden sofort ausgeführt, andere gesammelt bis zum nächsten RUN THE EXPORT. Dann sind da noch
    // Parserkommandos wie ScanXXX( ) und Rendomisierungsfunktionen wie RandomXXX( ) und RandomizeXXX( ).
    //
    // Die Funktion ExecuteCommand( ) ist dabei das Herzstück der Klasse, welche alles am Laufen hält.

    // Das Kommando RUN THE EXPORT stößt DoTheExport( ) an, welches die ausstehenden Aktionen dann schrittweise ausführt
    //
    // sofort ausgeführt werden:
    //
    //		DBPARAMS		nur von FETCH benötigt
    //		DELETE CLAUSE FOR
    //		EXPORT ... RECORDS
    //		FILENAME IS
    //		READ .. FROM
    //		RESET
    //		START WITH RECORD
    //		WORK ON TABLE
    // 		RUN THE EXPORT
    //
    //  gleich ins Skript, jeweils am Anfang einer neuen Aufgabe, geschrieben wird
    //
    //		DO DELETE FROM
    //		INCLUDE TEXT
    //
    // verzögert abgearbeitet wird
    //
    //		FETCH .. USING
    //		SET .. TO
    //		USE .. AS
    //		INCREMENT .. DEPENDING FROM .. IN TABLE ..
    //


    // Konstanten für $this->m_a_changes[]

    const __IMPORT_CHANGE_USE__ = 1;	// Zuordnung Spaltenname zu randomisiertem Feld
    const __IMPORT_CHANGE_SET__ = 2;	// Spalten, denen bestimmte feste Werte zugeordnet werden sollen
    const __IMPORT_CHANGE_SET_RANDOMIZED__ = 4;  // Spalten, denen bestimmte variable Werte zugeordnet werden sollen
    const __IMPORT_CHANGE_SET_SQL__ = 8;  // Spalten, denen ein SQL-Token zugeordnet werden soll
    const __IMPORT_BY_FETCH__ = 16;  // über ein Fetch-Objekt die Daten bestimmen
    const __IMPORT_INCREMENTED__ = 32;  // über ein Fetch-Objekt die Daten bestimmen

    //

    protected $m_command = '';
    protected $m_chr = '';
    protected $m_char_index = -1;

    protected $m_mysqli = null;			// Datenbankverbindung, falls DB_PARAMS gesetzt wurde

    protected $m_act_table = '';		// the table we are working with
    protected $m_act_record_number = '';	// the actual record number ( zero based )
    protected $m_records_to_export = 10000;	// how much random records should be written?
    protected $m_read_mode = '';		// what data and how we have to import data
    protected $m_act_filename_import = '';		// filename from where we have to import the text data

    protected $m_act_filename_export = '';	// sql filename where we export the text data to
    protected $m_filehandle_export = null;	// $m_act_filename_export

    protected $m_a_delete_clauses = array( );	// DELETE-Vorschrift - assioziatives Feld array( <TABLENAME>, <WHERECLAUSE> );

    protected $m_a_prenames = array( );		// Die importierten Vornamen
    protected $m_a_surnames = array( );		// Die importierten Familiennamen
    protected $m_a_streets = array( );		// Die importierten Straßennamen
    protected $m_a_zipcodes = array( );		// Die importierten Postleitzahlen samt Stadt - zweispaltig
    protected $m_long_text = '';		// Der importierte Langtext

    protected $m_a_changes = array( );		// Das Feld mit den Aktionen, die für jedes INSERT ausgeführt werden sollen
						// array( type, column_name, value_or_array_name );
						// mit type = __IMPORT_CHANGE_SET__ | __IMPORT_CHANGE_USE__

    protected $m_a_variables = array( );	// Ein assoziatives Feld mit den schon deklarierten Variablennamen
						// und ihren Werten

    protected $m_index_last_export = -1;	// Arraygröße von m_a_changes beim letzten Export-Befehl

    public $m_sql_code = '';			// the generated sql code - a part of written during the initialization

    protected $m_obj_colors = null;		// cColorsCLI

    protected $m_a_fetched = array( );		// FETCH-Ergebnisse mit Objekten vom Typ cCommandFetch

    protected $m_user_defined_code = '';	// vom Benutzer initiierter Code - delete from und insert

/*
    // the database credentials

    protected $m_host_name = '';
    protected $m_schema_name = '';
    protected $m_user_name = '';
    protected $m_user_password = '';
*/

    protected $m_database_provider = 'MYSQL';	// the database provider - MYSQL or ORACLE

    protected function ResetData( ) {

      $this->m_a_prenames = array( );		// Die importierten Vornamen
      $this->m_a_surnames = array( );		// Die importierten Familiennamen
      $this->m_a_streets = array( );		// Die importierten Straßennamen
      $this->m_a_zipcodes = array( );		// Die importierten Postleitzahlen samt Stadt - zweispaltig
      $this->m_long_text = '';			// Der Langtext

    }	// function ResetData( )


    protected function FollowsDelimiter( ) {

	return 	( $this->m_chr == '"' ) ||
		( $this->m_chr == "'" ) ||
		( $this->m_chr == '`' )
		;

    }	// function FollowsDelimiter( )

    protected function GetTextBetweenDelimiters( & $text, $do_trim = true ) {

	$ret = false;

	$text = '';

	//

	$this->SkipSpaces( );

	$zeichen = $this->ActCh( );

	if ( ! $this->FollowsDelimiter( ) ) {

	    die( "\n program crashed: delimiter expected, got '" . $this->ActCh( ) . "'" );

	}

	// zunächst die Feldliste einlesen

	// überspringe das Startzeichen
	$this->GetCh( );

	if ( $zeichen == '"' ) {
	    $text = $this->ScanUntilFolgezeichen( $zeichen );
	} elseif ( $zeichen == "'" ) {
	    $text = $this->ScanUntilFolgezeichen( $zeichen );
	} elseif ( $zeichen == '`' ) {
	    $text = $this->ScanUntilFolgezeichen( $zeichen );
	} else {
	    echo "\n {$this->m_command}";
	    die( "\n Abbruch: kein valider Delimiter nach 'FETCH' ({$zeichen})" );
	}

	if ( $do_trim ) $text = trim( $text );

	// überspringe das Endzeichen
// 	    $this->GetCh( );

	$this->SkipSpaces( );

	return $ret;

    }	// function GetTextBetweenDelimiters( )

    protected function ResetCode( ) {

       $this->m_sql_code = '';			// the generated sql code - a part of written during the initialization

    }	// function ResetCode( )

    protected function ResetActions( ) {

       $this->m_a_changes = array( );		// Das Feld mit den Aktionen, die für jedes INSERT ausgeführt werden sollen
       $this->m_a_variables = array( );
/*
       // lösche alle Einträge, die sich bis zum letzten RUN THE EXPORT angesammelt haben
       for ( $i = 0; $i < $this->m_index_last_export; $i++ ) {

	  $this->m_a_changes[ $i ] = null;

       }
*/
    }	// function ResetActions( )


    protected function DoTheExport( ) {

	//
	// export the randomized data
	//

	$this->m_index_last_export = count( $this->m_a_changes );

	$this->m_a_variables = array( );	// Die Variablenwerte werden ja jedesmal neu berechnet

	$last = $this->m_act_record_number + $this->m_records_to_export;


	if ( $this->m_database_provider == 'ORACLE' ) {
	    $this->m_sql_code .= chr( 10 ) . 'SET DEFINE OFF;' . chr( 10 );
	    $this->m_sql_code .= chr( 10 ) . " ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS'; " . chr( 10 );
	}
	$this->m_sql_code .= chr( 10 ) . 'START TRANSACTION;' . chr( 10 );

	$this->m_sql_code .= $this->m_user_defined_code;
	$this->m_user_defined_code = '';

// 	$begin .= 'BEGIN;' . chr(10);
	$commit = 'COMMIT;' . chr(10);
	$prefix = chr(10) . 'INSERT INTO ' . $this->m_act_table . '(';
	$middle = ' ) VALUES ( ';
	$suffix =  ');' . chr(10);

	$count_zips = count( $this->m_a_zipcodes );
	$count_surnames = count( $this->m_a_surnames );
	$count_prenames = count( $this->m_a_prenames );
	$count_streets = count( $this->m_a_streets );
	$count_cities = count( $this->m_a_zipcodes );

	$this->m_obj_colors->ColoredCLI( "\n $count_zips zip codes and cities, $count_surnames surnames, $count_prenames prenames and $count_streets streets", 'magenta' );

// 	fwrite( $this->m_filehandle_export, $begin );
	fwrite( $this->m_filehandle_export, $this->m_sql_code );

	for ( $i = $this->m_act_record_number; $i < $last; $i++ ) {

	    $fields = '';
	    $values = '';

	    $zip_code = $this->m_a_zipcodes[ $zip_rand = rand( 0, $count_zips - 1 ) ][ 0 ];
	    $city = $this->m_a_zipcodes[ $zip_rand ][ 1 ];
	    $surname = $this->m_a_surnames[ rand( 0, $count_surnames - 1 ) ];
	    if ( rand( 0, 150 ) == 5 ) $surname .= '-' . $this->m_a_surnames[ rand( 0, $count_surnames - 1 ) ];

	    $prename = $this->m_a_prenames[ rand( 0, $count_prenames - 1 ) ];
	    if ( rand( 0, 100 ) == 5 ) $prename .= ' ' . $this->m_a_prenames[ rand( 0, $count_prenames - 1 ) ];


	    $street = $this->m_a_streets[ rand( 0, $count_streets - 1 ) ] . ' ' . $this->RandomInt( 1, 200 ) ;

	    for ( $j = 0; $j < count( $this->m_a_changes ); $j++ ) {

		if ( is_null( $this->m_a_changes[ $j ] ) ) continue;	// falls RESET ACTIONS erfolgte, dann null

		if ( strlen( $fields) ) $fields .= ',';
		if ( strlen( $values) ) $values .= ',';

		if ( $this->m_a_changes[ $j ][ 0 ] == self::__IMPORT_INCREMENTED__ ) {

		    // use the fetch object which is the first paramater

		    $this->m_a_changes[ $j ][ 1 ]->GetInsertParts( $str_field_name, $str_value, $this->m_a_variables, $this->m_act_table);

		    $fields .= $str_field_name;
		    $values .= $str_value;

		} elseif ( $this->m_a_changes[ $j ][ 0 ] == self::__IMPORT_BY_FETCH__ ) {

		    // use the fetch object which is the first paramater

		    $this->m_a_changes[ $j ][ 1 ]->GetInsertParts( $str_field_names, $str_values, $this->m_a_variables);

		    $fields .= $str_field_names;
		    $values .= $str_values;

		} elseif ( $this->m_a_changes[ $j ][ 0 ] == self::__IMPORT_CHANGE_SET_RANDOMIZED__ ) {

		    $fields .= $this->m_a_changes[ $j ][ 1 ];
		    $value =  $this->Randomize(
					$this->m_a_changes[ $j ][ 2 ] ,
					$this->m_a_changes[ $j ][ 3 ] ,
					$this->m_a_changes[ $j ][ 4 ] ,
					$this->m_a_changes[ $j ][ 5 ]  )
					;

		    $values .= "'" . $value . "'";


		    $this->m_a_variables[ $this->m_a_changes[ $j ][ 1 ] ]  = $value;


		} elseif ( $this->m_a_changes[ $j ][ 0 ] == self::__IMPORT_CHANGE_SET_SQL__ ) {

		    $fields .= $this->m_a_changes[ $j ][ 1 ];
/*
		    $values .= "'" . $this->Randomize(
						$this->m_a_changes[ $j ][ 2 ],
						$this->m_a_changes[ $j ][ 3 ],
						$this->m_a_changes[ $j ][ 4 ],
						$this->m_a_changes[ $j ][ 5 ] )
						. "'";
*/
		    $values =  $this->m_a_changes[ $j ][ 3 ] ;

		    $this->m_a_variables[ $this->m_a_changes[ $j ][ 1 ] ]  = $this->m_a_changes[ $j ][ 3 ] ;


		} elseif ( $this->m_a_changes[ $j ][ 0 ] == self::__IMPORT_CHANGE_SET__ ) {

		    $fields .= $this->m_a_changes[ $j ][ 1 ];
		    $values .= "'" . $this->m_a_changes[ $j ][ 2 ] . "'";

		    $this->m_a_variables[ $this->m_a_changes[ $j ][ 1 ] ]  = $this->m_a_changes[ $j ][ 2 ] ;


		} elseif ( $this->m_a_changes[ $j ][ 0 ] == self::__IMPORT_CHANGE_USE__ ) {

		    $fields .= $this->m_a_changes[ $j ][ 1 ];

		    if ( $this->m_a_changes[ $j ][ 2 ] == 'ZIPCODE' ) {

 			$values .= "'" . $zip_code . "'";
 			$this->m_a_variables[ $this->m_a_changes[ $j ][ 1 ] ]  = $zip_code ;

		    } elseif ( $this->m_a_changes[ $j ][ 2 ] == 'SURNAME' ) {

 			$values .= "'" . $surname . "'";
 			$this->m_a_variables[ $this->m_a_changes[ $j ][ 1 ] ]  = $surname ;

		    } elseif ( $this->m_a_changes[ $j ][ 2 ] == 'PRENAME' ) {

 			$values .= "'" . $prename . "'";
 			$this->m_a_variables[ $this->m_a_changes[ $j ][ 1 ] ]  = $prename ;

		    } elseif ( $this->m_a_changes[ $j ][ 2 ] == 'STREET' ) {

 			$values .= "'" . $street . "'";
 			$this->m_a_variables[ $this->m_a_changes[ $j ][ 1 ] ]  = $street ;

		    } elseif ( $this->m_a_changes[ $j ][ 2 ] == 'CITY' ) {

 			$values .= "'" . $city . "'";
 			$this->m_a_variables[ $this->m_a_changes[ $j ][ 1 ] ]  = $city ;

		    } elseif ( $this->m_a_changes[ $j ][ 2 ] == 'UNIQUE' ) {

 			$values .= "'" . $i . "'";
 			$this->m_a_variables[ $this->m_a_changes[ $j ][ 1 ] ]  = $i ;

		    }



		}



	    }


	    $sql = $prefix . $fields . $middle . $values . $suffix;

	    fwrite( $this->m_filehandle_export, $sql );

	}	// for

// 	fwrite( $this->m_filehandle_export, $commit );

	$this->m_act_record_number = $i ;

	$this->m_obj_colors->ColoredCLI( "\n data generated out of $count_zips zip codes and cities, $count_surnames surnames, $count_prenames prenames and $count_streets streets", 'green' );

    }	// function DoTheExport( )

    function __construct( ) {			// cCommand

	$this->m_obj_colors = new cColorsCLI( );

    }	// function __construct( )

    function __destruct( ) {			// cCommand

	$this->CloseExportFile( );


    }	// function __destruct( )

    protected function CloseExportFile( ) {

	if ( is_resource( $this->m_filehandle_export ) ) {

	    fwrite( $this->m_filehandle_export, chr( 10 ) . 'COMMIT;' . chr( 10 ) );

	    fclose( $this->m_filehandle_export );

	}


    }	// function CloseExportFile( )


    protected function OpenExportFile( ) {

	// if the path does not exist, then create it

	$dir = dirname( $this->m_act_filename_export );

	$this->MakePath( $dir );

	//

	$this->m_filehandle_export = fopen( $this->m_act_filename_export, 'w+' );

	if ( ! is_resource( $this->m_filehandle_export ) ) {
	    die( "\n program crashed: could not open file '{$this->m_act_filename_export}'" );
	}

	fwrite( $this->m_filehandle_export, "/* Randomized sql data for mysql database generated with mk-test-data.php ( Rainer Stötter 2016,2017 )*/\n\n\n\n" );

    }	// function OpenExportFile( )

    public function IsDone( ) {

	return $this->m_chr == '';

    }	// function IsDone( )




    protected function ImportTheTextdata( $file_name, $anzahl_spalten, & $ary ) {

      // lädt die Textdaten in $file_name in den Speicher, also in das Feld $ary
      // anzahl_spalten besagt nun, wie viele Spalten in der Textdatei vorkommen
      // es können nur eine oder zwei Spalte(n ) verarbeitet werden
      // bei den ZIP-Daten haben wir etwa zwei Spalten
      // Ein reiner Text hat 0 Spalten

      if ( ! $anzahl_spalten ) {  // der lange Text

	  $ary = str_replace( '"', "`", file_get_contents( $file_name ) );

	  return;

      }

     $filehandle = fopen( $file_name, 'r');

     if ( $filehandle === false ) {

	  die( "\n Error opening {$file_name}" );

      }


      while ( ! feof( $filehandle ) ) {

	  $line = fgets( $filehandle );

	  if ( $anzahl_spalten == 1 ) {

	      $element = trim( $line );
	      if ( strlen( $element ) ) $ary[] = $element ;

	  } elseif ( $anzahl_spalten == 2 ) {

	      $line = trim( $line );
	      $pos = 0;
	      $chr = substr( $line, 0, 1 );
	      while ( ( $chr != '' ) && ( ! ctype_space( $chr ) ) ) { $pos++; $chr = substr( $line, $pos, 1 ); }

	      $element = array(
			      trim( substr( $line, 0, $pos -1 ) ),
			      trim( substr( $line, $pos ) )
			  );

	      if ( ( strlen( $element[0] ) ) && ( strlen( $element[1] ) ) ) $ary[]= $element ; $ary[]= $element;

	  } else {

	      die("\n program aborted: cannot handle $anzahl_spalten columns!");

	  }

      }


      echo "\n..". $this->m_obj_colors->ColoredCLI( 'imported ' . count( $ary ) . ' records from ' . $file_name,  'dark_gray' ) ;

      if ( is_resource( $filehandle ) ) fclose( $filehandle );


    }	// function ImportTheTextdata( )

    protected function ImportTextData( $token, $file_name )  {

	// läddt die Textdaten, die zu $token gehören, in das entsprechende Feld
	// token könmnen sein: 'PRENAMES', 'SURNAMES, ', 'STREETS', 'ZIPCODES'

	$ary = null;

	    $token = strtoupper( $token );

    	    if (  $token == 'PRENAMES' ) {
		$ary = & $this->m_a_prenames;
		$anzahl_spalten = 1;
    	    } elseif (  $token == 'SURNAMES' ) {
		$ary = & $this->m_a_surnames;
		$anzahl_spalten = 1;
    	    } elseif (  $token == 'STREETS' ) {
		$ary = & $this->m_a_streets;
		$anzahl_spalten = 1;
    	    } elseif (  $token == 'ZIPCODES' ) {
		$ary = & $this->m_a_zipcodes;
		$anzahl_spalten = 2;
	    } elseif (  $token == 'TEXT' ) {
		$ary = & $this->m_long_text;
		$anzahl_spalten = 0;
    	    } else {
		die( "\n program crashed: READ FROM with unknown token '{$token}'" );
    	    }

    	    $this->ImportTheTextdata( $file_name, $anzahl_spalten, $ary );

    }	// function ImportTextData( )


    protected function GetCh( ) {

	$chr = '';

	$this->m_chr = substr( $this->m_command, ++$this->m_char_index, 1 );

	return $this->m_chr;

    }

    protected function ActCh( ) {

	$chr = '';

// 	echo "" . $this->m_obj_colors->ColoredCLI( $this->m_chr, 'green' );

	return $this->m_chr;

    }    // function ActCh( )

    private function UnGetCh( ) {

	$this->m_char_index--;
	$this->m_chr =  substr( $this->m_command, $this->m_char_index, 1 ) ;

    }	// function UnGetCh( )

    private function RewindTo( $index ) {

	$this->m_char_index = $index;
	$this->m_chr =  substr( $this->m_command, $this->m_char_index, 1 ) ;

    }	// function UnGetCh( )

    private function AssertFollowingSemicolon( ) {

	//
	// abort the program, when there is no following semicolon
	//

	$this->SkipSpaces( );

	if ( $this->m_chr != ';' ) {

	    die( "\n aborting: error: semicolon expected, but '{$this->m_chr}' detected in command '{$this->m_command}'" );

	}


    }	// function AssertFollowingSemicolon( )

    protected function ScanUntilFolgezeichen( $zeichen ) {

      // liest samt dem Folgezechen alles ein und positioniert auf das erste Zeichen danach
      // das Zeichen $zeichen wird NICHT angehängt an das Ergebnis
      // muss vorher auf ein Zeichen nach dem Startzeichen positioniert worden sein


	$content = '';

	assert( strlen( $zeichen ) > 0 );

	if ( ( strlen( $zeichen ) ) && ( $this->m_chr != '' ) )  {

	    while ( ( ( $chr = $this->m_chr) != $zeichen ) && ( $chr != '' ) ) {

		$content .= $chr;
		$this->GetCh( );

	    }
		$this->GetCh( );
// 		$content .= $zeichen;
// 	    if ( $this->m_chr != $zeichen ) echo "\n Warning: ScanUntilFolgezeichen( ) endet auf '$this->m_chr'";
// 	    $this->GetCh( );
	    assert( $this->m_chr != $zeichen );

	}

	if ( $this->m_chr == '' ) {

	    die( "\n aborting: error: expected '$zeichen' but reached the string end in \n $this->m_command" );

	}

	return $content;

    }	// function ScanUntilFolgezeichen( )


    protected function SkipSpaces( ) {

	$count = 0;

	if ( ctype_space( $this->m_chr ) ) {

	    while ( ctype_space( $chr = $this->GetCh( ) )  && ( $chr != '' )) {

		$count++;

	    }
	}

	return $count;

    }	// function SkipComment( )

    protected function is_ctype_identifier( $chr ) {

	return ( $chr == '_' ) || ( ctype_alnum( $chr )  ) ;

    }	// function is_ctype_identifier( )


    protected function is_ctype_number( $chr ) {

	return ( $chr == '.' ) || ( ctype_digit( $chr )  ) ;

    }	// function is_ctype_number( )


    protected function is_ctype_identifier_start( $chr ) {

	return  ( ctype_alnum( $chr ) ) ;

    }	// function is_ctype_identifier_start( )

    protected function is_ctype_number_start( $chr ) {

	return  ( ctype_digit( $chr ) ) ;

    }	// function is_ctype_number_start( )


/*
    protected function ScanNumber( ) {

	    $token = '';

	    if ( ctype_digit( $this->m_chr ) )  {

		$token .= $this->m_chr;

		while ( ( ctype_digit( $chr = $this->GetCh( ) ) ) &&
			( $chr != '' ) &&
			( $chr != ',' ) &&
			( $chr != ';' ) )
			{

		    $token .= $chr;
		}

	    }

	    return $token;

    }	// function ScanNumber( );
*/

    protected function ScanToken( ) {

	    $token = '';

	    if ( $this->is_ctype_identifier_start( $this->m_chr ) )  {

		$token .= $this->m_chr;

		while ( ( $this->is_ctype_identifier( $chr = $this->GetCh( ) ) ) &&
			( $chr != '' ) &&
			( $chr != ',' ) &&
			( $chr != ';' ) )
			{

		    $token .= $chr;
		}

	    }

	    return $token;

    }	// function ScanToken( );


    protected function ScanNumber( ) {

	    $token = '';

	    if ( $this->is_ctype_number_start( $this->m_chr ) )  {

		$token .= $this->m_chr;

		while ( ( $this->is_ctype_number( $chr = $this->GetCh( ) ) ) &&
			( $chr != '' ) &&
			( $chr != ',' ) &&
			( $chr != ';' ) )
			{

		    $token .= $chr;
		}

	    }

	    return $token;

    }	// function ScanNumber( );


      private function NextToken( ) {

	  $pos = $this->m_char_index;

	  $this->SkipSpaces( );
	  $ret = $this->ScanToken( );

	  $this->RewindTo( $pos );

	  return $ret;

      }	// function NextToken( )


    function RandomDateTime( $start_date, $end_date )    {

	// Find a randomized date between $start_date and $end_date

	// Convert to timetamps
	$min = strtotime( $start_date );
	$max = strtotime( $end_date );

	// Generate random number using above bounds
	$val = rand( $min, $max );

	// Convert back to desired date format
	return date( 'Y-m-d H:i:s', $val );

    }   // function RandomDateTime( )


    function RandomDate( $start_date, $end_date )    {

	// Find a randomized date between $start_date and $end_date

	// Convert to timetamps
	$min = strtotime( $start_date );
	$max = strtotime( $end_date );

	// Generate random number using above bounds
	$val = rand( $min, $max );

/*
	if ( $this->m_database_provider == 'ORACLE' ) {
	    return date( 'Y-m-d H:i:s', $val );
	}
*/
	// Convert back to desired date format
	return date('Y-m-d', $val);

    }   // function RandomDate( )


    function RandomInt( $from, $to )    {

	// Find a randomized time between $start_time and $end_time

	$value = rand( $from , $to   );

	return $value;


    }  // function RandomTime( )


    function RandomFloat( $from, $to )    {

	// Find a randomized time between $start_time and $end_time


	if ( rand( 0, 1 ) == 1 ) {

	    $value = rand( $from , $to   ) / rand( 1, 123 ) ;

	 } else {

	    $value = rand( $from , $to   ) * rand( 0, 123 ) ;

	 }

	return $value;


    }  // function RandomFloat( )



    function RandomTime( $from, $to )    {

	// Find a randomized time between $start_time and $end_time


	$value = rand( $from , $to   ) . ":" . str_pad( rand( 0, 59 ), 2, "0", STR_PAD_LEFT);;

	return $value;


    }  // function RandomTime( )

    function RandomBool( )    {

	// Find a randomized time between $start_time and $end_time

	$value = rand( 0, 1  ) ;

	return $value;


    }  // function RandomBool( )

     function RandomPhone( )    {

	// Find a randomized phone number

	$value = '( 0' . $this->RandomInt( 10, 200 ) . ' ) ' . $this->RandomInt( 1, 1111111 ) ;

	return $value;


    }  // function RandomPhone( )

     function RandomIBAN( )    {

	// Find a randomized IBAN number - 22 digits

	$value = 'DE-' . $this->RandomInt( 0, 99 ) . '-' . $this->RandomInt( 1, 99999999999999999 ) ;

	return $value;


    }  // function RandomIBAN( )



    private function RandomASCII( $uplow = '', $max_len = 255 ) {

	$str = '';

	for ( $i = 0; $i < $max_len; $i++ ) {

	    if ( rand( 0, 1 ) ) $str .= chr( rand( 65, 90 ) ) ;
	    else if ( rand( 0, 1 ) ) $str .= chr( rand( 97, 122 ) );

	}

	if ( $uplow == 'U' ) $str = strtoupper( $str );
	elseif ( $uplow == 'L' ) $str = strtolower( $str );

	return $str;

    }	// function RandomASCII( )


     private function RandomBIC( )    {

	// Find a randomized IBAN number - 22 digits

	$value = $this->RandomASCII( 'U', 5 ) . $this->RandomInt( 10, 2000 );

	return $value;


    }  // function RandomBIC( )

     private function RandomBLZ( )    {

	// Find a randomized IBAN number - 22 digits

	$value =  RandomInt( 11111111, 99999999 );

	return $value;


    }  // function RandomBLZ( )



    private function RandomText( $min_len = 0, $max_len = 0 )    {

	// Find a randomized time between $start_time and $end_time

/*
	static $str = '';

	if ( ! strlen( $str ) ) {

	    // $str = file_get_contents( urlencode( 'Texte/Eichendorf - Aus dem Leben eines Taugenichts.txt' ) );
	    $str = file_get_contents( 'Texte/Eichendorf - Aus dem Leben eines Taugenichts.txt' );

	}
*/

	$str = & $this->m_long_text;

	if ( ! strlen( $str ) ) die( 'Kann Textvorlage nicht einlesen!' );

	$value = rand( 0, strlen( $str )  ) ;


	if ( rand( 0, 1 ) ) {

	    $ret = trim( substr( $str, strpos( $str, '.', $value ) + 1 ) );
	    if ( $max_len ) return substr( $ret, 0, $max_len );

	    return $ret;

	}

	$ret = substr( $str, 0, strpos( $str, '.', $value ) );;

	if ( $max_len ) return substr( $ret, 0, $max_len );

	return $ret;

    }  // function RandomText( )

    private function RandomizeTimeType( $data_type, $param1, $param2, $param3  ) {

	$value = '';

	    if ( $param1 == null ) {	// IN oder BETWEEN oder null

		    if ( $data_type == 'DATE' ) {

			$value = $this->RandomDate( ( '- 15 years') , ( '+ 15 years') );

		    } elseif ( $data_type == 'DATETIME' ) {

			$value = $this->RandomDateTime( ( '- 15 years') , ( '+ 15 years') );

		    } elseif ( $data_type == 'TIME' ) {

			$value = $this->RandomTime( 0, 23 );

		    }



	    } elseif ( $param1 == 'IN' ) {

	    	if ( $param2 == 'FUTURE' ) {

		    if ( $data_type == 'DATE' ) {

			$value = $this->RandomDate( ( 'now' ) , ( '+ 15 years') );

		    } elseif ( $data_type == 'DATETIME' ) {

			$value = $this->RandomDateTime( ('now' ) , ( '+ 15 years') );

		    } elseif ( $data_type == 'TIME' ) {

			$value = $this->RandomTime( 0, 23 );

		    }


	    	} elseif ( $param2 == 'PAST' ) {

		    if ( $data_type == 'DATE' ) {

			$value = $this->RandomDate( ( 'now' ) , ( '- 15 years') );

		    } elseif ( $data_type == 'DATETIME' ) {

			$value = $this->RandomDateTime( ( 'now' ) , ( '- 15 years') );

		    } elseif ( $data_type == 'TIME' ) {

			$value = $this->RandomTime( 0, 23 );

		    }


		}
	    }

	return $value;

    }	// function RandomizeTimeType( )

    private function RandomizeNormalType(  $data_type, $param1, $param2, $param3 ) {

	if ( $param1 == null ) {

	    if ( $data_type == 'FLOAT' ) {

		return $this->RandomFloat( -200000, + 200000 );

	    } elseif ( $data_type == 'INT' ) {

		return $this->RandomInt( -30000, + 30000 );

	    } elseif ( $data_type == 'BOOLEAN' ) {

		return $this->RandomBool( );

	    }  elseif ( $data_type == 'CHAR' ) {

		return mysql_escape_string ( $this->RandomText( ) );

	    }


	} elseif ( $param1 == "BETWEEN" ) {

	    if ( $data_type == 'FLOAT' ) {

		return $this->RandomFloat( $param2, $param3 );

	    } elseif ( $data_type == 'INT' ) {

		return $this->RandomInt( $param2, $param3 );

	    } elseif ( $data_type == 'BOOLEAN' ) {

		return $this->RandomBool( );

	    }  elseif ( $data_type == 'CHAR' ) {

		return $this->RandomText( $param2, $param3 );

	    }


	}


    }	// function RandomizeNormalType( )


    protected function Randomize( $data_type, $param1, $param2, $param3 ) {

    // falls ( param1 == 'IN' ) dann folgt $param2 mit {FUTURE|PAST}
    // falls ( param1 == 'BETWEEN' ) dann folgen $param2 und $param3 mit je einem Wert

/*
#       set <FIELDNAME> TO  RANDOMIZED {DATE|DATETIME|TIME} IN {PAST|FUTURE}
#       set <FIELDNAME> TO  RANDOMIZED {PHONE|BLZ}
#       set <FIELDNAME> TO  RANDOMIZED {FLOAT|INTEGER|BOOL} [BETWEEN <VALUE>  AND <VALUE>];
*/

// if ( ! $this->StringFoundIn( $token, 'DATE', 'TIME', 'DATETIME', 'PHONE', 'BLZ', 'BIC', 'IBAN', 'FLOAT', 'INT', 'BOOLEAN' ) ) {

	$value = '';

	    if ( $this->StringFoundIn( $data_type, 'DATE', 'TIME', 'DATETIME' ) ) {

		$value = $this->RandomizeTimeType( $data_type, $param1, $param2, $param3 );


	    } elseif ( $this->StringFoundIn( $data_type, 'PHONE', 'BLZ', 'BIC', 'IBAN' ) ) {

		 if ( $data_type == 'PHONE' ) { $value = $this->RandomPhone( ); }
		 elseif ( $data_type == 'BIC' ) { $value = $this->RandomBIC( ); }
		 elseif ( $data_type == 'IBAN' ) { $value = $this->RandomIBAN( ); }
		 elseif ( $data_type == 'BLZ' ) { $value = $this->RandomBLZ( ); }

	    } elseif ( $this->StringFoundIn( $data_type, 'FLOAT', 'INT', 'BOOLEAN', 'CHAR' ) ) {
		  // echo "\n Randomize( ) : float gefunden type = $data_type und p1 = $param1 und p2 = $param2 und p3 = $param3";


		$value = $this->RandomizeNormalType(  $data_type, $param1, $param2, $param3 );

	    }

	return $value;

    }	// function Randomize( )

      static public function StringFoundIn( $cmp ) {

	  // die Zeichenkette $cmp in den auf $cmp folgenden Paramtern suchen

	  $numargs = func_num_args();

	  $arg_list = func_get_args();

	  for ( $i = 1; $i < $numargs; $i++ ) {
	      if ( $arg_list[ $i ] == $cmp ) return true;

	  }

	  return false;

      }	// function StringFoundIn( );


    public function ExecuteCommand( $command ) {

	// interpretiert $command und führt den Befehl dann aus
	// führt einen mittels ReadCommand( ) eingelesen Befehl $command aus

	$this->m_command = trim( $command );

	$this->m_char_index = -1;
	$this->GetCh( );

// 	echo "\nexecuting:\n" . $this->m_obj_colors->ColoredCLI( $command, 'yellow' ) ;

	$token_next = strtoupper( $this->NextToken( ) );

	if ( $token_next == 'DATABASE' ) {

	    $this->SkipSpaces( );
	    $token = $this->ScanToken( );

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if ( $token != 'PROVIDER' ) {
		die ( "\n Program crashed: DATABASE without PROVIDER detected" );
	    }

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if ( $token != 'IS' ) {
		die ( "\n Program crashed: DATABASE PROVIDER without IS detected" );
	    }

	    $this->SkipSpaces( );

	    if ( $this->FollowsDelimiter( ) ) {
		$this->GetTextBetweenDelimiters( $token );
	    } else {
		$token = $this->ScanToken( ) ;
	    }

	    $this->m_database_provider = strtoupper( trim( $token ) );
	    if ( $this->m_database_provider == '' ) $this->m_database_provider = 'MYSQL';

	    echo "\n". $this->m_obj_colors->ColoredCLI( 'DATABASE PROVIDER IS ' . $this->m_database_provider,  'dark_gray' ) ;

	    // assert there follows a semicolon
	    $this->AssertFollowingSemicolon( );

	} elseif ( $token_next == 'DO' ) {

	    $this->SkipSpaces( );
	    $token = $this->ScanToken( );

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if ( $token != 'DELETE' ) {
		die ( "\n Program crashed: DO without DELETE detected" );
	    }

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if ( $token != 'FROM' ) {
		die ( "\n Program crashed: DO DELETE without FROM detected" );
	    }

	    $this->SkipSpaces( );

	    if ( $this->FollowsDelimiter( ) ) {
		$this->GetTextBetweenDelimiters( $token );
	    } else {
		$token = $this->ScanToken( ) ;
	    }

	    $table_name = $token;

	    if ( isset( $this->m_a_delete_clauses[ $table_name ] ) ) {
		$where = $this->m_a_delete_clauses[ $table_name ];
	    } else {
		$where = '';
	    }

	    if ( $where == '' ) {
		$this->m_user_defined_code .= "\n DELETE FROM $table_name;";
	    } else {
		$this->m_user_defined_code .= "\n DELETE FROM $table_name where " . $where . ';';
	    }

	    echo "\n". $this->m_obj_colors->ColoredCLI( 'DELETING records with where = ' . $where,  'dark_gray' ) ;

	    // assert there follows a semicolon
	    $this->AssertFollowingSemicolon( );

	} elseif ( $token_next == 'INCREMENT' ) {

# increment 'ID_ADDRESS' depending from 'ID_MANDANT, ID_BUCHUNGSKREIS'

		// Inkrement-Spezifizierer wurde angegeben

		// 'INCREMENT' überspringen

		$this->ScanToken( );

		$this->SkipSpaces( );

		$zeichen = $this->ActCh( );

		// zunächst die Feldliste einlesen

		$this->GetTextBetweenDelimiters( $field_name );

		if ( strtoupper ( $this->NextToken( ) ) != 'DEPENDING' ) die( "\n INCREMENT without DEPENDING" );

		// 'DEPENDING' überspringen

		$this->ScanToken( );

		$this->SkipSpaces( );

		if ( strtoupper ( $this->NextToken( ) ) != 'ON' ) die( "\n INCREMENT DEPENDING without ON" );

		// 'DEPENDING' überspringen

		$this->ScanToken( );

		$this->SkipSpaces( );

		// die zweite Feldliste einlesen

		$this->GetTextBetweenDelimiters( $str_increment );

		$a_increment_vars = explode( ',', $str_increment );

		foreach( $a_increment_vars as & $var ) { $var = trim( $var ); }

	    // eventuell noch Feldvariablen ersetzen?

	    foreach ( $this->m_a_fetched as $fetched ) {

		$fetched->ReplaceFieldVars( $str_sql );

	    }

	    $obj_command_increment = new cCommandIncrement( $field_name, $a_increment_vars, $this->m_database_provider );

	    $this->m_a_incremented[] = $obj_command_increment;

	    // Die Abbilldungsvorschrift definieren
	    $this->m_a_changes[]= array( self::__IMPORT_INCREMENTED__, $obj_command_increment );

	    // assert there follows a semicolon
	    $this->AssertFollowingSemicolon( );



	} elseif ( $token_next == 'FETCH' ) {

	    // Das Token 'FETCH' überspringen

	    $this->SkipSpaces( );
	    $token = $this->ScanToken( );
	    $this->SkipSpaces( );

	    //

	    $str_fields = '';
	    $str_sql = '';
	    $fertig = false;

	    $this->GetTextBetweenDelimiters( $str_fields );

	    $a_fields = explode( ',', $str_fields );
	    foreach( $a_fields as & $var ) { $var = trim( $var ); }

	    // Das Token 'USING' überspringen

	    $this->SkipSpaces( );
	    $token = $this->ScanToken( );

	    // wenn ein using folgt, dann haben wir alle Felder eingelesen
	    if ( strtoupper( $token ) != 'USING' ) die("\n USING erwartet, aber '{$token}' erhalten");

	    // read the sql-command
	    $this->SkipSpaces( );

	    $this->GetTextBetweenDelimiters( $str_sql );

	    if ( is_null( $this->m_mysqli ) ) die( "\n Abbruch: ohne DB_PARAMS ist FETCH nicht möglich" );

	    // eventuell noch Feldvariablen ersetzen?

	    foreach ( $this->m_a_fetched as $fetched ) {

		$fetched->ReplaceFieldVars( $str_sql );

	    }

	    $obj_command_fetch = new cCommandFetch( $this->m_mysqli, $a_fields, $str_sql, $this->m_a_variables );

	    $this->m_a_fetched[] = $obj_command_fetch;

	    // Die Abbilldungsvorschrift definieren
	    $this->m_a_changes[]= array( self::__IMPORT_BY_FETCH__, $obj_command_fetch );

	    // assert there follows a semicolon
	    $this->AssertFollowingSemicolon( );


	} elseif ( $token_next == 'DBPARAMS' ) {


	    // Das Token 'dbparams' überspringen

	    $this->SkipSpaces( );
	    $token = $this->ScanToken( );
	    $this->SkipSpaces( );

	    //
;
//	    $ch = $this->GetCh( );

	    if ( $this->m_chr != '=' ) die ( "\n Abbruch: Fehler in dbparams: '=' erwartet anstatt von '{$ch}' " );

	    // überspringe '='
  	    $this->GetCh( );

	    $this->SkipSpaces( );

	    // Parameter einlesen


	    $this->GetTextBetweenDelimiters( $params );

	    // überspringe das Endzeichen
	    $this->SkipSpaces( );

	    // ask the user for missing credentials

	    echo "\n trying to connect to '{$this->m_database_provider}'";
	    $obj_command_database_params = new cCommandDatabaseParams( $params, $this->m_database_provider );
	    $this->m_mysqli = $obj_command_database_params->GetOpenedDatabase( );

	    // assert there follows a semicolon
	    $this->AssertFollowingSemicolon( );


	} elseif ( $token_next == 'DELETE' ) {

	    $this->SkipSpaces( );
	    $token = $this->ScanToken( );

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if  ( $token != 'CLAUSE' )  {
		die ( "\n Program crashed: DO without DELETE" );
	    }

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if  ( $token != 'FOR' )  {
		die ( "\n Program crashed: DO without DELETE" );
	    }

	    $this->SkipSpaces( );

	    if ( $this->FollowsDelimiter( ) ) {
		$this->GetTextBetweenDelimiters( $field_name );
	    } else {
		$token = $this->ScanToken( ) ;
	    }

	    $table_name = $token;

	    if  ( $table_name == '' )  {
		die ( "\n Program crashed: DO DELETE with empty tablename" );
	    }

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if  ( $token != 'IS' )  {
		die ( "\n Program crashed: DO DELETE without IS" );
	    }


	    $this->SkipSpaces( );

/*
	    if ( $this->m_chr !== '"' ) {
		die ( "\n Program crashed: DELETE CLAUSE without leading delimiter" );
	    }

 	    $this->GetCh( );
	    $clause = $this->ScanUntilFolgezeichen( '"' );
*/

	    $this->GetTextBetweenDelimiters( $clause );

	    $this->m_a_delete_clauses[ $table_name ] = $clause;

	    echo "\n". $this->m_obj_colors->ColoredCLI( "delete clause for table '$table_name' detected ", 'dark_gray' ) ;

	    // assert there follows a semicolon
	    $this->AssertFollowingSemicolon( );


	} elseif ( $token_next == 'WORK' ) {

	    $this->SkipSpaces( );
	    $token = $this->ScanToken( );

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if ( $token != 'ON' ) {
		die ( "\n Program crashed: WORK without ON detected" );
	    }

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if ( $token != 'TABLE' ) {
		die ( "\n Program crashed: WORK ON without TABLE detected" );
	    }

	    $this->SkipSpaces( );

	    if ( $this->FollowsDelimiter( ) ) {
		$this->GetTextBetweenDelimiters( $token );
	    } else {
		$token = $this->ScanToken( );
	    }

	    if ( $token === '' ) {
		die ( "\n Program crashed: WORK ON TABLE without table" );
	    }

	    $this->m_act_table = $token;
	    echo "\n". $this->m_obj_colors->ColoredCLI( 'Working on ' . $token,  'dark_gray' ) ;

	    // assert there follows a semicolon
	    $this->AssertFollowingSemicolon( );


	} elseif ( $token_next == 'START' ) {

	    $this->SkipSpaces( );

	    $token = $this->ScanToken( );
	    $this->SkipSpaces( );

// 	    if ( strtoupper( $this->NextToken( ) == 'WITH' ) ) {

		$token = strtoupper( $this->ScanToken( ) );

		if ( $token != 'WITH' ) {
		    die ( "\n Program crashed: START without WITH detected" );
		}

		$this->SkipSpaces( );
		$token = strtoupper( $this->ScanToken( ) );

		if ( $token != 'RECORD' ) {
		    die ( "\n Program crashed: START WITH without RECORD detected" );
		}

		$this->SkipSpaces( );
		$token = $this->ScanNumber( );

		if ( $token === '' ) {
		    die ( "\n Program crashed: START WITH RECORD without record number" );
		}

		$this->m_act_record_number = $token;
		echo "\n". $this->m_obj_colors->ColoredCLI( 'Starting with record ' . $token,  'dark_gray' ) ;
/*
	    } else {

		die( "\n Program crashed: START with unknown token '$token_next'" );

	    }
*/

	    // assert there follows a semicolon
	    $this->AssertFollowingSemicolon( );


	} elseif ( $token_next == 'EXPORT' ) {

	    $this->SkipSpaces( );
	    $token = $this->ScanToken( );

	    $this->SkipSpaces( );
	    $token = $this->ScanNumber( );

	    if ( $token === '' ) {
		die ( "\n Program crashed: EXPORT without record count" );
	    }

	    $this->m_records_to_export = $token;

	    $this->SkipSpaces( );
	    $token = $this->ScanToken( );

	    if ( $token === '' ) {
		die ( "\n Program crashed: EXPORT without RECORDS" );
	    }

	    echo "\n". $this->m_obj_colors->ColoredCLI( 'Exporting ' . $this->m_records_to_export . ' records ',  'dark_gray' ) ;

	    // assert there follows a semicolon
	    $this->AssertFollowingSemicolon( );


	} elseif ( $token_next == 'INCLUDE' ) {

	    $this->SkipSpaces( );
	    $token = $this->ScanToken( );

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if  ( $token != 'TEXT' )  {
		die ( "\n Program crashed: INCLUDE without TEXT" );
	    }

	    $this->SkipSpaces( );

	    if  ( $this->m_chr != '=' )  {
		die ( "\n Program crashed: INCLUDE TEXT without '=' " );
	    }
	    $this->GetCh( );
/*
	    $this->SkipSpaces( );
	    if ( $this->m_chr !== '"' ) {
		die ( "\n Program crashed: INCLUDE without leading delimiter" );
	    }

 	    $this->GetCh( );
	    $token = $this->ScanUntilFolgezeichen( '"' );
*/

	    $this->GetTextBetweenDelimiters( $token );

	    if ( $token === '' ) {
		echo ( "\n Warning: INCLUDE with empty string " );
	    }

	    $this->m_user_defined_code .= $token;

	    echo "\n". $this->m_obj_colors->ColoredCLI( 'included string constant', 'dark_gray' ) ;

	    // assert there follows a semicolon
	    $this->AssertFollowingSemicolon( );

	} elseif ( $token_next == 'READ' ) {

	    // skip 'FROM'
	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if ( $token != 'READ' ) die( "\n program crashed: READ expected and found '{$token}'" );

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if ( ( $token != 'PRENAMES' ) && ( $token != 'SURNAMES' ) && ( $token != 'STREETS' ) && ( $token != 'ZIPCODES' ) && ( $token != 'TEXT' ) ){
		die ( "\n Program crashed: Don't know what to READ FROM" );
	    }

	    $this->m_read_mode = $token;

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if ( $token != 'FROM' ) {
		die ( "\n Program crashed: READ without FROM detected" );
	    }


	    $this->SkipSpaces( );

/*
	    if ( $this->m_chr !== '"' ) {
		die ( "\n Program crashed: READ without Filename" );
	    }

 	    $this->GetCh( );
	    $token = trim( $this->ScanUntilFolgezeichen( '"' ) );

	    if ( $token === '' ) {
		die ( "\n Program crashed: READ with empty filename" );
	    }

*/

	    $this->GetTextBetweenDelimiters( $token );

	    $this->m_act_filename_import = $token;

	    echo "\n". $this->m_obj_colors->ColoredCLI( 'Importing records from ' . $token,  'dark_gray' ) ;
	    $this->ImportTextData( $this->m_read_mode, $this->m_act_filename_import );

	    // assert there follows a semicolon
	    $this->AssertFollowingSemicolon( );


	} elseif ( $token_next == 'USE' ) {

	    $this->SkipSpaces( );
	    $token = $this->ScanToken( );

	    $this->SkipSpaces( );

	    if ( $this->FollowsDelimiter( ) ) {
		$this->GetTextBetweenDelimiters( $token );
	    } else {
		$token = $this->ScanToken( );
	    }

	    if ( $token == '' ) {
		die ( "\n Program crashed: USE without column name" );
	    }

	    $field_name = $token;

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if ( $token != 'AS' ) {
		die ( "\n Program crashed: USE without AS" );
	    }

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if ( ( $token != 'PRENAME' ) && ( $token != 'SURNAME' ) && ( $token != 'STREET' ) && ( $token != 'ZIPCODE' ) && ( $token != 'CITY' ) && ( $token != 'UNIQUE' ) ){
		die ( "\n Program crashed: Don't know what to USE" );
	    }

	    $array_name = $token;

	    echo "\n". $this->m_obj_colors->ColoredCLI( "Using column $field_name as $array_name",  'dark_gray' ) ;

	    // Die Abbilldungsvorschrift definieren
	    $this->m_a_changes[]= array( self::__IMPORT_CHANGE_USE__, $field_name, $array_name );

	    // assert there follows a semicolon
	    $this->AssertFollowingSemicolon( );


	}  elseif ( $token_next == 'SET' ) {

	    $this->SkipSpaces( );
	    $token = $this->ScanToken( );

	    $this->SkipSpaces( );

	    if ( $this->FollowsDelimiter( ) ) {
		$this->GetTextBetweenDelimiters( $token );
	    } else {
		$token = $this->ScanToken( );
	    }

	    if ( $token == '' ) {
		die ( "\n Program crashed: SET without column name" );
	    }

	    $field_name = $token;

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if ( $token != 'TO' ) {
		die ( "\n Program crashed: SET without TO ( got {$token} ) in \n $this->m_command" );
	    }

	    $this->SkipSpaces( );
	    // $token = strtoupper( $this->ScanToken( ) );

	    if ( $this->FollowsDelimiter( ) ) {

/*
		if ( $this->m_chr == '"' ) {

		    $this->GetCh();
		    $token = $this->ScanUntilFolgezeichen( '"' );
		    $this->GetCh( );

		} else {

		    die ( "\n Program crashed: SET without string constant? " );

		}
*/

		$this->GetTextBetweenDelimiters( $token );

		// leere Zeichenketten sind erlaubt

		$value = $token;

		echo "\n". $this->m_obj_colors->ColoredCLI( "Setting column '$field_name' to value '$value'",  'dark_gray' ) ;

		// Die Abbilldungsvorschrift definieren
		$this->m_a_changes[]= array( self::__IMPORT_CHANGE_SET__, $field_name, $value );

	    } else {

		$param1 = $param2 = $param3 = null;

		$this->SkipSpaces( );
		$token = strtoupper( $this->ScanToken( ) );

/*
		if ( $token != 'RANDOMIZED' ) {
		    die ( "\n Program crashed: set column name to without RANDOMIZED" );
		}
*/

		if ( ! $this->StringFoundIn( $token, 'RANDOMIZED', 'SQL' ) ) {
		    die ( "\n Program crashed: set column name : RANDOMIZED or SQL expected, but received '$token'" );
		}

		if ( $token == 'RANDOMIZED' ) {

		    $this->SkipSpaces( );
		    $token = strtoupper( $this->ScanToken( ) );

		    if ( ! $this->StringFoundIn( $token, 'DATE', 'TIME', 'DATETIME', 'PHONE', 'BLZ', 'BIC', 'IBAN', 'FLOAT', 'INT', 'BOOLEAN', 'CHAR' ) ) {
			die ( "\n Program crashed: set column name to with unknown data type '$token'" );
		    }

		    $data_type = $token;

		    if ( strtoupper( $this->NextToken( ) ) == 'IN' ) {

			$this->SkipSpaces( );
			$token = strtoupper( $this->ScanToken( ) );

			$param1 = $token;

			$this->SkipSpaces( );

			$token = strtoupper( $this->ScanToken( ) );

			if ( ! $this->StringFoundIn( $token, 'PAST', 'FUTURE' ) ) {
			    die ( "\n Program crashed: only PAST or FUTURE is allowed here" );
			}

			$param2 = $token;

		    } elseif ( strtoupper( $this->NextToken( ) ) == 'BETWEEN' ) {

			// skip 'BETWEEN'
			$this->SkipSpaces( );
			$token = strtoupper( $this->ScanToken( ) );

			$param1 = $token;

			$this->SkipSpaces( );
			$token = strtoupper( $this->ScanNumber( ) );

			$param2 = $token;

			$this->SkipSpaces( );
			$token = strtoupper( $this->ScanToken( ) );

			if ( $token != 'AND' ) {
			    die ( "\n Program crashed: BETWEEN without AND" );
			}

			$this->SkipSpaces( );
			$token = strtoupper( $this->ScanNumber( ) );


			$param3 = $token;

		    }

		    // Die Abbilldungsvorschrift definieren
		    $this->m_a_changes[]= array( self::__IMPORT_CHANGE_SET_RANDOMIZED__, $field_name, $data_type, $param1, $param2, $param3 );

		    echo "\n". $this->m_obj_colors->ColoredCLI( "Randomizing column '$field_name' ",  'dark_gray' ) ;

/*

Abbildungsvorschrift von __IMPORT_CHANGE_SET_RANDOMIZED__ mit einem FLOAT mit BETWEEN

Array

0      __IMPORT_CHANGE_SET_RANDOMIZED__				Randomize	RandomizeNormalType
1	fieldname
2	datatype				'FLOAT'		'FLOAT'		'FLOAT'
3	param1					'BETWEEN'	'BETWEEN'	'BETWEEN'
4	param2					float_1		float_1		float_1
5	param3					float_2		float_2		float_2


*/


		} elseif ( $token == 'SQL' ) {

		    $this->SkipSpaces( );

/*

		    if ( $this->m_chr == '"' ) {

			$this->GetCh();
			$token = $this->ScanUntilFolgezeichen( '"' );
			$this->GetCh( );

		    } else {

			die ( "\n Program crashed: SET TO SQL without string constant? " );

		    }
*/

		    $this->GetTextBetweenDelimiters( $token );

		    // Die Abbilldungsvorschrift definieren
		    $param1 = $token;
		    $this->m_a_changes[]= array( self::__IMPORT_CHANGE_SET_SQL__, $field_name, $data_type = null, $param1, $param2 = null, $param3 = null );

		    echo "\n". $this->m_obj_colors->ColoredCLI( "Setting column to SQL '$token' ",  'dark_gray' ) ;

		} else {
		}
	    }

	    // assert there follows a semicolon
	    $this->AssertFollowingSemicolon( );


	}  elseif ( $token_next == 'RUN' ) {

	    $this->SkipSpaces( );
	    $token = $this->ScanToken( );

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if ( $token != 'THE' ) {
		die ( "\n Program crashed: RUN without THE" );
	    }

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if ( $token != 'EXPORT' ) {
		die ( "\n Program crashed: RUN without EXPORT" );
	    }

	    // assert there follows a semicolon
	    $this->AssertFollowingSemicolon( );

	    echo "\n". $this->m_obj_colors->ColoredCLI( "running the export to file '$this->m_act_filename_export'",  'dark_gray' ) ;
	    $this->DoTheExport( );


	} elseif ( $token_next == 'FILENAME' ) {

	    $this->SkipSpaces( );
	    $token = $this->ScanToken( );

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if ( $token != 'IS' ) {
		die ( "\n Program crashed: FILENAME without IS" );
	    }

	    $this->SkipSpaces( );

/*
	    // $token = strtoupper( $this->ScanToken( ) );
	    if ( $this->m_chr == '"' ) {

		$this->GetCh();
		$token = $this->ScanUntilFolgezeichen( '"' );
		$this->GetCh( );

	    } else {

		die ( "\n Program crashed: FILENAME without string constant? " );

	    }
*/

	    $this->GetTextBetweenDelimiters( $token );
	    // leere Zeichenketten sind erlaubt

// 	    if ( is_resource( $this->m_filehandle_export ) ) fclose( $this->m_filehandle_export );

	    $this->CloseExportFile( );

	    $this->m_act_filename_export = $token;

	    $this->OpenExportFile( );

	    echo "\n". $this->m_obj_colors->ColoredCLI( "exporting now to file '$token' ",  'dark_gray' ) ;

	    // assert there follows a semicolon
	    $this->AssertFollowingSemicolon( );

	} elseif ( $token_next == 'RESET' ) {

	    $this->SkipSpaces( );
	    $token = $this->ScanToken( );

	    $this->SkipSpaces( );
	    $token = strtoupper( $this->ScanToken( ) );

	    if ( ( $token != 'DATA' ) && ( $token != 'ACTIONS' ) && ( $token != 'CODE' ) ) {
		die ( "\n Program crashed: RESET what?" );
	    }

	    if ( $token == 'DATA' ) {
		$this->ResetData( );
		echo "\n". $this->m_obj_colors->ColoredCLI( "resetting data",  'red' ) ;
	    } elseif ( $token == 'ACTIONS' ) {
		$this->ResetActions( );
		echo "\n". $this->m_obj_colors->ColoredCLI( "resetting actions",  'red' ) ;
	    } elseif ( $token == 'CODE' ) {
		$this->ResetCode( );
		echo "\n". $this->m_obj_colors->ColoredCLI( "resetting included code",  'red' ) ;
	    }

	    // assert there follows a semicolon
	    $this->AssertFollowingSemicolon( );

	} else {

	    die( "\n Program crashed: Unknown command '{$token_next}' in '$this->m_command'" );

	}

    }	// function ExecuteCommand( )

    protected static function MakePath( $fname ) {

    // create folder recursively

        $f = explode( '/', $fname);
        $acc = '';
        for( $i = 0; $i <= count( $f ) - 1; $i++) {
            $acc .= $f[ $i ]."/";
            if ( !file_exists( $acc ) ) @mkdir( $acc );
        }

    }   // function MakePath( )


}	// class cCommand





class cTestdatenGenerator {

  protected $m_filehandle = null;

  protected $m_script_name = 'mk_test_data.cmd';

  protected $m_obj_config = null;			// cConfigFile
  protected $m_obj_command = null;			// cCommand
  protected $m_obj_colors = null;			// cColorsCLI
  protected $m_start_time = 0;				// Zeitpunkt, als das Programm gestartet wurde

  function __construct( $script_name ) {	// cTestdatenGenerator

      $this->m_start_time = microtime(true);

      $this->m_script_name = $script_name;


      $this->m_obj_config = new cConfigFile( $this->m_script_name );
      $this->m_obj_colors = new cColorsCLI( );


  }	// function __construct( )

  function __destruct( ) {		// cTestdatenGenerator

      if ( is_resource( $this->m_filehandle ) ) fclose( $this->m_filehandle );

      echo "\n Memory Peak (System) : " . number_format( memory_get_peak_usage ( true ) / 1024 / 1024, 3, ',', '.'  ) . ' MB ';
      echo "\n Memory Peak (malloc) : " . number_format( memory_get_peak_usage ( false) / 1024 / 1024, 3 , ',', '.' ) . ' MB ';
      echo "\n Time:  " . number_format( ( microtime(true) - $this->m_start_time ), 4) . " Seconds\n";

  }

  public function Execute( ) {

      $this->m_obj_command = new cCommand( );

      while ( ( $cmd = $this->m_obj_config->ReadCommand( ) ) != '' ) {

// 	  echo "\n" . $this->m_obj_colors->ColoredCLI( $cmd, 'yellow' );

	  $this->m_obj_command->ExecuteCommand( $cmd );

      }

//       echo "\n Der generierte Code sieht so aus:" . $this->m_obj_command->m_sql_code;

  }	// function Execute( )

  protected function WriteHeader( ) {

      fwrite( $this->m_filehandle, "/* SQL-Skript generated from {$this->m_application}*/

      BEGIN;

      CREATE TABLE IF NOT EXISTS ADRESSE (
	  ID_MANDANT          INT UNSIGNED NOT NULL,
	  ID_BUCHUNGSKREIS    INT UNSIGNED NOT NULL,
	  ID_ADRESSE    INT UNSIGNED NOT NULL,
	  ID_COUNTRY    INT UNSIGNED NOT NULL,
	  Name          VARCHAR( 200 ) NOT NULL,
	  Vorname       VARCHAR( 200 ) NOT NULL,
	  Strasse       VARCHAR( 200 ) NOT NULL,
	  Ort           VARCHAR( 200 ) NOT NULL,
	  PLZ           VARCHAR( 15 ) NOT NULL,
	  Telefon       VARCHAR( 35 ),

	  key( ID_MANDANT ),
	  key( ID_BUCHUNGSKREIS ),
	  key( Name, Vorname ),
	  key( Ort ),
	  primary key( ID_MANDANT, ID_BUCHUNGSKREIS, ID_ADRESSE )

      ) ENGINE = INNODB CHARACTER SET UTF8;


      DELETE FROM ADRESSE;

      ");

  }	// function WriteHeader( )


}	// class cTestdatenGenerator

$opts = getopt( 'c:', array('cfg:') );
var_dump( $opts );

if ( ( $opts === false ) || ( count( $opts ) == 0 ) ) {
    echo("\n Abbruch: Erwarte Parameter mit Konfigurationsdatei");
    echo("\n mk-test-data.php --cfg <configfile>\n");
} else {
    $obj = new cTestdatenGenerator( $opts['cfg'] ) ;
    $obj->Execute( );
}


?>