<?
define("FIELD_REQUIRED", true);
define("FIELD_OPTIONAL", false);
define("FIELD_VALID", true);
define("FIELD_INVALID", false);
define("CHARACTER_INVALID", false);
define("CHARACTER_VALID", true);

function valid_email($raw, $is_required = FIELD_OPTIONAL)
{
	if ( trim($raw) != "" )
	{
		if ( preg_match("/^[\+_a-z0-9-]+(\.[._a-z0-9-]+)*@[\.a-z0-9-]+([\.]{1})+([a-z0-9]{2,6})$/i", $raw) )
		{
			return FIELD_VALID;
		}
		else
		{
			return FIELD_INVALID;
		}
	}
	else
	{
		return ( ! $is_required );
	}
}

function valid_us_phone($raw, $is_required = FIELD_OPTIONAL)
{
	if ( trim($raw) != "" )
	{
		if ( preg_match("/^[2-9]{1}[0-9]{2}-[0-9]{3}-[0-9]{3}$/", $raw) )
		{
			return FIELD_VALID;
		}
		else
		{
			return FIELD_INVALID;
		}
	}
	else
	{
		return ( ! $is_required );
	}
}

function valid_text($raw, $is_required = FIELD_OPTIONAL, $allowed_specials = "", $allowed_groups = array())
{
	if ( trim($raw) != "" )
	{
		// Set allowed group defaults
		$allowed_groups["letter"]  = ( isset($allowed_groups["letter"])  ? $allowed_groups["letter"]  : CHARACTER_VALID );
		$allowed_groups["number"]  = ( isset($allowed_groups["number"])  ? $allowed_groups["number"]  : CHARACTER_VALID );
		$allowed_groups["special"] = ( isset($allowed_groups["special"]) ? $allowed_groups["special"] : CHARACTER_VALID );
		
		// Create the regular expression pattern based on the inputs
		$pattern = "";
		if ( $allowed_groups["letter"] == CHARACTER_VALID )
		{
			$pattern .= "\\w";
		}
		if ( $allowed_groups["number"] == CHARACTER_VALID )
		{
			$pattern .= "\\d";
		}
		if ( $allowed_groups["special"] == CHARACTER_VALID  &&  $allowed_specials != "" )
		{
			// Escape each character given
			for ($char = 0; $char < strlen($allowed_specials); $char++)
			{
				$pattern .= "\\".substr($allowed_specials, $char, 1);
			}
		}
		
		if ( preg_match("/^[".$pattern."]+$/", $raw) )
		{
			return FIELD_VALID;
		}
		else
		{
			return FIELD_INVALID;
		}
	}
	else
	{
		return ( ! $is_required );
	}
}

