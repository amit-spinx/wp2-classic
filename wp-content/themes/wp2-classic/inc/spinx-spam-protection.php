<?php
/**
 * Gravity Forms Global Field Validation Hooks
 *
 * This file contains custom validation logic to detect gibberish input,
 * block spam email domains, and ensure better spam protection.
 *
 * @package CustomGravityValidation
 */

// Hook into Gravity Forms field validation filter.
add_filter('gform_field_validation', 'global_field_validation_logic', 10, 4);

/**
 * Global validation logic for all form fields.
 *
 * Validates text, email, and textarea fields for gibberish and spammy patterns.
 *
 * @param array  $result The validation result array.
 * @param string $value  The submitted value.
 * @param array  $form   The full form object.
 * @param array  $field  The individual field object.
 * @return array Modified result array with validation status and message.
 */
function global_field_validation_logic($result, $value, $form, $field) {
	if ($result['is_valid'] === false) {
		return $result; // Skip if already marked invalid by other validation.
	}

	if(empty($value)) return $result;

	$field_type = rgar($field, 'type');

	switch ($field_type) {
		case 'text':
			if (is_gibberish($value)) {
				$result['is_valid'] = false;
				$result['message']  = 'Your input appears to be invalid or spammy.';
			}
			break;

		case 'email':
			if (!empty($value) && is_email($value)) {
				$email_parts = explode('@', $value);
				$domain      = strtolower(array_pop($email_parts));
				if (is_blocked_email_domain($domain)) {
					$result['is_valid'] = false;
					$result['message']  = 'Please use a valid business or personal email address.';
				}
			}
			break;

		case 'textarea':
			if (is_textarea_gibberish($value)) {
				$result['is_valid'] = false;
				$result['message']  = 'Your input appears to be invalid or spammy.';
			}
			break;
	}

	return $result;
}

/**
 * Detects if a word is gibberish based on length, vowel ratio, and repetition patterns.
 *
 * @param string $word The input word to check.
 * @return bool True if word is gibberish, false otherwise.
 */
function is_gibberish($word) {
	if (empty($word)) {
		return true;
	}

	$cleaned = strtolower(trim($word));
	$cleaned = preg_replace('/\s+/', '', $cleaned);
	$length  = strlen($cleaned);

	if ($length < 2 || $length > 30) {
		return true;
	}

	preg_match_all('/[aeiou]/', $cleaned, $matches);
	$vowels = count($matches[0]);
	$ratio  = $vowels / $length;

	// Check vowel ratio and repeated characters.
	if ($ratio < 0.25) {
		return true;
	}
	if (preg_match('/([a-z])\1{2,}/', $cleaned)) {
		return true;
	}
	if (preg_match('/^(.{2,4})\1+$/', $cleaned)) {
		return true;
	}

	return false;
}

/**
 * Checks if a textarea input contains mostly gibberish words.
 *
 * @param string $text The textarea input value.
 * @return bool True if mostly gibberish, false otherwise.
 */
function is_textarea_gibberish($text) {
	if (empty($text)) {
		return true;
	}

	$words           = preg_split('/\s+/', strtolower(trim($text)));
	$gibberish_count = 0;
	$total           = 0;

	foreach ($words as $word) {
		$word = preg_replace('/[^a-z]/', '', $word);
		if (strlen($word) < 2) {
			continue;
		}
		$total++;
		if (is_gibberish($word)) {
			$gibberish_count++;
		}
	}

	if ($total === 0) {
		return false;
	}

	return ($gibberish_count / $total) > 0.5;
}

/**
 * Checks if an email domain is in the list of known spam or disposable domains.
 *
 * @param string $domain Email domain part to check.
 * @return bool True if domain is blocked, false otherwise.
 */
function is_blocked_email_domain($domain) {
	$blocked_domains = [
		'mailinator.com', 'tempmail.com', '10minutemail.com', 'guerrillamail.com',
		'yopmail.com', 'fakeinbox.com', 'trashmail.com', 'jourrapide.com', 'armyspy.com',
		'rhyta.com', 'gamil.com', 'temporary-mail.net', 'teleworm.us', 'dayrep.com',
		'gmial.com', 'gmaiul.com', 'gmzil.com', 'gmsg.com', 'gmsil.com', 'gmaii.com',
		'dxirl.com', 'pacfut.com', 'mytaemin.com', 'lhory.com', 'aminating.com',
		'voze.com', 'bltiwd.com', 'jxbav.com', 'qejjyl.com', 'xkxkud.com', 'hosintoy.com',
		'ofacer.com', 'datingso.com', 'iridales.com', 'cmhvzylmfc.com', 'yuik.tery.com',
		'best-vpn.xyz', 'dtect.com', 'vo7m.com', 'gmsil.vo7m', 'domian.com',
		'gmx.com', 'aim.com', 'salpingomyu.ru', 'pepperdine.edu', '1ti.ru', 'mail.ru',
		'paralympicgames2024.ru', 'monkeydigital.co', 'infraclavifml.com', 'postuno.xyz',
		'subprofessfml.com', 'mjlawoffice.com', 'professionalseocleanup.com',
		'test.com', 'example.com', 'gmaill.com', 'gma1l.com', 'gmal.com', 'gmail.co',
		'gmail.con', 'gmail.cm', 'gmai1.com', 'gmai.com', 'gmailll.com',
		'yah00.com', 'yaho.com', 'yah0o.com', 'yahho.com', 'yaho0.com', 'yahooo.com',
		'yahoo.co', 'yahoo.cm', 'yahoomail.com', 't3st.com', 'teest.com', 'tesst.com',
		'teszt.com', 'test.co', 'test.cm', 'test.con', 'testt.com', 'examp1e.com',
		'exampIe.com', 'exampel.com', 'exampl.com', 'example.co', 'example.cm',
		'exarnple.com', 'exampIe.org',
	];

	return in_array($domain, $blocked_domains, true);
}
