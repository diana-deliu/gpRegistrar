<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => ":attribute trebuie să fie acceptat.",
	"active_url"           => ":attribute nu este un URL valid.",
	"after"                => ":attribute trebuie să fie o dată după :date.",
	"alpha"                => ":attribute poate conține doar litere.",
	"alpha_dash"           => ":attribute poate conține doar litere, numere și cratime.",
	"alpha_num"            => ":attribute poate conține numai litere și numere.",
	"array"                => ":attribute trebuie să fie un array.",
	"before"               => ":attribute trebuie să fie o dată înainte de :date.",
	"between"              => [
		"numeric" => ":attribute trebuie să fie între :min și :max.",
		"file"    => ":attribute trebuie să fie între :min și :max KB.",
		"string"  => ":attribute trebuie să fie între :min și :max caractere.",
		"array"   => ":attribute trebuie să aibă între :min și :max elemente.",
	],
	"boolean"              => "Câmpul :attribute trebuie să fie adevărat sau fals.",
	"confirmed"            => "Confirmarea :attribute nu se potrivește.",
	"date"                 => ":attribute nu este o dată validă.",
	"date_format"          => ":attribute nu se potrivește cu formatul :format.",
	"different"            => ":attribute și :other trebuie să fie diferiți.",
	"digits"               => ":attribute trebuie să aibă :digits cifre.",
	"digits_between"       => ":attribute trebuie să aibă între :min și :max cifre.",
	"email"                => ":attribute trebuie să fie o adresă e e-mail validă.",
	"filled"               => "Câmpul :attribute este obligatoriu.",
	"exists"               => ":attribute selectat nu este valid.",
	"image"                => ":attribute trebuie să fie o imagine.",
	"in"                   => ":attribute selectat nu este valid.",
	"integer"              => ":attribute trebuie să fie număr [integer].",
	"ip"                   => ":attribute trebuie să fie o adresă IP validă.",
	"max"                  => [
		"numeric" => ":attribute nu trebuie să depășească :max.",
		"file"    => ":attribute nu poate depăși :max KB.",
		"string"  => ":attribute nu poate depăși :max caractere.",
		"array"   => ":attribute nu poate depăși :max elemente.",
	],
	"mimes"                => ":attribute trebuie să fie un fișier de tipul :values.",
	"min"                  => [
		"numeric" => ":attribute trebuie să aibă cel puțin :min.",
		"file"    => ":attribute trebuie să aibă cel puțin :min KB.",
		"string"  => ":attribute trebuie să aibă cel puțin :min caractere.",
		"array"   => ":attribute trebuie să aibă cel puțin :min elemente.",
	],
	"not_in"               => ":attribute selectat nu este valid.",
	"numeric"              => ":attribute trebuie să fie număr.",
	"regex"                => "Formatul :attribute nu este valid.",
	"required"             => "Câmpul :attribute este obligatoriu.",
	"required_if"          => "Câmpul :attribute este obligatoriu când :other este :value.",
	"required_with"        => "Câmpul :attribute este obligatoriu când :values e prezent.",
	"required_with_all"    => "Câmpul :attribute este obligatoriu când :values e prezent.",
	"required_without"     => "Câmpul :attribute este obligatoriu când :values nu este prezent.",
	"required_without_all" => "Câmpul :attribute este obligatoriu când niciuna dintre :values nu este prezentă.",
	"same"                 => ":attribute și :other trebuie să fie identice.",
	"size"                 => [
		"numeric" => ":attribute trebuie să aibă :size.",
		"file"    => ":attribute trebuie să aibă :size KB.",
		"string"  => ":attribute trebuie să aibă :size caractere.",
		"array"   => ":attribute trebuie să aibă :size elemente.",
	],
	"unique"               => ":attribute există deja.",
	"url"                  => "Formatul :attribute nu este valid.",
	"timezone"             => ":attribute trebuie să fie un timezone valid.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [],

];
