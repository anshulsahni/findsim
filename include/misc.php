<?php

	class database
	{
		private static $db_connect;

		public static function connect($database='',$db_user='',$db_pwd='')		//static function to connect to datbase
		{
			self::$db_connect=mysql_connect($database,$db_user,$db_pwd);
			mysql_select_db("");
		}

		public static function disconnect()		//static function to disconnect from database
		{mysql_close(self::$db_connect);}
	}


	class time
	{
		public static function setZone($timeZone='Asia/Calcutta')		//static function to set the time zone of website
		{date_default_timezone_set($timeZone);}
	}

	class random
	{
		public static function generate6digit($table,$att)				//static function to generate 6 digit random numbers
		{
			random_generation:
				$key=rand(100000,999999);
				$result=mysql_query("select * from $table where $att=$key");
				if(mysql_num_rows($result)>0)
					goto random_generation;
				else
					return $key;
		}
	}

?>
